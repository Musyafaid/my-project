<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monthly Sales Chart</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      text-align: center;
    }
    canvas {
      max-width: 600px;
      margin: 20px auto;
    }
    select {
      margin: 20px;
      padding: 10px;
    }
  </style>
</head>
<body>
  <h1>Monthly Sales Chart</h1>
  <select id="yearFilter">
	  <option class="bg-body-secondary" value="">Select Year</option>
	<?php foreach ($years as $year) : ?>
		<option value="<?= $year['year'] ?>"><?= $year['year'] ?></option>
	<?php endforeach ; ?>
  </select>

  <canvas id="salesChart"></canvas>

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
              datasets: [
                {
                  label: 'Total Salary',
                  data: totalSallary,
                  backgroundColor: 'rgba(255, 159, 64, 0.2)',
                  borderColor: 'rgb(64, 220, 255)',
                  borderWidth: 1
                }
              ]
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
</body>
</html>
