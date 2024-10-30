<div class="modal fade top-0 " id="updateProductModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog  position-relative">
        <div class="modal-content position-absolute" style="top: -20px;">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="updateModalLabel">Update Product</h5>
                <a href="<?= base_url('dashboard/product/'. $this->session->flashdata('uriSegment')) ?>"  class="btn-close btn-close-white"></a>
            </div>
            <div class="modal-body">
                
                <form action="" method="POST" enctype="multipart/form-data" id="updateProductForm">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label for="product_name" class="form-label small">Product Name</label>
                            <input type="text" class="form-control form-control-sm" id="product_name" name="product_name" value="<?= $matched_product['product_name'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="product_price" class="form-label small">Price</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control form-control-sm" id="product_price" name="product_price" step="0.01" value="<?= $matched_product['product_price'] ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-1">
                        <label for="description" class="form-label small">Description</label>
                        <textarea class="form-control form-control-sm" id="description" name="description" rows="2" required><?= $matched_product['description'] ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label for="product_stock" class="form-label small">Stock</label>
                            <input type="number" class="form-control form-control-sm" id="product_stock" name="product_stock" min="0" value="<?= $matched_product['product_stock'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="sale_status" class="form-label small">Sale Status</label>
                            <select class="form-select form-select-sm" id="sale_status" name="is_sale" required>
                                <option value="" disabled>Select status</option>
                                <option value="0" <?= $matched_product['is_sale'] == 0 ? 'selected' : '' ?>>Off Sale</option>
                                <option value="1" <?= $matched_product['is_sale'] == 1 ? 'selected' : '' ?>>On Sale</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="product_image" class="form-label small">Update Image</label>
                            <input type="file" class="form-control form-control-sm" id="product_image" name="product_image" accept="image/*">
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="sale_status" class="form-label small">Category</label>
                            <select class="form-select form-select-sm" id="sale_status" name="sub_category_id" required>
                                <optgroup label="-">
                                    <option disabled>Choose Category</option>
                                </optgroup>
                                <?php foreach ($categories as $category): ?>
                                    <optgroup label="<?= htmlspecialchars($category->category_name); ?>">
                                        <?php
                                        $subcategories = explode(',', $category->subcategories);
                                        $subcategory_ids = explode(',', $category->sub_category_ids); 

                                        foreach ($subcategories as $index => $subcategory): ?>
                                            <option value="<?= trim($subcategory_ids[$index]); ?>" <?= trim($subcategory_ids[$index]) == $matched_product['sub_category_id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars(trim($subcategory)); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label small">Current Image</label>
                            <img id="current_image" src="<?= base_url('./public/image/uploads/products/'. $matched_product['product_image']) ?>" alt="Current product image" class="img-thumbnail d-block" style="height: 150px;">   
                        </div>
                        
                    </div>
                </form>
     
            </div>
            <div class="modal-footer bg-light">
                <a href="<?= base_url('dashboard/product/'. $uri_segment ) ?>" class="btn btn-secondary btn-sm" >Close</a>
                <button type="submit" form="updateProductForm" class="btn btn-warning btn-sm">Update Product</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var updateProductModal = new bootstrap.Modal(document.getElementById('updateProductModal'));
        updateProductModal.show();
    });
</script>