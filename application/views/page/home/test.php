<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-md-6 mb-4">
                        <img src="/api/placeholder/600/400" class="img-fluid rounded" alt="Product Image">
                    </div>

                    <!-- Product Details -->
                    <div class="col-md-6">
                        <h2 class="mb-3">Kursi Kantor Ergonomis</h2>
                        <h4 class="mb-3">Rp 1.500.000</h4>
                        
                        <p class="mb-4">
                            Kursi kantor ergonomis dengan sandaran punggung yang nyaman, 
                            dapat diatur ketinggiannya, dan dilengkapi dengan roda premium 
                            untuk mobilitas maksimal.
                        </p>

                        <div class="mb-3">
                            <small class="text-muted">Stok tersedia: 10</small>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="mb-4">
                            <label class="form-label">Jumlah:</label>
                            <div class="input-group" style="width: 150px;">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control text-center" value="1" min="1" max="10">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="mb-4">
                            <h5>Total: Rp 1.500.000</h5>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" type="button">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Tambah ke Keranjang
                            </button>
                            <button class="btn btn-primary" type="button">
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>