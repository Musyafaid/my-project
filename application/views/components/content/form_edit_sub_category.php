<!-- Edit Category Modal -->
<div class="modal fade" id="editSubCategoryModal" tabindex="-1" aria-labelledby="editSubCategoryModalLabel" aria-hidden="true">
	
    <div class="modal-dialog">
		
        <div class="modal-content">
            <form action="<?= base_url('admin/dashboard/sub_category/edit/' . $sub_category['sub_category_id']) ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubCategoryModalLabel">Edit Sub Category</h5>
                    <a href="<?= base_url('admin/dashboard/sub_category') ?>" class="btn-close" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="category_name" class="form-label">Sub Category Name</label>
                        <input type="text" name="sub_category_name" id="category_name" class="form-control" value="<?= $sub_category['sub_category_name'] ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('admin/dashboard/sub_category') ?>" class="btn btn-secondary" >Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var updateProductModal = new bootstrap.Modal(document.getElementById('editSubCategoryModal'));
        updateProductModal.show();
    });
</script>