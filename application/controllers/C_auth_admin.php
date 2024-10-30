<?php
class C_auth_super_admin extends CI_Controller {
    public function index() {
        $data['title'] = "Admin Login";
        $this->load->view('template/header');
        $this->load->view('components/ui/auth',$da);
    $this->load->view('template/footer');
    }
}