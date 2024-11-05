
    <style>
        .store-icon {
            width: 24px;
            height: 24px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        
        .cart-item {
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 0;
        }
        
        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .quantity-input {
            width: 60px;
            text-align: center;
        }
        
        .store-section {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }
        
        .cart-summary {
            position: sticky;
            top: 4rem;
        }
    </style>

    <div class="cart-page container py-4 ">
        <h1 class="page-title fs-2 mb-4">Keranjang Belanja</h1>
        
        <div class="cart-container row">
            <div class="cart-items col-lg-8">
                <?php if(!$products) : ?>
                    <h5 class="w-100 bg-warning bg-opacity-75 px-5 py-3 rounded">Belum Ada Carts</h5>
                <?php endif ; ?>
                <?php 
                $shopGroups = [];
                foreach ($products as $product) {
                    $shopGroups[$product['shop_name']][] = $product;
                }
                
                foreach ($shopGroups as $shopName => $items): ?>
                    <div class="store-section p-3 mb-4">
                        <div class="store-header d-flex align-items-center mb-3">
                            <div class="store-name fs-5 d-flex">
                                <div class="store-icon h-100 d-flex align-items-center"><img class="w-100 h-100" src="<?= base_url('public/image/seller/profile.png') ?>" alt=""></div>
                                <?= htmlspecialchars($shopName) ?>
                            </div>
                        </div>
                        <?php foreach ($items as $product): ?>
                            <div class="cart-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="<?= base_url('./public/image/uploads/products/'. $product['product_image']) ?>" 
                                             alt="<?= htmlspecialchars($product['product_name']) ?>" 
                                             class="item-image">
                                    </div>
                                    <div class="col">
                                        <div class="item-name fw-semibold mb-1"><?= htmlspecialchars($product['product_name']) ?></div>
                                        <div class="item-description text-muted mb-2"><?= htmlspecialchars($product['description']) ?></div>
                                        <div class="item-price fs-5 mb-2">Rp <?= number_format($product['price'], 0, ',', '.') ?></div>
                                        <div class="quantity-controls d-flex align-items-center">
                                        <a href="<?= base_url('checkout/carts/update?decrement='.$product['cart_items_id_hash']) ?>" class="quantity-btn btn btn-outline-secondary btn-sm" data-action="decrement">-</a>
                                        <input type="number" disabled class="quantity-input form-control form-control-sm mx-2" 
                                            value="<?= htmlspecialchars($product['quantity']) ?>" min="1" data-quantity-input>
                                        <a href="<?= base_url('checkout/carts/update?increment='.$product['cart_items_id_hash']) ?>" class="quantity-btn btn btn-outline-secondary btn-sm" data-action="increment">+</a>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('checkout/remove?carts='.$product['cart_items_id_hash']) ?>" class="remove-btn btn btn-link text-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="store-summary d-flex justify-content-between mt-3 pt-3 border-top">
                            <span>Subtotal (<?= count($items) ?> produk)</span>
                            <span class="store-subtotal fw-bold">Rp <?= number_format(array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $items)), 0, ',', '.') ?></span>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <div class="cart-summary bg-white p-3  rounded">
                    <h2 class="summary-title fs-5 mb-3">Ringkasan Belanja</h2>
                    <div class="summary-row d-flex justify-content-between mb-3">
                        <span>Total Harga</span>
                        <span class="fw-bold">Rp <?= number_format(array_sum(array_map(fn($items) => array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $items)), $shopGroups)), 0, ',', '.') ?></span>
                    </div>
                    <!-- <a href="<?= base_url('checkout/buy') ?>" class="checkout-btn btn btn-primary w-100">Lanjut ke Pembayaran</a> -->
                    <button class="checkout-btn btn btn-primary w-100"  data-bs-toggle="modal" data-bs-target="#exampleModal"> Buy</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Alamat Penerima</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <form method="post" action="<?= base_url('checkout/buy/')?>">
                    <div class="modal-body">
                                <div class="card-body d-flex justify-content-center gap-4">
                                    <div class="w-50">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Nama Penerima</label>
                                            <input type="text" class="form-control" name="name" >
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('city_id'); ?></small>
                                            <?php endif ; ?>
                                        </div>
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Nomer Penerima</label>
                                            <input type="number_format" class="form-control" name="num_phone" >
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('city_id'); ?></small>
                                            <?php endif ; ?>
                                        </div>
                                        <div class="mb-2">
                                            <label for="province_id" class="form-label">Provinsi</label>
                                            <select name="province_id" id="province_id" class="form-control">
                                                <option value="">Pilih Provinsi</option>
                                            </select>
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('province_id'); ?></small>
                                            <?php endif ; ?>
                                            
                                        </div>

                                        <div class="mb-2">
                                            <label for="city_id" class="form-label">Kota/Kabupaten</label>
                                            <select name="city_id" id="city_id" class="form-control" disabled>
                                                <option value="">Pilih Kota</option>
                                            </select>
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('city_id'); ?></small>
                                            <?php endif ; ?>
                                        </div>
                                        
                                        <div class="mb-2">
                                            <label for="district_id" class="form-label">Kecamatan</label>
                                            <select name="district_id" id="district_id" class="form-control" disabled>
                                                <option value="">Pilih Kecamatan</option>
                                            </select>
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('district_id'); ?></small>
                                            <?php endif ; ?>
                                        </div>
                                        
                                    
                                    </div>
                                    
                                    <div class="w-50">
                                    <div class="mb-2">
                                            <label for="subdistrict_id" class="form-label">Kelurahan</label>
                                            <select name="subdistrict_id" id="subdistrict_id" class="form-control" disabled>
                                                <option value="">Pilih Kelurahan</option>
                                            </select>
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('subdistrict_id'); ?></small>
                                            <?php endif ; ?>
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
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('address'); ?></small>
                                            <?php endif ; ?>
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
                                <a href="<?= base_url('C_home/view_cart/') ?>" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Buy</button>
                            </div>
                        </form>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
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

              
                $('#selected_province_name').val($('#province_id option:selected').text());
            }
        });

        $('#city_id').change(function() {
            var cityId = $(this).val();
            var cityName = $(this).find('option:selected').text(); 
            $('#district_id').empty().append('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
            $('#subdistrict_id').empty().append('<option value="">Pilih Kelurahan</option>').prop('disabled', true);
            $('#postal_code').val('');

         
            $('#selected_city_name').val(cityName);

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
            var districtName = $(this).find('option:selected').text(); // Get the selected district name
            $('#subdistrict_id').empty().append('<option value="">Pilih Kelurahan</option>').prop('disabled', true);
            $('#postal_code').val('');
            
            $('#selected_district_name').val(districtName);
            
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
    var cityId = $('#city_id').val();
    var districtId = $('#district_id').val();
    var subdistrictId = $(this).val();

    if (cityId && districtId && subdistrictId) {
        // Fetch postal code based on selected subdistrict
        $.ajax({
            url: 'https://alamat.thecloudalert.com/api/kodepos/get/?d_kabkota_id=' + cityId + '&d_kecamatan_id=' + districtId + '&d_kelurahan_id=' + subdistrictId,
            method: 'GET',
            success: function(response) {
                if (response.status === 200 && response.result) {
                    var postalCode = response.result[0].text; // Assuming you want the first postal code
                    $('#postal_code').val(postalCode);
                    // Set the hidden input for the selected postal code
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