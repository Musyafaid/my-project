<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalLabel">Add New Product</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data" id="productForm">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="product_name" class="form-label small">Product Name</label>
                                <input type="text" class="form-control form-control-sm" id="product_name" name="product_name" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="product_price" class="form-label small">Price</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control form-control-sm" id="product_price" name="product_price" step="0.01" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="description" class="form-label small">Description</label>
                            <textarea class="form-control form-control-sm" id="description" name="description" rows="2" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="product_stock" class="form-label small">Stock</label>
                                <input type="number" class="form-control form-control-sm" id="product_stock" name="product_stock" min="0" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="product_image" class="form-label small">Image</label>
                                <input type="file" class="form-control form-control-sm" id="product_image" name="product_image" accept="image/*" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="category" class="form-label small">Category</label>
                                
                                <select class="form-select form-select-sm" id="category" name="sub_category_id" required>
                                    <optgroup label="-">
                                        <option disabled selected>Choose Category</option>
                                    </optgroup>
                                    <?php foreach ($categories as $category): ?>
                                        <optgroup label="<?= $category->category_name; ?>">
                                            <?php
                                            $subcategories = explode(',', $category->subcategories);
                                            $subcategory_ids = explode(',', $category->sub_category_ids); 

                                            foreach ($subcategories as $index => $subcategory): ?>
                                                <option value="<?= trim($subcategory_ids[$index]); ?>"><?= trim($subcategory); ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="sale_status" class="form-label small">Sale Status</label>
                                <select class="form-select form-select-sm" id="sale_status" name="is_sale" required>
                                    <option value="">Select status</option>
                                    <option value="0">Off Sale</option>
                                    <option value="1">On Sale</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="productForm" class="btn btn-primary btn-sm">Save Product</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize all tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const productForm = document.getElementById('productForm');
            
        });
    </script>