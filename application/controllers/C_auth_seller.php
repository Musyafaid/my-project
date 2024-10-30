<?php
class C_auth_seller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') === true && $this->session->userdata('role') == 'seller'){
            redirect('dashboard/');
        }
        $this->load->model('M_auth_seller');        
    }

        
    public function index() {
        $data['title'] = "Seller Login";
        $this->load->view('template/header');
        $this->load->view('components/ui/auth',$data);
        $this->load->view('template/footer');
    }
        

    public function seller_register() {
        // $data['title'] = "Seller Register";
        
        
        $data = $this->input->post();
        // $data['title'] = 'Seller Register';
            $this->load->view('template/header');
            $this->load->view('components/ui/register',$data);
            $this->load->view('components/ui/alert');
            $this->load->view('template/footer');

        if(!empty($this->input->post())){
            
            $data['seller_password'] = password_hash($data['seller_password'],PASSWORD_DEFAULT);
            
                
            $result = $this->M_auth_seller->register_seller($data);
            if($result){
                $this->session->set_flashdata('alertSuccess','Register Successfuly');
                redirect('seller/register/');
            }else{
                $this->session->set_flashdata('alertError','Register Failed');
                redirect('seller/register/');
            }
        }
    } 

    public function login() {

        $email = $this->input->post('seller_email');
        $input_password = $this->input->post('seller_password');
        $data_seller = $this->M_auth_seller->get_seller($email);
    
        if (!empty($this->input->post())) {
            if ($data_seller && password_verify($input_password, $data_seller->seller_password)) {
                $this->session->set_flashdata('alertSuccess', 'Login Successfully');
                $userdata = array(
                    'isLogin' => true,
                    'role' => 'seller',
                    'sellerId' => $data_seller->seller_id,
                    'sellerEmail' =>$data_seller->seller_email,
                    'sellerShop' =>$data_seller->shop_name
                );
                $this->session->set_userdata($userdata);
                redirect('dashboard/');
            } else {
                $this->session->set_flashdata('alertError', 'Login Failed');
                redirect('seller/login/');
            }
        }

        $data['title'] = 'Seller Login';
        $this->load->view('template/header');
        $this->load->view('components/ui/auth',$data);
        $this->load->view('components/ui/alert');
        $this->load->view('template/footer');
    }
    


    // public function forgot_password() {
    //     // $config = array(
    //     //     'protocol' => 'smtp',
    //     //     'smtp_host' => 'smtp.gmail.com',
    //     //     'smtp_port' => 587,
    //     //     'smtp_user' => 'examplestoreproject@gmail.com',
    //     //     'smtp_pass' => 'ynry mxcv idcc veny',
    //     //     'smtp_crypto' => '', // or 'ssl' for port 465
    //     //     'mailtype'  => 'html', 
    //     //     'charset'   => 'utf-8',
    //     //     'wordwrap'  => TRUE,
    //     //     'smtp_timeout' => 10,
    //     //     'newline' => "\r\n",
    //     //     'smtp_debug' => 1,
    //     //     'smtp_auto_tls' => false, // Add this line to prevent auto TLS verification
    //     //     'smtp_validate_cert' => false // Add this line to disable SSL certificate validation
    //     // );

    //     $config = array(
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'smtp.gmail.com',
    //         'smtp_port' => 587,
    //         'smtp_user' => 'examplestoreproject@gmail.com',
    //         'smtp_pass' => 'ynry mxcv idcc veny',
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'newline'   => "\r\n",
    //         'smtp_crypto' => 'tls' 
    //     );
        
        
        
        


        
    //     $this->load->library('email', $config);
    //     $this->email->initialize($config);
    //     $this->email->from('examplestoreproject@gmail.com', 'Forgot Password');
    //     $this->email->to('musyafaachmaad@gmail.com');
    //     $this->email->subject('Email Test');
    //     $this->email->message('Testing the email class with SMTP.');
        
    //     if($this->email->send()){
    //         echo 'Email sent.';
    //     }else{
    //         echo 'Email failed: ' . $this->email->print_debugger();
    //     }
        
    // }

   

}
