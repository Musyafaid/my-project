<div class="container my-4">
  <div class="row g-4">
    <?php foreach($products as $product) : ?>
    <div class="col-6 col-md-4 col-lg-3">
      <a href="<?= base_url('home/product/detail?detail='. $product['product_id_hash']) ?>" class="text-decoration-none">
        <div class="card h-100 border-0 shadow-sm">
          <div class="position-relative overflow-hidden">
            <img
              src="<?= base_url('./public/image/uploads/products/'. $product['product_image']) ?>"
              class="card-img-top "
              style="object-fit: contain; height:200px;"
              alt="<?= $product['product_name'] ?>"
            >
            <div class="badge bg-primary position-absolute top-0 end-0 m-2">
              Terjual 150+
            </div>
          </div>
          <div class="card-body">
            <h6 class="card-title text-truncate"><?= $product['product_name'] ?></h6>
            <p class="card-text fw-bold">Rp. <?= number_format($product['product_price'],0,',',',') ?></p>
            <div class="d-flex align-items-center">
              <i class="fas fa-map-marker-alt me-2"></i>
              <small class="text-muted"><?= $product['seller_address'] ?></small>
            </div>
            <div class="d-flex align-items-center mt-2">
              <small class="text-muted me-2"><?= $product['product_category'] ?></small>
            </div>
          </div>
        </div>
      </a>
    </div>

   
    <?php endforeach; ?>
  </div>

  <div class="d-flex justify-content-center my-4">
    <?php if($navigation) : ?>
    <a href="<?= base_url('home') ?>" class="btn btn-outline-primary"><?= $navigation ?></a>
    <?php endif; ?>
    <?= $pagination ?>
  </div>
</div>

