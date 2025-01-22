
<div class="container py-1">
	<h1 class="mb-4">Order List</h1>
	<!-- <form class="form-inline d-flex my-3" action="" method="get">
		<input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
		<button class="btn my-2 my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form> -->
	<table class="table table-bordered table-responsive">
		<thead>
			<tr>
				<th scope="col ">#</th>
				<th scope="col ">Product</th>
				<th scope="col ">Customer</th>
				<th scope="col ">Total Price</th>
				<th scope="col ">Status</th>
				<th scope="col ">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $a=0; foreach($orders as $order) : ?>
			<tr>
				<th scope="row"><?= ++$a ?></th>
				<td><?= $order['product_name'] ?></td>
				<td><?= $order['user_name'] ?></td>
				<td>Rp. <?= number_format($order['total_price'],0,',',',') ?></td>
				<td><?= $order['latest_status'] ?></td>
				<td>
					<a href="<?= base_url('dashboard/order/'),$order['order_id_hash'] ?>" class="btn btn-primary btn-sm w-100">Action</a>
				</td>
			</tr>
			<?php endforeach ; ?>

		</tbody>
	</table>
</div>
