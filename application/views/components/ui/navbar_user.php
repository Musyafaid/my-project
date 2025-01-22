<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
        <div class="container d-flex justify-content-around">
            <div>

                <a class="navbar-brand fw-bold" href="<?= base_url('home') ?>">TokoApaAja</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            
            <div class="col-lg-6 d-none d-lg-block">
                <form class="d-flex" action="<?= base_url('home') ?>" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari produk...">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>


			<?php if($this->session->userdata('isLogin') && $this->session->userdata('userId')) :  ?>
				<div class="" >
					<ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('checkout/') ?>">
								<i class="fas fa-shopping-cart"></i>
								<span class="badge bg-danger rounded-pill"><?= $this->session->userdata('userCarts') ?></span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('checkout/history') ?>">
								history
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('user/logout')?>" >Logout</a>
						</li>
						
					</ul>
				</div>
			<?php else : ?>
			<div class="" >
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('user/login')?>" >Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark btn-sm mt-1" href="<?= base_url('user/register')?>" >Daftar</a>
                    </li>
                </ul>
            </div>
			<?php endif ; ?>
        </div>
    </nav>
