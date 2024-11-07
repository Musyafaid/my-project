<?php
class C_checkout extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') === false || empty($this->session->userdata('isLogin')) || empty($this->session->userdata('userId')) || $this->session->userdata('role') != 'user' ){
            $this->session->set_flashdata('alertError','Please Login!');    
            redirect('user/login');
        }
        $params = array('server_key' => 'SB-Mid-server-WAWrwB05nx2IycDZaQhQilNw', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
        $this->load->model('M_checkout');
    }
    
    public function carts() {
            $data['products'] = $this->M_checkout->get_all_carts_by_id($this->session->userdata('userId'));

            foreach($data['products'] as &$product){
                $product['cart_items_id_hash'] = hash('sha256',$product['cart_items_id']);
            }

            $data['shipping_address'] = $this->M_checkout->get_shipping_address($this->session->userdata('userId'));

            var_dump(  $data['shipping_address'] );

            
            $this->load->view('template/header');
            $this->load->view('page/home/header');
            $this->load->view('components/ui/navbar_user');
            $this->load->view('page/carts/index',$data);

            $this->load->view('components/ui/alert');
    
            $this->load->view('page/home/footer');
            
            $this->load->view('template/footer');
    }
    

    public function add_to_cart() {
        $data_carts_items = array(
            'product_id' => $this->input->post('product_id'),
            'quantity' => $this->input->post('quantity'),
            'price' => $this->input->post('price')
        );
        $data_carts = array(
            'user_id' => $this->session->userdata('userId'),
            'seller_id' => $this->input->post('seller_id')
        );
        if($data_carts){
            var_dump($data_carts);
            if($this->M_checkout->add_to_cart($data_carts,$data_carts_items)){
                $this->session->set_flashdata('alertSuccess','Product success add to cart'); 
                redirect('');
            }else{
                $this->session->set_flashdata('alertError','Product failed add to cart');    
                redirect('');
            }
            
        }
        
    }


    public function update_carts() {
        $input_id = $this->input->get('increment') ?: $this->input->get('decrement');
        
        $data['products'] = $this->M_checkout->get_all_carts_by_id($this->session->userdata('userId'));
    
        $found = false;
        $carts_id = null;
        
        foreach ($data['products'] as $product) {
            $product['cart_items_id_hash'] = hash('sha256', $product['cart_items_id']);
            if ($product['cart_items_id_hash'] === $input_id) {
                $carts_id = $product['cart_items_id'];
                $found = true;
                break;
            }
        }
    
        if ($found) {
            if ($this->input->get('increment')) {
                $success = $this->M_checkout->increment($carts_id);
            } else {
                $success = $this->M_checkout->decrement($carts_id);
            }
    
            if ($success) {
                $this->session->set_flashdata('alertSuccess', 'Update success');
            } else {
                $this->session->set_flashdata('alertError', 'Update failed');
            }
            
            redirect('checkout/carts/');
        } else {
            $this->session->set_flashdata('alertError', 'Cart item not found');
            redirect('checkout/carts/');
        }
    }
    


    public function remove_carts() {
        $input_id = $this->input->get('carts');

        $data['products'] = $this->M_checkout->get_all_carts_by_id($this->session->userdata('userId'));
        
        $found = false;
        foreach($data['products'] as &$product){
            $product['cart_items_id_hash'] = hash('sha256',$product['cart_items_id']);
            if($product['cart_items_id_hash'] === $input_id){
                $carts_id = $product['cart_items_id'];
                $found = true;
                break;
            }
        }
        
        if($found == true){
            
            if($this->M_checkout->delete_from_carts_by_id($carts_id)){
                $this->session->set_flashdata('alertSuccess','Product success delete from cart'); 
                redirect('checkout/carts/');
                
            }else{
                $this->session->set_flashdata('alertError','Product failed delete from cart'); 
                redirect('checkout/carts/');
            }
        }
    }

    public function buy(){
        $usr_id = 1;
        $grossAmount = 0;
        $data['products'] = $this->M_checkout->get_all_carts_by_id($usr_id);

        
        $data['sub_total'] = 0;
        $data['sub_total'] = [];

        // $this->form_validation->set_rules('province_id', 'Provinsi', 'required');
        // $this->form_validation->set_rules('city_id', 'Kota/Kabupaten', 'required');
        // $this->form_validation->set_rules('district_id', 'Kecamatan', 'required');
        // $this->form_validation->set_rules('subdistrict_id', 'Kelurahan', 'required');
        // $this->form_validation->set_rules('address', 'Alamat Lengkap', 'required');
        
        
        
        // if($this->form_validation->run() == false){
        //     $this->session->set_flashdata('alertError','Please Insert The Shipping Adress');
        //     redirect('checkout/carts/');
            
        // }else{
            // var_dump($this->input->post());
            
          

            

          
            foreach($data['products'] as $carts){
                
                $sub_total =  $carts['price'] * $carts['quantity'];
                
                $item_details[] = [
                    'id' => $carts['product_id'],
                    'price' => $carts['price'],
                    'quantity' => $carts['quantity'],
                    'name' => $carts['product_name']
                    
                ];
                
                $carts['checkout'][] = $item_details;
                $grossAmount += (int) $sub_total;
                
                $carts['sub_total'] = $sub_total;
                // $carts['gross_amount'] = $grossAmount;
            }
            
            $transaction_details = [
                'order_id' => uniqid(),
                'gross_amount' => $grossAmount
            ];

            $billing_address = array(
                'first_name'    => $this->input->post('name'),
                'last_name'     => "",
                'address'       => $this->input->post('address'),
                'city'          => $this->input->post('selected_city_name'),
                'postal_code'   => $this->input->post('selected_postal_code'),
                'phone'         => $this->input->post('num_phone'),
                'country_code'  => 'IDN'
            );
            
            $shipping_address = array(
                'first_name'    => $this->input->post('name'),
                'last_name'     => "",
                'address'       => $this->input->post('address'),
                'city'          => $this->input->post('selected_city_name'),
                'postal_code'   => $this->input->post('selected_postal_code'),
                'phone'         => $this->input->post('num_phone'),
                'country_code'  => 'IDN'
            );
    
                $customer_details = array(
                'first_name'    =>  $this->input->post('name'),
                'last_name'     => "",
                'email'         => $this->session->userdata('userEmail'),
                'phone'         => $this->input->post('num_phone'),
                'billing_address'  => $billing_address,
                'shipping_address' => $shipping_address
            );
            
            $transaction_data = [
                'transaction_details' => $transaction_details,
                'item_details' => $item_details,
                'customer_details' => $customer_details
            ];
            
            
            
            $snapToken = $this->midtrans->getSnapToken($transaction_data);
            if($snapToken){
                $data['snapToken'] = $snapToken;
                $this->load->view('checkout_snap', $data);
                
                
            }else{
                error_log(json_encode($transaction_data));
                error_log($snapToken);
                
            }
        // }  
            
            
        
        
        
        
        
        
        
    }

    public function shipping_address() {
        $data['shipping_address'] = [
            'user_id'           => $this->session->userdata('userId'), 
            'recipient_name'    => $this->input->post('recipient_name'),
            'recipient_phone'   => $this->input->post('recipient_phone'),
            'province'          => $this->input->post('selected_province_name'),
            'city'              => $this->input->post('selected_city_name'),
            'district'          => $this->input->post('selected_district_name'),
            'subdistrict'       => $this->input->post('selected_subdistrict_name'),
            'full_address'      => $this->input->post('address'), 
            'postal_code'       => $this->input->post('selected_postal_code'),
            'notes'             => $this->input->post('catatan')
        ];
    }

    public function success() {
        $data['products'] = $this->M_checkout->get_all_carts_by_id(1);
     
        if($this->M_checkout->insert_order($this->session->userdata('userId'))){
            foreach($data['products'] as $carts){
                
                $sub_total =  $carts['price'] * $carts['quantity'];
                
                // $item_details[] = [
                    //     'id' => $carts['product_id'],
                    //     'price' => $carts['price'],
                    //     'quantity' => $carts['quantity'],
                    //     'name' => $carts['product_name']
                    
                    // ];
    
                    $data['buy'] = array(
                        'user_id' => $this->session->userdata('userId'),
                    );

                    $data['order_detail'] = [
                        ''
                    ];
                    
                    
                    $this->M_checkout->decrease_stock($carts['product_id'],$carts['quantity']);
                    
                    
                    echo "<pre>";
                    print_r ( $carts['product_id']);
                    echo "</pre>";
                    
                    
                    // $carts['gross_amount'] = $grossAmount;
                }
                
                
              
                if($this->M_checkout->buy($this->session->userdata('userId'))){
                   echo "This succes";
                }
            }

        }

        


    public function logout() {
       
        $this->session->sess_destroy();
         redirect('user/login/');
    }
}