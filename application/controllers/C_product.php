<?php
class C_product extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_product');
        $this->load->library('pagination');
    }

    public function search() {
        var_dump($this->input->get());
    }


}