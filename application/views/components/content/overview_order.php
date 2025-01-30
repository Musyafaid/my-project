<style>
	td {
		font-size: smaller;

	}

	.canvasjs-chart-credit {
		display: none;
	}
</style>

<div div class="row g-4">
	<div class="col-md-6">
		<div class="bg-white rounded shadow-sm p-4">
			<h2 class="h5 mb-4">Order Management</h2>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Customer</th>

							<th>Total Price</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($orders as $order) : ?>
							<tr class="order-row">
								<td class="text-truncate h-auto "><?= $order['product_name'] ?></td>
								<td class="text-truncate h-auto "><?= $order['user_name'] ?></td>
								<td class="text-truncate h-auto "><?= $order['total_price'] ?></td>
								<td class="text-truncate h-auto ">

									<span class="status-text badge bg-success"> <i class="fa-solid fa-exclamation text-warning   px-1"></i><?= $order['latest_status'] ?></span>
								</td>
							</tr>

						<?php endforeach; ?>
					</tbody>
				</table>

				<a class="text-white btn btn-dark" href="<?= base_url('dashboard/order') ?>">All Orders</a>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="bg-white rounded shadow-sm p-4">
			<h4>Monthly Sales Chart</h4>
			<select class="form-select-sm" id="yearFilter">
				<option class="bg-body-secondary" value="">Select Year</option>
				<?php foreach ($years as $year) : ?>
					<option value="<?= $year['year'] ?>"><?= $year['year'] ?></option>
				<?php endforeach; ?>
			</select>
			<canvas id="salesChart"></canvas>

		</div>
	</div>



</div>


<script>
	const yearFilter = document.getElementById('yearFilter');
	const salesChartCanvas = document.getElementById('salesChart');
	let salesChart;

	function fetchAndRenderData(year = '') {
		fetch(`<?= base_url("dashboard/data_sallary"); ?>?year=${year}`)
			.then(response => response.json())
			.then(data => {
				const labels = data.map(item => `${item.month}-${item.year}`);
				const totalOrders = data.map(item => item.total_order);
				const totalSallary = data.map(item => item.total_sallary);

				if (salesChart) {
					salesChart.destroy();
				}

				const ctx = salesChartCanvas.getContext('2d');
				salesChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: labels,
						datasets: [{
							label: 'Total Salary',
							data: totalSallary,
							backgroundColor: 'rgba(55, 122, 239, 0.7)',
							borderColor: 'rgb(55, 148, 224)',
							borderWidth: 1
						}]
					},
					options: {
						responsive: true,
						scales: {
							y: {
								beginAtZero: true
							}
						}
					}
				});
			})
			.catch(error => console.error('Error fetching data:', error));
	}


	fetchAndRenderData();


	yearFilter.addEventListener('change', () => {
		const selectedYear = yearFilter.value;
		fetchAndRenderData(selectedYear);
	});
</script>
