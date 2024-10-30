
<!-- <div class="container py-4"> -->
    <!-- Header -->

    <style>
        th,td{
            font-size: smaller;
            text-align:center;
        }
    </style>

    <div class="row g-4">
        <!-- Product Management -->
        <div class="col-md">
            <div class="bg-white rounded shadow-sm px-4">
                <h2 class="h5 mb-4">Product Management</h2>

                <!-- Products Table -->
                <div class="table-responsive">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="bi bi-plus-circle me-2"></i>Add New Product
                    </button>
                    <form class="form-inline d-flex my-3" action="" method="get">
                        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn my-2 my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <table class="table table-hover table-striped align-middle mb-3">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product) : ?>
                            <tr>
                                <td><?= $product['product_name'] ?></td>
                                <td>Rp. <?= number_format($product['product_price'],0,',',',') ?></td>
                                <td><?= $product['product_stock'] ?></td>
                                <td>
                                    
                                <?php if ($product['is_sale'] == 1): ?>
                                    <i class="fas fa-check-circle" style="color: green;"></i> <!-- Success icon -->
                                <?php else: ?>
                                    <i class="fas fa-times-circle" style="color: red;"></i> <!-- "X" icon -->
                                <?php endif; ?>
                       
                                </td>
                                <?php $this->session->set_flashdata('uriSegment',$this->uri->segment(3)) ?>

                                <td class="text-center">
                                    <div class="btn-group gap-1">
                                        <a   href="<?= base_url('dashboard/product/update?product=' . $product['product_id']) ?>"
                                            class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>   
                                    <button onclick="confirmaction(<?= $product['product_id'] ?>,<?= $product['is_sale'] ?>) " class="btn btn-sm btn-dark" title="Record Sale">
                                            <i class="bi bi-cart-plus"></i> Status
                                        </button>
                                        <a class="btn btn-sm btn-success" title="Record Sale">
                                            <i class="bi bi-cart-plus"></i> Record Sale
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach ; ?>
                            <!-- Repeat for other rows -->
                        </tbody>
                    </table>
                    <?php if($navigation) : ?>
                        <a href="<?= base_url('dashboard/product/') ?>"><?= $navigation ?></a>
                    <?php endif ; ?>
                    <?= $pagination ?>
                </div>
            </div>
        </div>
    </div>

    
   