<?php
class C_auth_user extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') === true && !empty($this->session->userdata('userId'))  && $this->session->userdata('role') == 'user'){
            redirect('');
        }
        $this->load->model('M_auth_user');        
    }

        
    public function index() {
        $data['title'] = "User Login";
        $this->load->view('template/header');
        $this->load->view('components/content/auth',$data);
        $this->load->view('template/footer');
    }
        

    public function user_register() {

        
        $data = $this->input->post();
 
            $this->load->view('template/header');
            $this->load->view('components/content/register_user',$data);
            $this->load->view('components/ui/alert');
            $this->load->view('template/footer');

        if(!empty($this->input->post())){
            
            $data['user_password'] = password_hash($data['user_password'],PASSWORD_DEFAULT);
            
                
            $result = $this->M_auth_user->register_user($data);
            if($result){
                $this->session->set_flashdata('alertSuccess','Register Successfuly');
                redirect('user/register/');
            }else{
                $this->session->set_flashdata('alertError','Register Failed');
                redirect('user/register/');
            }
        }
    } 

    public function login() {

        $email = $this->input->post('user_email');
        $input_password = $this->input->post('user_password');
        $data_user = $this->M_auth_user->get_user($email);
    
        if (!empty($this->input->post())) {
            if ($data_user && password_verify($input_password, $data_user->user_password)) {
                $this->session->set_flashdata('alertSuccess', 'Login Successfully');
                $userdata = array(
                    'isLogin' => true,
                    'role' => 'user',
                    'userId' => $data_user->user_id,
                    'userEmail' =>$data_user->user_email
                );
                $this->session->set_userdata($userdata);
                redirect('');
            } else {
                $this->session->set_flashdata('alertError', 'Login Failed');
                redirect('user/login/');
            }
        }

        $data['title'] = 'User Login';
        $this->load->view('template/header');
        $this->load->view('components/content/auth_user',$data);
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
