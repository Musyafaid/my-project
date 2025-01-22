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
        
        
        $data = $this->input->post();
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
    //     //     'smtp_auto_tls' => false,
    //     //     'smtp_validate_cert' => false 
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

   
	
	public function send() {
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 587,
			'smtp_user' => 'examplestoreproject@gmail.com',
			'smtp_pass' => 'phtq cpym iigj twuo', 
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n",
			'smtp_crypto' => 'tls' 
		);
		
		$this->email->initialize($config); 
		$verification_code = "8881988";
		$email = "musyafaachmaad@gmail.com";
		
		$this->email->from('examplestoreproject@gmail.com', 'My Store');
		$this->email->to($email);
		
		$verification_link = site_url('C_user/verify_email/register/' . urlencode($email) . '/' . urlencode($verification_code));
		
		$subject = 'Email verification';
		$message = '
		<html>
		<head>
			<style>
				body {
					font-family: Arial, sans-serif;
					color: #333;
					margin: 0;
					padding: 0;
				}
				.container {
					width: 80%;
					margin: 0 auto;
					padding: 20px;
					background-color: #f4f4f4;
					border-radius: 8px;
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
				}
				.header {
					background-color: #548CA8;
					color: #fff;
					padding: 10px;
					border-radius: 8px 8px 0 0;
					text-align: center;
				}
				.content {
					padding: 20px;
					text-align: center;
				}
				.footer {
					background-color: #334257;
					color: #fff;
					text-align: center;
					padding: 10px;
					border-radius: 0 0 8px 8px;
				}
				a {
					color: #548CA8;
					text-decoration: none;
					font-weight: bold;
				}
				a:hover {
					text-decoration: underline;
				}
			</style>
		</head>
		<body>
			<div class="container">
				<div class="header">
					<h1>Email Verification</h1>
				</div>
				<div class="content">
					<p>Dear User,</p>
					<p>This your verification email</p>
					<p><a href="' . $verification_link . '">Verify Email</a></p>
					<p>If you did not request this, please ignore this email.</p>
				</div>
				<div class="footer">
					<p>&copy; 2024 My Store. All rights reserved.</p>
				</div>
			</div>
		</body>
		</html>';
	
		$this->email->subject($subject);
		$this->email->message($message);
		
		if ($this->email->send()) {
			return true;
		} else {
			log_message('error', $this->email->print_debugger());
			return false;
		}
	}

}	

