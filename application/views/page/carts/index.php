<style>
        .address-card {
            border: 2px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .address-card:hover {
            border-color: #03ac0e;
        }
        
        .address-card.selected {
            border-color: #03ac0e;
            background-color: #f1fff1;
        }
        
        .label-utama {
            background-color: #e5f9f6;
            color: #03ac0e;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 4px;
        }
        
        .btn-tambah-alamat {
            border: 2px dashed #e5e7eb;
            background-color: white;
            transition: all 0.3s ease;
        }
        
        .btn-tambah-alamat:hover {
            border-color: #03ac0e;
            color: #03ac0e;
        }

        .modal-dialog {
            max-width: 600px;
        }

        .scroll-area {
            max-height: 60vh;
            overflow-y: auto;
        }
    </style>
    
    
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
				<h5 class="w-100 bg-warning bg-opacity-75 px-5 py-3 rounded">Belum Ada Keranjang</h5>
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
									<a href="<?= base_url('checkout/update?decrement='.$product['cart_items_id_hash']) ?>" class="quantity-btn btn btn-outline-secondary btn-sm" data-action="decrement">-</a>
									<input type="number" disabled class="quantity-input form-control form-control-sm mx-2" 
										value="<?= htmlspecialchars($product['quantity']) ?>" min="1" data-quantity-input>
									<a href="<?= base_url('checkout/update?increment='.$product['cart_items_id_hash']) ?>" class="quantity-btn btn btn-outline-secondary btn-sm" data-action="increment">+</a>

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
				<button class="checkout-btn btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal" 
  				  <?= empty($products) ? 'disabled' : ''; ?>>Buy</button>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alamat Penerima</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="scroll-area">
                    <div class="mb-3">
                        <a href="<?= base_url('checkout/address/') ?>" class="btn btn-tambah-alamat w-100 py-3">
                            <i class="bi bi-plus-lg"></i> Tambah Alamat Baru
                        </a>
                    </div>

                    <?php foreach($shipping_address as $address) : ?>
                    <div class="address-card mb-3 rounded p-3" 
                         data-id="<?= $address['address_id'] ?>"
                         data-name="<?= $address['recipient_name'] ?>"
                         data-phone="<?= $address['recipient_phone'] ?>"
                         data-address="<?= $address['full_address'] ?>"
                         data-subdistrict="<?= $address['subdistrict'] ?>"
                         data-district="<?= $address['district'] ?>"
                         data-city="<?= $address['city'] ?>"
                         data-province="<?= $address['province'] ?>"
                         data-postal="<?= $address['postal_code'] ?>">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="fw-bold"><?= $address['recipient_name'] ?></span>
                            </div>
                            <button class="btn btn-link text-dark p-0">Ubah</button>
                        </div>
                        <div class="text-secondary mb-2"><?= $address['recipient_phone'] ?></div>
                        <div class="mb-2">
                            <?= $address['full_address'] ?>
                            <br>
                            <?= $address['subdistrict'] ?>, <?= $address['district'] ?>
                            <br>
                            <?= $address['city'] ?>, <?= $address['province'] ?>, <?= $address['postal_code'] ?>
                        </div>
                        <div class="text-success small">
                            <i class="bi bi-check-circle-fill"></i> Tersimpan sebagai alamat utama
                        </div>
                    </div>
                    <?php endforeach ; ?>

                    <?php if(!$shipping_address) : ?>
                        <p class="text-danger">Mohon isi form alamat</p>
                    <?php endif ; ?>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" onclick="proceedToBuy()">Pilih Alamat</button>
            </div>
        </div>
    </div>
</div>

<!-- Form tersembunyi untuk mengirim data -->
<form id="buyForm" action="<?= base_url('checkout/buy/') ?>" method="POST" style="display: none;">
    <input type="hidden" name="address_id" id="selected_address_id">
    <input type="hidden" name="recipient_name" id="selected_recipient_name">
    <input type="hidden" name="recipient_phone" id="selected_recipient_phone">
    <input type="hidden" name="full_address" id="selected_full_address">
    <input type="hidden" name="subdistrict" id="selected_subdistrict">
    <input type="hidden" name="district" id="selected_district">
    <input type="hidden" name="city" id="selected_city">
    <input type="hidden" name="province" id="selected_province">
    <input type="hidden" name="postal_code" id="selected_postal_code">
</form>

<style>
.address-card {
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.address-card.selected {
    border-color: #198754;
    background-color: #f8f9fa;
}
</style>

<script>
let selectedAddressId = null;

// Fungsi untuk menangani klik pada kartu alamat
document.querySelectorAll('.address-card').forEach(card => {
    card.addEventListener('click', () => {
        // Hapus kelas 'selected' dari semua kartu alamat
        document.querySelectorAll('.address-card').forEach(c => {
            c.classList.remove('selected');
        });
        
        // Tambahkan kelas 'selected' ke kartu yang diklik
        card.classList.add('selected');
        
        // Simpan ID alamat yang dipilih
        selectedAddressId = card.getAttribute('data-id');

        // Simpan data alamat ke form tersembunyi
        document.getElementById('selected_address_id').value = card.getAttribute('data-id');
        document.getElementById('selected_recipient_name').value = card.getAttribute('data-name');
        document.getElementById('selected_recipient_phone').value = card.getAttribute('data-phone');
        document.getElementById('selected_full_address').value = card.getAttribute('data-address');
        document.getElementById('selected_subdistrict').value = card.getAttribute('data-subdistrict');
        document.getElementById('selected_district').value = card.getAttribute('data-district');
        document.getElementById('selected_city').value = card.getAttribute('data-city');
        document.getElementById('selected_province').value = card.getAttribute('data-province');
        document.getElementById('selected_postal_code').value = card.getAttribute('data-postal');
    });
});

// Fungsi untuk melanjutkan ke halaman buy
function proceedToBuy() {
    if (selectedAddressId) {
        // Submit form untuk pindah ke halaman buy
        document.getElementById('buyForm').submit();
    } else {
        alert('Silakan pilih alamat terlebih dahulu.');
    }
}

// Tambahkan event listener untuk tombol close modal
document.querySelector('.btn-close').addEventListener('click', function() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
    modal.hide();
});
</script>


    
