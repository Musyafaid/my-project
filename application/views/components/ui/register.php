
<div class="bg-light">
    <div class="container py-5 d-flex justify-content-center">
        <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">Seller Register</h2>
                        <form action="<?= base_url('C_auth_seller/seller_register') ?>" method="POST" id="registrationForm">
                            <div class="w-100 d-flex gap-4">

                                <div class="w-50">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="seller_name" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Shop Name</label>
                                        <input type="text" class="form-control" name="shop_name" placeholder="Enter your shop name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="email" class="form-control" name="seller_email" placeholder="name@example.com" required>
                                        <div class="form-text">We'll never share your email with anyone else.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" name="seller_phone" placeholder="Enter your phone number" required>
                                    </div>
                            </div>
                            <div class="w-50">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" id="password" class="form-control" name="seller_password" placeholder="Create a password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm your password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="seller_address" rows="3" placeholder="Enter your shop address" required></textarea>
                                </div>
                            </div>
                        </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">
                                    I agree to the Terms and Conditions
                                </label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Register as Seller</button>
                            </div>
                            <a href="<?= base_url('seller/login/') ?>">Have a account?clik here..</a>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault(); 
        
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
      
        if (password !== confirmPassword) {
            alert('Passwords do not match!'); 
        } else {
            this.submit(); 
        }
    });
</script>
