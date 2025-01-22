<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    <?php if( $this->session->flashdata('alertSuccess') ) : ?>
    function alertSuccess(){

        Swal.fire({
            title: 'Berhasil !',
            text: '<?= $this->session->flashdata('alertSuccess') ?>',
            icon: 'success'
        });
    }

    alertSuccess();
    
    <?php endif ; ?>

    <?php if ( $this->session->flashdata('alertError' ) ) : ?>
    
    function alertError(){
        Swal.fire({
            title: 'Gagal !',
            icon: 'error',
            title: '<?= $this->session->flashdata('alertError') ?>',
            text: 'Something went wrong!'
        });
    }

    alertError();



    <?php endif ; ?>

    function confirmLogout() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
               <?php if($this->session->userdata('role') == 'admin') : ?>
				window.location.href = '<?= base_url('admin/logout') ?>'; // Change to your logout URL
				<?php else : ?>
					window.location.href = '<?= base_url('dashboard/logout/') ?>'; // Change to your logout URL
				<?php endif ; ?>
            }
        });
    }

    function confirmaction(id, is_sale) {
        if (is_sale === 1) {
            Swal.fire({
                title: 'Warning',
                text: "Are you sure you want to remove from sale?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Remove!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url('dashboard/product/') ?>' + id + '/0';
                }
            });
        } else {
            Swal.fire({
                title: 'Warning',
                text: "Are you sure you want to sale this product?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url('dashboard/product/') ?>' + id + '/1';
                }
            });
        }
    }


   
    
</script>