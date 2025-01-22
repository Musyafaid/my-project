

	<div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="bg-white rounded shadow-sm p-4">
                <h3 class="h6 text-muted mb-2">Total User</h3>
                <div class="h3" id="animatedNumber"><?= $this->session->userdata('totalUser') ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-white rounded shadow-sm p-4">
                <h3 class="h6 text-muted mb-2">Total Seller</h3>
                <div class="d-flex">
                    <div class="h3" id="animatedNumber2" ><?= $this->session->userdata('totalSeller') ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-white rounded shadow-sm p-4">
                <h3 class="h6 text-muted mb-2">Today's Sales</h3>
                <div class="h3"><?= $this->session->userdata('totalOrder') ?></div>
            </div>
        </div>
</div>

