<?php
class C_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') === false || empty($this->session->userdata('isLogin')) ){
            redirect('seller/login');
        }
        $this->load->model('M_product');
        $this->load->library('pagination');   
        $this->load->library('encryption');   
        $this->session->set_userdata('totalProduct',$this->M_product->count_all_by_id (null,$this->session->userdata('sellerId'))); 
      
        
    }

    public function index() {

      
       
        $data['products'] = $this->M_product->get_products(5,0);

        $data['title'] = "Seller Dashboard";
        $this->load->view('template/header');
        $this->load->view('components/ui/sidebar',$data);
        $this->load->view('page/dashboard/header');
        $this->load->view('page/dashboard/index');
        $this->load->view('page/dashboard/dashboard');
        $this->load->view('components/content/overview_product',$data);
        $this->load->view('page/dashboard/footer');
        $this->load->view('components/ui/number_animation');
        $this->load->view('components/ui/alert');
        $this->load->view('template/footer');
    }
    
    
    
    public function product($offset = 0) {
        if(!empty($this->input->post())){
            $data_product = $this->input->post();
            $data_product['seller_id'] = $this->session->userdata('sellerId');
            
            $config['upload_path'] = './public/image/uploads/products/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '1000';
            $config['max_width'] = '10240';
            $config['max_height'] = '10000';
            
            $this->load->library('upload', $config);
            
            
            
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('product_image')){
                echo "Error" ;
            }
            else{
                
                $upload_data = $this->upload->data();
                
                $hash = md5_file($upload_data['full_path']); 
                $new_file_name = $hash . $upload_data['file_ext']; 
                
                rename($upload_data['full_path'], $upload_data['file_path'] . $new_file_name);
                
                
                $data_product['product_image'] = $new_file_name;
                if(!$this->uri->segment(3) == 'update'){

                    $this->add_product($data_product);
                }
            }
        }else{
            
            $search = $this->input->get('search');
            
            if(empty($this->M_product->get_category())){
                echo "Gagal mendapatkan category";
            }
            
            $data['categories'] = $this->M_product->get_category();
            
            $config['base_url'] = base_url('dashboard/product/');
            if($this->input->get('search')){
                
                $config['total_rows'] = $this->M_product->count_all_by_id($search,$this->session->userdata('sellerId'));
                $config['reuse_query_string'] = TRUE;
            }else{
                $config['total_rows'] = $this->M_product->count_all_by_id(null,$this->session->userdata('sellerId'));

            }
            
            $config['per_page'] = 5;
            $config['uri_segment'] = 3;  
            
            $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
            $config['full_tag_close'] = '</ul>';
            
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
            
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';
            
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            
            $config['attributes'] = array('class' => 'page-link');
            
            $this->pagination->initialize($config);

            $data['navigation'] = "";
            if($this->input->get('search')){
                $data['products'] = $this->M_product->get_all_products_by_id($config['per_page'], $offset,$this->input->get('search'),$this->session->userdata('sellerId'));
                $data['navigation'] = "Back to all data";
            }else{
                $data['products'] = $this->M_product->get_all_products_by_id($config['per_page'], $offset,null,$this->session->userdata('sellerId'));
            }
            
            foreach($data['products'] as &$product){
                $product['product_id_hash'] = hash('sha256',$product['product_id']);
            }

            $this->session->set_userdata('offset',$offset);
            $data['pagination'] = $this->pagination->create_links();
            
            $data['title'] = "Seller Dashboard";
            
            $this->load->view('template/header');
            $this->load->view('components/ui/sidebar',$data);
            $this->load->view('page/dashboard/header');
            $this->load->view('page/dashboard/index');
            $this->load->view('page/dashboard/dashboard');
            $this->load->view('components/content/table_product',$data);
            $this->load->view('components/content/form_add',$data);
            $this->load->view('page/dashboard/footer');
            $this->load->view('components/ui/number_animation');
            $this->load->view('components/ui/alert');
            $this->load->view('template/footer');
        }
        
    }


    public function update_product() {

        $input_id = $this->input->get('product');

        $data['uri_segment'] = $this->session->flashdata('uriSegment');
        
        $data['products'] = $this->M_product->get_all_products_by_id(5, $this->session->userdata('offset'),null,$this->session->userdata('sellerId'));
        
        if(empty($this->M_product->get_category())){
            echo "Gagal mendapatkan category";
        }
        
        $data['categories'] = $this->M_product->get_category();
        $this->product();
        
        
        if($data['products']){

            foreach ($data['products'] as &$product) {
                $product['product_id_hash'] = hash('sha256', $product['product_id']);
                
                // If this product matches the requested ID
                if ($input_id === $product['product_id_hash']) {
                    $found = true;
                    $data['matched_product'] = $product;
                    $product_id = $product['product_id'];
                    $this->load->view('components/content/form_update', $data);
                }
                $data_product = $this->input->post();

                    if($data_product){
                        $config['upload_path'] = './public/image/uploads/products/';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size']     = '1000';
                        $config['max_width'] = '10240';
                        $config['max_height'] = '10000';
        
                        $this->load->library('upload', $config);
                        
                        $this->upload->initialize($config);
                        if ( ! $this->upload->do_upload('product_image')){
        
        
                            $this->update_data_product($product_id,$data_product);
                            echo"error";
                        
                        }else{
                            $upload_data = $this->upload->data();
                        
                            $hash = md5_file($upload_data['full_path']); 
                            $new_file_name = $hash . $upload_data['file_ext']; 
                            
                            rename($upload_data['full_path'], $upload_data['file_path'] . $new_file_name);
        
                            $data_product['product_image'] = $new_file_name;
        
                            
        
                            $this->update_data_product($product_id,$data_product);
        
                        }
                        
                    }
            }
            
            // foreach ($data['products'] as &$product) {
            //     $product['product_id_hash'] = hash('sha256', $product['product_id']);
            //     if ($input_id === $product['product_id_hash']) {
            //         $data['matched_product'] = $product;
            //         var_dump( $data['matched_product']);
            //         $product_id = $product['product_id'];
                    
            //         break;
            //     }
            // }

          
        }else{
            $this->session->set_flashdata('alertError','Failed fecth data');
        }
        
        
        return;
    }
    
    private function update_data_product($product_id,$data_product){
        
        
        if($this->M_product->update_product($product_id,$data_product)){
            var_dump($data_product);
            $this->session->set_flashdata('alertSuccess','Data successfuly update to database');
            redirect('dashboard/product/');
        }else{
            $this->session->set_flashdata('alertError','Product Failed Updated! Please Close Or Change Data Product');
            redirect('dashboard/product/update/'.$product_id);
            
        }
    }
    
    private function add_product($data_product){
        $result = $this->M_product->add_product($data_product);
        if($result){
            $this->session->set_flashdata('alertSuccess','Data successfuly add to database');
            redirect('C_dashboard/product/');
        }else{
            $this->session->set_flashdata('alertError','Data failed add to database');
            redirect('C_dashboard/product/');
        }
    }
    

   private function get_product(){
        $this->load->library('pagination');
        
        $config['base_url'] = 'C_dashboard/product/';
        $config['total_rows'] = 200;
        $config['per_page'] = 8;
        
        $this->pagination->initialize($config);
        
        echo $this->pagination->create_links();
    }

    public function product_status($product_id,$status){

        $result = $this->M_product->update_status($product_id,$status);
        if($result){
            $this->session->set_flashdata('alertSuccess', 'Product Updated! ');
            redirect('dashboard/product/');
        }else{
            $this->session->set_flashdata('alertSuccess', 'Product Failed Updated! ');
            redirect('dashboard/product/');
            
        }
    }



   public function logout() {
       
    $this->session->sess_destroy();
     redirect('seller/login/');
    }
    
    
}