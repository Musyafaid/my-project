
    <div class="container py-4">
        <!-- Header -->
        <div class="bg-white rounded shadow-sm p-4 mb-4">
            <h1 class="h3">Product & Income Dashboard</h1>
            <p class="text-muted">Manage products and track income</p>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="bg-white rounded shadow-sm p-4">
                    <h3 class="h6 text-muted mb-2">Total Products</h3>
                    <div class="h3">0</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white rounded shadow-sm p-4">
                    <h3 class="h6 text-muted mb-2">Total Income</h3>
                    <div class="h3">$0</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white rounded shadow-sm p-4">
                    <h3 class="h6 text-muted mb-2">Today's Sales</h3>
                    <div class="h3">0</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Product Management -->
            <div class="col-md-6">
                <div class="bg-white rounded shadow-sm p-4">
                    <h2 class="h5 mb-4">Product Management</h2>
                    
                    <!-- Product Form -->
                    <form class="mb-4">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>

                    <!-- Products Table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sample Product</td>
                                    <td>$99.99</td>
                                    <td>10</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary">Edit</button>
                                            <button class="btn btn-outline-danger">Delete</button>
                                            <button class="btn btn-outline-success">Record Sale</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Income Overview -->
            <div class="col-md-6">
                <div class="bg-white rounded shadow-sm p-4">
                    <h2 class="h5 mb-4">Income Overview</h2>
                    
                    <!-- Income Chart Placeholder -->
                    <div class="bg-light rounded mb-4" style="height: 300px;">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <p class="text-muted">Chart Area</p>
                        </div>
                    </div>

                    <!-- Income Table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-10-21</td>
                                    <td>Sample Product</td>
                                    <td>$99.99</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>