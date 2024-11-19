
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Alamat Penerima</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="card-body d-flex justify-content-center gap-4">
                        <div class="w-50">
                            <div class="mb-2">
                                <label for="recipient_name" class="form-label">Nama Penerima</label>
                                <input type="text" class="form-control" id="recipient_name" name="recipient_name">
                                <?php if (validation_errors()) : ?>
                                    <small class="m-1 text-danger position-absolute my-0 mx-2 small"><?= form_error('recipient_name'); ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-2">
                                <label for="recipient_phone" class="form-label">Nomer Penerima</label>
                                <input type="text" class="form-control" id="recipient_phone" name="recipient_phone">
                                <?php if (validation_errors()) : ?>
                                    <small class="m-1 text-danger position-absolute my-0 mx-2 small"><?= form_error('recipient_phone'); ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-2">
                                <label for="province_id" class="form-label">Provinsi</label>
                                <select name="province_id" id="province_id" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <?php if (validation_errors()) : ?>
                                    <small class="m-1 text-danger position-absolute my-0 mx-2 small"><?= form_error('province_id'); ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-2">
                                <label for="city_id" class="form-label">Kota/Kabupaten</label>
                                <select name="city_id" id="city_id" class="form-control" disabled>
                                    <option value="">Pilih Kota</option>
                                </select>
                                <?php if (validation_errors()) : ?>
                                    <small class="m-1 text-danger position-absolute my-0 mx-2 small"><?= form_error('city_id'); ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-2">
                                <label for="district_id" class="form-label">Kecamatan</label>
                                <select name="district_id" id="district_id" class="form-control" disabled>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <?php if (validation_errors()) : ?>
                                    <small class="m-1 text-danger position-absolute my-0 mx-2 small"><?= form_error('district_id'); ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="w-50">
                            <div class="mb-2">
                                <label for="subdistrict_id" class="form-label">Kelurahan</label>
                                <select name="subdistrict_id" id="subdistrict_id" class="form-control" disabled>
                                    <option value="">Pilih Kelurahan</option>
                                </select>
                                <?php if (validation_errors()) : ?>
                                    <small class="m-1 text-danger position-absolute my-0 mx-2 small"><?= form_error('subdistrict_id'); ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-2">
                                <label for="postal_code" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Masukkan kode pos" disabled readonly>
                            </div>
                            <div class="mb-2">
                                <label for="catatan" class="form-label">Catatan (Optional)</label>
                                <input type="text" class="form-control" name="catatan" id="catatan" placeholder="Masukkan catatan">
                            </div>
                            <div class="mb-2">
                                <label for="address" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="address" id="address" rows="4" placeholder="Masukkan alamat lengkap"></textarea>
                                <?php if (validation_errors()) : ?>
                                    <small class="m-1 text-danger position-absolute my-0 mx-2 small"><?= form_error('address'); ?></small>
                                <?php endif; ?>
                            </div>
                            <!-- Hidden inputs for selected names and postal code -->
                            <input type="hidden" name="selected_province_name" id="selected_province_name">
                            <input type="hidden" name="selected_city_name" id="selected_city_name">
                            <input type="hidden" name="selected_district_name" id="selected_district_name">
                            <input type="hidden" name="selected_subdistrict_name" id="selected_subdistrict_name">
                            <input type="hidden" name="selected_postal_code" id="selected_postal_code">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('checkout/carts/') ?>" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary">Buy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#exampleModal').modal('show');
    $.ajax({
        url: 'https://alamat.thecloudalert.com/api/provinsi/get/',
        method: 'GET',
        success: function(response) {
            if (response.status === 200 && response.result) {
                $.each(response.result, function(index, province) {
                    $('#province_id').append('<option value="' + province.id + '">' + province.text + '</option>');
                });
            }
        },
        error: function() {
            alert('Gagal mengambil data provinsi. Silakan coba lagi.');
        }
    });

    $('#province_id').change(function() {
        var provinceId = $(this).val();
        $('#city_id').empty().append('<option value="">Pilih Kota</option>').prop('disabled', true);
        $('#district_id').empty().append('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
        $('#subdistrict_id').empty().append('<option value="">Pilih Kelurahan</option>').prop('disabled', true);
        $('#postal_code').val('');
        
        $('#selected_province_name').val($('#province_id option:selected').text());

        if (provinceId) {
            $('#city_id').prop('disabled', false);
            $.ajax({
                url: 'https://alamat.thecloudalert.com/api/kabkota/get/?d_provinsi_id=' + provinceId,
                method: 'GET',
                success: function(response) {
                    if (response.status === 200 && response.result) {
                        $.each(response.result, function(index, city) {
                            $('#city_id').append('<option value="' + city.id + '">' + city.text + '</option>');
                        });
                    }
                },
                error: function() {
                    alert('Gagal mengambil data kota. Silakan coba lagi.');
                }
            });
        }
    });

    $('#city_id').change(function() {
        var cityId = $(this).val();
        $('#district_id').empty().append('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
        $('#subdistrict_id').empty().append('<option value="">Pilih Kelurahan</option>').prop('disabled', true);
        $('#postal_code').val('');
        
        $('#selected_city_name').val($(this).find('option:selected').text());

        if (cityId) {
            $('#district_id').prop('disabled', false);
            $.ajax({
                url: 'https://alamat.thecloudalert.com/api/kecamatan/get/?d_kabkota_id=' + cityId,
                method: 'GET',
                success: function(response) {
                    if (response.status === 200 && response.result) {
                        $.each(response.result, function(index, district) {
                            $('#district_id').append('<option value="' + district.id + '">' + district.text + '</option>');
                        });
                    }
                },
                error: function() {
                    alert('Gagal mengambil data kecamatan. Silakan coba lagi.');
                }
            });
        }
    });

    $('#district_id').change(function() {
        var districtId = $(this).val();
        $('#subdistrict_id').empty().append('<option value="">Pilih Kelurahan</option>').prop('disabled', true);
        $('#postal_code').val('');
        
        $('#selected_district_name').val($(this).find('option:selected').text());

        if (districtId) {
            $('#subdistrict_id').prop('disabled', false);
            $.ajax({
                url: 'https://alamat.thecloudalert.com/api/kelurahan/get/?d_kecamatan_id=' + districtId,
                method: 'GET',
                success: function(response) {
                    if (response.status === 200 && response.result) {
                        $.each(response.result, function(index, subdistrict) {
                            $('#subdistrict_id').append('<option value="' + subdistrict.id + '">' + subdistrict.text + '</option>');
                        });
                    }
                },
                error: function() {
                    alert('Gagal mengambil data kelurahan. Silakan coba lagi.');
                }
            });
        }
    });

    $('#subdistrict_id').change(function() {
        var subdistrictId = $(this).val();
        var subdistrictName = $(this).find('option:selected').text();
        
        $('#selected_subdistrict_name').val(subdistrictName);
        
        var cityId = $('#city_id').val();
        var districtId = $('#district_id').val();

        if (cityId && districtId && subdistrictId) {
            $.ajax({
                url: 'https://alamat.thecloudalert.com/api/kodepos/get/?d_kabkota_id=' + cityId + '&d_kecamatan_id=' + districtId + '&d_kelurahan_id=' + subdistrictId,
                method: 'GET',
                success: function(response) {
                    if (response.status === 200 && response.result) {
                        var postalCode = response.result[0].text;
                        $('#postal_code').val(postalCode);
                        $('#selected_postal_code').val(postalCode);
                    }
                },
                error: function() {
                    alert('Gagal mengambil kode pos. Silakan coba lagi.');
                }
            });
        }
    });
});
</script>
