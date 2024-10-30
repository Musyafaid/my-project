<?php
class C_checkout extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') === false || empty($this->session->userdata('isLogin')) || empty($this->session->userdata('userId')) || $this->session->userdata('role') != 'user' ){
            $this->session->set_flashdata('alertError','Please Login!');    
            redirect('user/login');
        }
 
        $this->load->model('M_checkout');
    }
    
    public function carts() {
            $data['products'] = $this->M_checkout->get_all_carts_by_id($this->session->userdata('userId'));
    
            
            $this->load->view('template/header');
            $this->load->view('page/home/header');
            $this->load->view('components/ui/navbar_user');
            $this->load->view('page/carts/index',$data);

            $this->load->view('components/ui/alert');
    
            $this->load->view('page/home/footer');
            
            $this->load->view('template/footer');
    }
    
    public function add_to_cart() {
        $data_carts = $this->input->post();
        $user_id = $this->session->userdata('userId');
        if($data_carts){
            if($this->M_checkout->add_to_cart($user_id,$data_carts)){
                $this->session->set_flashdata('alertSuccess','Product success add to cart'); 
                redirect('');
            }else{
                $this->session->set_flashdata('alertError','Product failed add to cart');    
                redirect('');
            }
            
        }
        
    }

 

    public function remove_from_carts() {
        if($this->M_checkout->delete_from_carts_by_id($this->input->get('carts'))){
            $this->session->set_flashdata('alertSuccess','Product success delete from cart'); 
            redirect('checkout/carts/');
            
        }else{
            $this->session->set_flashdata('alertError','Product failed delete from cart'); 
            redirect('checkout/carts/');
        }
    }

    public function logout() {
       
        $this->session->sess_destroy();
         redirect('user/login/');
    }
}