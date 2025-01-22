<?php
class C_auth_admin extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('M_auth_admin');
		}

	
    public function register() {
        
        
        $data = $this->input->post();
            $this->load->view('template/header');
            $this->load->view('components/content/register_admin',$data);
            $this->load->view('components/ui/alert');
            $this->load->view('template/footer');

        if(!empty($this->input->post())){
            
            $data['admin_password'] = password_hash($data['admin_password'],PASSWORD_DEFAULT);
            
                
            $result = $this->M_auth_admin->register_admin($data);
            if($result){
                $this->session->set_flashdata('alertSuccess','Register Successfuly');
                redirect('admin/register/');
            }else{
                $this->session->set_flashdata('alertError','Register Failed');
                redirect('admin/register/');
            }
        }
    } 

 

	public function login() {

        $email = $this->input->post('admin_email');
        $input_password = $this->input->post('admin_password');
        $data_admin = $this->M_auth_admin->get_admin($email);
    
        if (!empty($this->input->post())) {
            if ($data_admin && password_verify($input_password, $data_admin->admin_password)) {
                $this->session->set_flashdata('alertSuccess', 'Login Successfully');
                $userdata = array(
                    'isLogin' => true,
                    'role' => 'admin',
                    'adminId' => $data_admin->admin_id,
                    'adminName' => $data_admin->admin_name,
                    'adminEmail' =>$data_admin->admin_email
                );
                $this->session->set_userdata($userdata);
                redirect('admin/dashboard/');
            } else {
                $this->session->set_flashdata('alertError', 'Login Failed');
                redirect('admin/login/');
            }
        }

        $data['title'] = 'Admin Login';
        $this->load->view('template/header');
        $this->load->view('components/content/auth_admin',$data);
        $this->load->view('components/ui/alert');
        $this->load->view('template/footer');
    }
}
