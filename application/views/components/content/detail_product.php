<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4 d-flex justify-content-center align-items-center" style="width:400px;">
                    <img src="<?= base_url('public/image/uploads/products/' . $matched_product['product_image']) ?>" 
                         class="img-fluid rounded object-fit-cover h-100" 
                         alt="Product Image">
                </div>

                <div class="col-md-6">
                    <h2 class="mb-3"><?= $matched_product['product_name'] ?></h2>
                    <h4>Harga: Rp. <span id="price"><?= number_format($matched_product['product_price'], 0, ',', '.') ?></span></h4>
                    
                    <p class="mb-4">
                        <?= $matched_product['description'] ?>
                    </p>

                    <div class="mb-3">
                        <small class="text-muted">Stok tersedia: <?= $matched_product['product_stock'] ?></small>
                    </div>
                    
                    <?php if ($matched_product['product_price'] > 0): ?>
                        <form action="<?= base_url('C_checkout/add_to_cart/') ?>" method="post">
                            <input type="hidden" name="product_id" value="<?= $matched_product['product_id'] ?>">
                            <input type="hidden" name="price" value="<?= $matched_product['product_price'] ?>">
                            <input type="hidden" name="seller_id" value="<?= $matched_product['seller_id'] ?>">
                            
                            <div class="mb-4">
                                <label class="form-label">Jumlah:</label>
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-secondary" onclick="decrement(<?= $matched_product['product_price'] ?>)" type="button">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" id="numberInput" name="quantity" class="form-control text-center" 
                                           value="1" min="1" max="<?= $matched_product['product_stock'] ?>" 
                                           oninput="updatePrice(<?= $matched_product['product_price'] ?>)">
                                    <button class="btn btn-outline-secondary" onclick="increment(<?= $matched_product['product_price'] ?>)" type="button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <p class="text-danger">Produk ini saat ini tidak tersedia untuk pembelian.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function increment(price) {
        const input = document.getElementById("numberInput");
        const maxStock = parseInt(input.max);
        
        if (parseInt(input.value) < maxStock) {
            input.value = parseInt(input.value) + 1;
            updatePrice(price);
        } else {
            alert("Jumlah tidak boleh melebihi stok tersedia.");
        }
    }

    function decrement(price) {
        const input = document.getElementById("numberInput");
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
            updatePrice(price);
        }
    }

    function updatePrice(unitPrice) {
        const input = document.getElementById("numberInput");
        const price = document.getElementById("price");
        const maxStock = parseInt(input.max);

        if (parseInt(input.value) > maxStock) {
            input.value = maxStock;
            alert("Jumlah telah disesuaikan sesuai stok tersedia.");
        }

        const totalPrice = input.value * unitPrice;
        price.textContent = new Intl.NumberFormat("id-ID").format(totalPrice);
    }
</script>
