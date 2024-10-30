
<div class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- Login Form -->
            <div class="col-md-6 mb-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4"><?= $title ?></h2>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="text" class="form-control" name="user_email" placeholder="name@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="user_password" placeholder="Enter your password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="#" class="text-decoration-none">Forgot password?</a><br>
                                <a href="<?= base_url('user/register/') ?>" class="text-decoration-none">Dont Have An Account ? Click here...</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        
        </div>
    </div>

    <!-- Optional Alert for Success/Error Messages -->
    <!-- <div class="position-fixed bottom-0 end-0 p-3">
        <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Registration successful! You can now login.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div> -->
