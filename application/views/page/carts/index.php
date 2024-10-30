
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
            top: 1rem;
        }
    </style>

    <div class="cart-page container py-4">
        <h1 class="page-title fs-2 mb-4">Keranjang Belanja</h1>
        
        <div class="cart-container row">
            <div class="cart-items col-lg-8">
                <?php 
                $shopGroups = [];
                foreach ($products as $product) {
                    $shopGroups[$product['shop_name']][] = $product;
                }
                
                foreach ($shopGroups as $shopName => $items): ?>
                    <div class="store-section p-3 mb-4">
                        <div class="store-header d-flex align-items-center mb-3">
                            <div class="store-name fs-5">
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
                                            <button class="quantity-btn btn btn-outline-secondary btn-sm">-</button>
                                            <input type="number" class="quantity-input form-control form-control-sm mx-2" 
                                                   value="<?= htmlspecialchars($product['quantity']) ?>" min="1">
                                            <button class="quantity-btn btn btn-outline-secondary btn-sm">+</button>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('checkout/remove?carts='.$product['cart_items_id']) ?>" class="remove-btn btn btn-link text-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="store-summary d-flex justify-content-between mt-3 pt-3 border-top">
                            <span>Subtotal (<?= count($items) ?> produk)</span>
                            <span class="fw-bold">Rp <?= number_format(array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $items)), 0, ',', '.') ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <div class="cart-summary bg-white p-3 rounded">
                    <h2 class="summary-title fs-5 mb-3">Ringkasan Belanja</h2>
                    <div class="summary-row d-flex justify-content-between mb-3">
                        <span>Total Harga</span>
                        <span class="fw-bold">Rp <?= number_format(array_sum(array_map(fn($items) => array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $items)), $shopGroups)), 0, ',', '.') ?></span>
                    </div>
                    <button class="checkout-btn btn btn-primary w-100">Lanjut ke Pembayaran</button>
                </div>
            </div>
        </div>
    </div>
    
    