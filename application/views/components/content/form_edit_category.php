<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
	
    <div class="modal-dialog">
		
        <div class="modal-content">
            <form action="<?= base_url('admin/dashboard/category/edit/' . $category['category_id']) ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <a href="<?= base_url('admin/dashboard/category') ?>" class="btn-close" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" value="<?= $category['category_name'] ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('admin/dashboard/category') ?>" class="btn btn-secondary" >Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var updateProductModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        updateProductModal.show();
    });
</script>