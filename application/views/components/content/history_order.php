<div class="cart-page container py-4">
	<h1 class="page-title fs-2 mb-4">Hitory Order</h1>
	
	<div class="cart-container row">
		<div class="cart-items col-lg-8">
			<?php if (empty($orders)) : ?>
				<h5 class="w-100 bg-warning bg-opacity-75 px-5 py-3 rounded">Belum Ada Keranjang</h5>
			<?php endif; ?>

			<?php $a=1;  foreach ($orders as $order): ?>
				<div class="order-section p-3 mb-4 shadow-sm">
					<div class="order-header d-flex align-items-center mb-3">
						<div class="order-name fs-5">
							<span class="order-id">Order  <?= $a++ ?></span>
						</div>
					</div>
					<div class="order-item">
						<div class="row align-items-center">
							<div class="col">
								<div class="item-name fw-semibold mb-1"><?= htmlspecialchars($order['product_name']) ?></div>
								<div class="item-shop text-muted mb-2">Toko: <?= htmlspecialchars($order['shop_name']) ?></div>
								<div class="item-seller text-muted mb-2">Penjual: <?= htmlspecialchars($order['seller_name']) ?></div>
								<div class="item-status text-muted mb-2">Status: <?= htmlspecialchars($order['latest_status']) ?></div>
								<div class="item-price fs-5 mb-2">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></div>
							</div>
							<!-- <div class="col-auto">
								<a href="<?= base_url('checkout/detail?order_id=' . $order['order_id']) ?>" class="detail-btn btn btn-primary">Lihat Detail</a>
							</div> -->
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="col-lg-4">
			<div class="cart-summary bg-white p-3 rounded">
				<h2 class="summary-title fs-5 mb-3">Ringkasan Order</h2>
				<div class="summary-row d-flex justify-content-between mb-3">
					<span>Total Order</span>
					<span class="fw-bold">Rp <?= number_format(array_sum(array_column($orders, 'total_price')), 0, ',', '.') ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
