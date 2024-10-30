<?php
 
$dataPoints = array(
	array("label"=> "Food + Drinks", "y"=> 590),
	array("label"=> "Activities and Entertainments", "y"=> 261),
	array("label"=> "Health and Fitness", "y"=> 158),
	array("label"=> "Shopping & Misc", "y"=> 72),
	array("label"=> "Transportation", "y"=> 191),
	array("label"=> "Rent", "y"=> 573),
	array("label"=> "Travel Insurance", "y"=> 126)
);
	
?>

<style>
    th,td{
        font-size: smaller;
        text-align:center;
    }      

    .canvasjs-chart-credit{
        display: none;
    }
</style>
<div   div class="row g-4">
    <!-- Product Management -->
    <div class="col-md-6" >
        <div class="bg-white rounded shadow-sm p-4">
            <h2 class="h5 mb-4">Product Management</h2>
            <div class="table-responsive">
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Name</th>
                  
                            <th>Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product) : ?>
                        <tr >
                            <td class=" w-50 text-truncate h-auto"><?= $product['product_name'] ?></td>
                           
                            <td class=" w-25 text-truncate h-auto"><?= $product['product_stock'] ?></td>
                            <td class=" w-25 text-truncate h-auto" class="text-center">
                                <?php if ($product['is_sale'] == 1): ?>
                                        <i class="fas fa-check-circle" style="color: green;"></i> <!-- Success icon -->
                                <?php else: ?>
                                    <i class="fas fa-times-circle" style="color: red;"></i> <!-- "X" icon -->
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach ; ?>
                    </tbody>
                </table>

                <a href="<?= base_url('dashboard/product/') ?>">See all product..</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="bg-white rounded shadow-sm p-4">
            <h2 class="h5 mb-4">Income Overview</h2>
            
            <div class="bg-light rounded mb-4" style="height: 300px;">
                <div  class="d-flex h-100 w-100">
                  <div id="chartContainer"></div>
                </div>
            </div>

            
        </div>
    </div>
</div>

<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "World Energy Consumption by Sector - 2012"
	},
	data: [{
		type: "pie",
		indexLabel: "{y}",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{label}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

