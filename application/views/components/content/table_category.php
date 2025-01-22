
<div class="container py-4">
    <div class="row">
        <div class="col-md">
            <div class="bg-white rounded shadow-sm px-4">
                <h2 class="h5 mb-4">Category Management</h2>

				<div class="d-flex justify-content-between gap-2">
				<button type="button" class="btn btn-primary my-3 " data-bs-toggle="modal" data-bs-target="#addCategoryModal">
					<i class="bi bi-plus-circle me-2"></i> Add New Category
				
				</button>

				<form class="form-inline d-flex my-3" action="<?= base_url("admin/dashboard/category") ?>" method="get">
					<input class="form-control mr-sm-2" type="search" name="search" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>" placeholder="Search" aria-label="Search">
					<button class="btn my-2 my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
					<?php if(!$this->session->flashdata('search')) : ?>
						
					<a href="<?= base_url('admin/dashboard/category?reset=reset'); ?>" class="btn btn-secondary">Reset</a>

					<?php endif ; ?>
				</form>

				</div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-3">
                        <thead class="table-light">
                            <tr>
                            
                                <th scope="col">Category Name</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category) : ?>
                                <tr>
                                
                                    <td><?= $category['category_name'] ?></td>
                                    <td class="text-center">
                                        <div class="btn-group gap-1">
                                            <a href="<?= base_url('admin/dashboard/category/edit/' . $category['category_id']) ?>" 
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/dashboard/category/delete/' . $category['category_id']) ?>" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this category?');"
                                                title="Delete">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pagination ?>
                </div>
            </div>
        </div>
    </div>
</div>

