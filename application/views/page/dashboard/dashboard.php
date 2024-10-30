<div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="bg-white rounded shadow-sm p-4">
                <h3 class="h6 text-muted mb-2">Total Products</h3>
                <div class="h3" id="animatedNumber"><?= $this->session->userdata('totalProduct') ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-white rounded shadow-sm p-4">
                <h3 class="h6 text-muted mb-2">Total Income</h3>
                <div class="d-flex">
                    <h3>Rp. </h3>
                    <div class="h3" id="animatedNumber2" >24334324</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-white rounded shadow-sm p-4">
                <h3 class="h6 text-muted mb-2">Today's Sales</h3>
                <div class="h3">0</div>
            </div>
        </div>
</div>