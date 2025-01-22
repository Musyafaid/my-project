<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/dashboard/sub_category/add') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category</label>
						<select class="form-control" id="categoryName" name="category_id" placeholder="Enter category name" required>
							<?php foreach($categories as $category) : ?>
								<option value="<?= $category['category_id']?>"><?= $category['category_name']?></option>
							<?php endforeach ; ?>
						</select>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="sub_category_name" placeholder="Enter category name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
