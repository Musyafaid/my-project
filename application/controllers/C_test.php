<?php
class C_test extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library('encryption');
        }

    public function index() {
        $this->load->view('template/header');
        $this->load->view('page/seller/index',$data);
        $this->load->view('template/footer');
    }
    public function auth() {
        
        $this->load->view('template/header');
        $this->load->view('components/ui/register');
        $this->load->view('template/footer');
    }
}