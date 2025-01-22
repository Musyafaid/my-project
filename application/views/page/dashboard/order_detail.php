<div class="container d-flex flex-column align-items-center py-5">
	<h1 class="mb-4">Order Confirmation (Seller)</h1>
	<div class="w-100 d-flex justify-content-center">
		<div class="w-75">
			<div class="shadow rounded p-4 mb-4 bg-white border">
				<h4 class="border-bottom pb-3 mb-4">Order Summary</h4>
				<?php
				$total_price = 0; // Inisialisasi total harga
				?>

				<?php foreach ($order_details as $products): ?>
					<?php foreach ($products as $item): ?>
						<?php
						$total_price += (int) $item['sub_total'];

						?>

						<div class="d-flex align-items-center mb-3">
							<div class="position-relative">
								<img src="<?= base_url('./public/image/uploads/products/' . $item['product_image']) ?>"
									alt="Product Image" class="rounded me-3"
									style="object-fit: cover; max-width: 150px; max-height: 150px;">
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
									2
								</span>
							</div>
							<div class="flex-grow-1 ms-3">
								<h5 class="mb-2"><?= $item['product_name'] ?></h5>
								<div class="d-flex flex-column">
									<span class="text-muted mb-1">
										<i class="bi bi-box"></i> Quantity: <?= $item['quantity'] ?> units
									</span>
									<span class="text-muted">
										<i class="bi bi-tag"></i> Price: Rp. <?= number_format($item['price'], 0, ',', '.') ?>
										each
									</span>
								</div>
							</div>
							<div class="text-end">
								<p class="text-muted mb-1">Total Amount</p>
								<h4 class="text-primary mb-0">Rp. <?= number_format($item['sub_total'], 0, ',', '.') ?></h4>
							</div>
						</div>

					<?php endforeach; ?>
				<?php endforeach; ?>

				<!-- Tampilkan total harga setelah loop -->
				<div class="text-end">
					<p class="text-muted mb-1">Total Ammount</p>
					<h4 class="text-primary mb-0">Rp. <?= number_format($total_price, 0, ',', '.') ?></h4>
				</div>
			</div>

			<!-- Rest in Accordion -->
			<div class="accordion" id="orderAccordion">
				<!-- Customer Details -->
				<!-- <div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#customerDetails">
							Customer Details
						</button>
					</h2>
					<div id="customerDetails" class="accordion-collapse collapse" data-bs-parent="#orderAccordion">
						<div class="accordion-body">
							<div class="shadow-sm rounded p-4">
								<div class="row">
									<div class="col-md-6">
										<p><strong>Name:</strong> John Doe</p>
										<p><strong>Email:</strong> john@example.com</p>
										<p><strong>Phone:</strong> +1234567890</p>
									</div>
									<div class="col-md-6">
										<p><strong>Order Date:</strong> 2024-11-22</p>
										<p><strong>Order ID:</strong> #ORD123456</p>
										<p><strong>Payment Status:</strong> Paid</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->

				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#shippingInfo">
							Shipping Information
						</button>
					</h2>
					<div id="shippingInfo" class="accordion-collapse collapse" data-bs-parent="#orderAccordion">
						<div class="accordion-body">
							<?php foreach ($shipping_address as $address): ?>
								<div class="address-card">
									<h5>Recipient: <?= $address['recipient_name'] ?></h5>
									<p><strong>Phone:</strong> <?= $address['recipient_phone'] ?></p>
									<p><strong>Province:</strong> <?= $address['province'] ?></p>
									<p><strong>City:</strong> <?= $address['city'] ?></p>
									<p><strong>District:</strong> <?= $address['district'] ?></p>
									<p><strong>Subdistrict:</strong> <?= $address['subdistrict'] ?></p>
									<p><strong>Full Address:</strong> <?= $address['full_address'] ?></p>
									<p><strong>Postal Code:</strong>
										<?= !empty($address['postal_code']) ? $address['postal_code'] : 'N/A' ?></p>
									<p><strong>Notes:</strong> <?= $address['notes'] ?></p>
								</div>
								<hr>
							<?php endforeach; ?>

						</div>
					</div>
				</div>
			</div>

			<div class="mt-4 text-center">
				<?php foreach ($order_details as $products): ?>
					<?php
					$firstItem = reset($products);
					?>


					<?php foreach ($products as $item): ?>
						<?php if ($item['status'] !== 'succes'): ?>
							<?php if ($item['order_id'] == $firstItem['order_id']): ?>
								<a href="<?= base_url('dashboard/confirmation/') . $item['order_id'] ?>"
									class="btn btn-success btn-lg me-2 px-4">
									<i class="bi bi-check-circle me-2"></i>Konfirmasi
								</a>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endforeach; ?>

				
			</div>
		</div>
	</div>
</div>
