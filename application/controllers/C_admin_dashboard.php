<?php
class C_admin_dashboard extends CI_Controller {


    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') === false || empty($this->session->userdata('isLogin')) || empty($this->session->userdata('adminId'))){
            redirect('admin/login');
        }
        $this->load->model('M_admin');
        $this->load->model('M_product');
       
        $this->session->set_userdata('totalUser',$this->M_admin->count_user ()); 
		$this->session->set_userdata('totalSeller',$this->M_admin->count_seller()); 
		$this->session->set_userdata('totalOrder',$this->M_admin->count_order()); 
        
    }

    public function index() {
       

		
		$data['name'] = $this->session->userdata('adminName');
		$data['email'] = $this->session->userdata('adminEmail');
		

        $data['title'] = "Seller Dashboard";
        $this->load->view('template/header');
        $this->load->view('components/ui/sidebar',$data);
        $this->load->view('page/dashboard/header');
        $this->load->view('page/dashboard/index');
        $this->load->view('page/dashboard/dashboard_admin');
        $this->load->view('page/dashboard/footer');
        $this->load->view('components/ui/number_animation');
        $this->load->view('components/ui/alert');
        $this->load->view('template/footer');
    }

	
    

    
	public function category() {
		$this->load->library('pagination');
	
		// Reset pencarian
		if ($this->input->get('reset') == 'reset') {
			$this->session->set_userdata('search', '');
			$search = '';
		} else {
			// Ambil nilai pencarian
			$search = $this->input->get('search');
			if ($search !== null) {
				$this->session->set_userdata('search', $search);
			} else {
				$search = $this->session->userdata('search');
			}
		}
	
		// Konfigurasi Pagination
		$config['base_url'] = base_url('admin/dashboard/category');
		$config['total_rows'] = $this->M_admin->count_all_categories($search); // Hitung jumlah hasil
		$config['per_page'] = 5; // Jumlah item per halaman
		$config['page_query_string'] = TRUE; // Gunakan query string
		$config['query_string_segment'] = 'page'; // Segmen query string untuk pagination
	
		// Styling Pagination
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['attributes'] = ['class' => 'page-link'];
	
		$this->pagination->initialize($config);
	
		// Ambil halaman saat ini
		$page = $this->input->get('page') ? (int)$this->input->get('page') : 0;
	
		// Ambil data dari model
		$data['categories'] = $this->M_admin->get_categories_with_search_and_pagination($search, $config['per_page'], $page);
		$data['pagination'] = $this->pagination->create_links();
		$data['search'] = $search; // Kirim nilai pencarian ke view
		$data['name'] = $this->session->userdata('adminName');
		$data['email'] = $this->session->userdata('adminEmail');
	
		// Load views
		$this->load->view('template/header');
		$this->load->view('components/ui/sidebar', $data);
		$this->load->view('components/content/table_category', $data);
		$this->load->view('components/content/form_add_category', $data);
		$this->load->view('components/ui/alert');
		$this->load->view('template/footer');
	}
	
	
	

    
    public function add() {
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        if ($this->form_validation->run() === TRUE) {
            $data = ['category_name' => $this->input->post('category_name')];
          
			if(  $this->M_admin->insert_category($data)){
				$this->session->flashdata('alertSuccess','Category successfuly add');
			}
            redirect('admin/dashboard/category');

        } else {
            redirect('admin/dashboard/category');

        }
    }
	
    public function edit($id) {
		$data['category'] = $this->M_admin->get_category_by_id($id);
		
		$data['name'] = $this->session->userdata('adminName');
		$data['email'] = $this->session->userdata('adminEmail');
		
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        if ($this->form_validation->run() === TRUE) {
            $update_data = ['category_name' => $this->input->post('category_name')];
			
			if(  $this->M_admin->update_category($id, $update_data)){
				$this->session->set_flashdata('alertSuccess','Category has Change');
			}
            redirect('admin/dashboard/category');
        } else {
			
			$this->category();
			$this->load->view('components/content/form_edit_category', $data);
			
        }
    }

	public function delete($id) {
		if ($this->M_admin->delete_category($id)) {
			$this->session->set_flashdata('alertSuccess', 'Category has been deleted successfully!');
		} else {
			$this->session->set_flashdata('alertError', 'Failed to delete category. It may be linked to existing products.');
		}
		
		redirect('admin/dashboard/category');
	}
	
	
	
	
	public function sub_category() {
		$this->load->library('pagination');

			 
		$data['categories'] = $this->M_admin->get_all_category();
		if(!$data['categories']){
			echo "Gagal mendapatkan category";
		}
		
		// var_dump($data['categories']);
		
		
		if ($this->input->get('reset') == 'reset') {
			$this->session->set_userdata('search', '');
			$search = '';
		} else {
			$search = $this->input->get('search');
			if ($search !== null) {
				$this->session->set_userdata('search', $search);
			} else {
				$search = $this->session->userdata('search');
			}
		}
		
		$config['base_url'] = base_url('admin/dashboard/sub_category');
		$config['total_rows'] = $this->M_admin->count_all_sub_categories($search); // Hitung jumlah hasil
		$config['per_page'] = 5; // Jumlah item per halaman
		$config['page_query_string'] = TRUE; // Gunakan query string
		$config['query_string_segment'] = 'page'; // Segmen query string untuk pagination
		
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['attributes'] = ['class' => 'page-link'];
		
		$this->pagination->initialize($config);
	
		$page = $this->input->get('page') ? (int)$this->input->get('page') : 0;
	
		$data['sub_categories'] = $this->M_admin->get_sub_categories_with_search_and_pagination($search, $config['per_page'], $page);
		$data['pagination'] = $this->pagination->create_links();
		$data['search'] = $search; 
		$data['name'] = $this->session->userdata('adminName');
		$data['email'] = $this->session->userdata('adminEmail');
	
		$this->load->view('template/header');
		$this->load->view('components/ui/sidebar', $data);
		$this->load->view('components/content/table_sub_category', $data);
		$this->load->view('components/content/form_add_sub_category', $data);
		$this->load->view('components/ui/alert');
		$this->load->view('template/footer');
	}
	

	public function add_sub_category() {

	
		
		
		$this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'required');
		$this->form_validation->set_rules('category_id', 'Category Id', 'required');
		if ($this->form_validation->run() === TRUE) {
			$data = [
				'sub_category_name' => $this->input->post('sub_category_name'),
				'category_id' => $this->input->post('category_id')
			];
			
		  
			if(  $this->M_admin->insert_sub_category($data)){
				$this->session->flashdata('alertSuccess','Sub Category successfuly add');
			}

			var_dump($data);
			redirect('admin/dashboard/sub_category');
	
		} else {
			redirect('admin/dashboard/sub_category');
	
		}
	}

	public function edit_sub_category($id) {
		$data['sub_category'] = $this->M_admin->get_sub_category_by_id($id);
		
		$data['name'] = $this->session->userdata('adminName');
		$data['email'] = $this->session->userdata('adminEmail');
		
        $this->form_validation->set_rules('sub_category_name', 'Category Name', 'required');
        if ($this->form_validation->run() === TRUE) {
            $update_data = ['sub_category_name' => $this->input->post('sub_category_name')];
			if(  $this->M_admin->update_sub_category($id, $update_data)){
				$this->session->set_flashdata('alertSuccess','Category has Change');
			}
            redirect('admin/dashboard/sub_category');
        } else {
			
			$this->sub_category();
			$this->load->view('components/content/form_edit_sub_category', $data);
			
        }
    }


	public function delete_sub_category($id) {
		if ($this->M_admin->delete_sub_category($id)) {
			$this->session->set_flashdata('alertSuccess', 'Category has been deleted successfully!');
		} else {
			$this->session->set_flashdata('alertError', 'Failed to delete category. It may be linked to existing products.');
		}
		
		redirect('admin/dashboard/sub_category');
	}
	
	
	
	
	
	public function logout() {
       
		$this->session->sess_destroy();
		redirect('admin/login/');
    }
    
    
}
