
    <style>
        #sidebar {
            width: 270px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            transition: 0.3s;
            margin-left: -270px;
        }
        #sidebar.collapsed {
            margin-left: 0px;
        }
        
        #toggleSidebar{
            margin-left: 270px;

        }
    </style>

    <!-- Sidebar -->
    <div class="bg-dark text-white " id="sidebar">
        <button class="btn btn-dark rounded-0" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <div class="p-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <button class="btn btn-dark d-md-none" id="closeSidebar">
                    <i class="fas fa-times"></i>
                </button>
                <div class="nav-item d-flex align-items-center gap-1">
                    <img height="60" src="<?= base_url('public/image/seller/profile.png') ?>" alt="">
                    <div class="d-flex flex-column justify-content-center">
                        <h5 class="text-md-start p-0 m-0"><?= $name ?></h5>
                        <small class=" p-0 m-0 fst-italic" style="font-size: smaller ;"><?= $this->session->userdata('sellerShop') ?></small>
                        <p class="p-0 m-0" style="font-size: smaller ;"><?= $email ?></p>
                    </div>
                </div>
            </div>
			<?php if($this->session->userdata('role') == 'admin') : ?>
				<ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('admin/dashboard/') ?>">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('admin/dashboard/category/') ?>">
                        <i class="fa-solid fa-box me-2"></i> Category
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="fas fa-chart-bar me-2"></i> Analytics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="fas fa-cog me-2"></i> Settings
                    </a>
                </li> -->
				<li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="fas fa-chart-bar me-2"></i> Sub Category
                    </a>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-white" onclick="confirmLogout()">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </li>
            </ul>

			<?php else : ?>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('dashboard/') ?>">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('dashboard/product/') ?>">
                        <i class="fa-solid fa-box me-2"></i> Product
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link text-white"  href="<?= base_url('dashboard/order') ?>">
                        <i class="fas fa-chart-bar me-2"></i> Order
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="fas fa-cog me-2"></i> Settings
                    </a>
                </li>  -->
			
                <li class="nav-item">
                    <button class="nav-link text-white" onclick="confirmLogout()">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </li>
            </ul>
			<?php endif ; ?> 
        </div>
    </div>


  

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        document.getElementById('closeSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('collapsed');
        });
    </script>
