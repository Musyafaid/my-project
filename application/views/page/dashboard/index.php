
<!-- <div class="container py-4"> -->
    <!-- Header -->
    

	<?php if($this->session->userdata('role') == 'admin') : ?>

		<div class="bg-white rounded shadow-sm p-4 mb-4">
			<h1 class="h3">Admin Dashboard</h1>
			<p class="text-muted">Manage Category and Checkout</p>
		</div>
	<?php else : ?>
		<div class="bg-white rounded shadow-sm p-4 mb-4">
			<h1 class="h3">Product & Income Dashboard</h1>
			<p class="text-muted">Manage products and track income</p>
		</div>
	<?php endif ; ?>

    <!-- Stats Cards -->


  
<!-- </div> -->
