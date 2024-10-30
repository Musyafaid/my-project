<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
        <div class="container d-flex justify-content-around">
            <div>

                <a class="navbar-brand fw-bold" href="<?= base_url('home') ?>">TokoApaAja</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            
            <!-- Search Bar -->
            <div class="col-lg-6 d-none d-lg-block">
                <form class="d-flex" action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari produk...">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Cart & User -->
            <div class="" >
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('checkout/carts/') ?>">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger rounded-pill">2</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark btn-sm mt-1" href="#">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>