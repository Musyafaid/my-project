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
    

    public function index() {
            $data['products'] = $this->M_checkout->get_all_carts_by_id($this->session->userdata('userId'));

            foreach($data['products'] as &$product){
                $product['cart_items_id_hash'] = hash('sha256',$product['cart_items_id']);
            }

            $data['shipping_address'] = $this->M_checkout->get_shipping_address($this->session->userdata('userId'));


            
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
			$check = $this->M_checkout->checking_cart( $this->input->post('product_id'));
			var_dump($check['count'] );

			if(  $check['count'] >= 1 ){

				$carts_id = $check['cart_items_id'];
				if ($this->M_checkout->increment( $check['cart_items_id'][0]['cart_items_id'])) {
				
					$this->session->set_flashdata('alertSuccess','Product success add to cart'); 
					redirect('checkout/');

				}else{

					$this->session->set_flashdata('alertError','Product failed add to cart hh');    
					redirect('');

				}
				
			}else{
				
				if($this->M_checkout->add_to_cart($data_carts,$data_carts_items)){
					$this->session->set_flashdata('alertSuccess','Product success add to cart'); 
					redirect('checkout/');

				}else{
					$this->session->set_flashdata('alertError','Product failed add to cart');    
					redirect('checkout/');

				}
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
            
            redirect('checkout/');
        } else {
            $this->session->set_flashdata('alertError', 'Cart item not found');
            redirect('checkout/');
        }
    }
    


    public function remove_carts() {
        $input_id = $this->input->get('carts');

        $data['products'] = $this->M_checkout->get_all_carts_by_id($this->session->userdata('userId'));
        
        $found = false;
        foreach($data['products'] as &$product){
            $product['cart_items_id_hash'] = hash('sha256',$product['cart_items_id']);
            if($product['cart_items_id_hash'] === $input_id){
                $carts_id = $product['cart_id'];
				var_dump($carts_items_id);
                $found = true;
                break;
            }
        }
        
        if($found == true){
            
            if($this->M_checkout->delete_from_carts_by_id($carts_id)){
				$this->session->set_flashdata('alertSuccess','Product success delete from cart'); 
				redirect('checkout/');
            }else{
                $this->session->set_flashdata('alertError','Product failed delete from cart'); 
				redirect('checkout/');

            }
        }
    }

    public function buy(){

		$this->input->post('address_id');
        $usr_id = $this->session->userdata('userId');
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
        //     redirect('checkout/');
            
        // }else{
			$this->session->set_flashdata('address_id',$this->input->post('address_id'));




            
          

            

          
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

			$data_address = $this->M_checkout->get_shipping_address_by_id($this->input->post('address_id'));
			
			foreach($data_address as $address){
				$billing_address = array(
					'first_name'    =>	$address['recipient_name'],
					'last_name'     => 	'',
					'address'       =>  $address['full_address'],
					'city'          =>	$address['city'],
					'postal_code'   => 	$address['postal_code'],
					'phone'         => 	$address['recipient_phone'],
					'country_code'  => 'IDN'
				);
				
				$shipping_address = array(
					'first_name'    =>	$address['recipient_name'],
					'last_name'     => 	'',
					'address'       =>  $address['full_address'],
					'city'          =>	$address['city'],
					'postal_code'   => 	$address['postal_code'],
					'phone'         => 	$address['recipient_phone'],
					'country_code'  => 'IDN'
				);
		
					$customer_details = array(
					'first_name'    => $address['recipient_name'],
					'last_name'     => "",
					'email'         => $this->session->userdata('userEmail'),
					'phone'         => $address['recipient_phone'],
					'billing_address'  => $billing_address,
					'shipping_address' => $shipping_address
				);
			}
			
          
            
            $transaction_data = [
                'transaction_details' => $transaction_details,
                'item_details' => $item_details,
                'customer_details' => $customer_details
            ];
            
            
            
            $snapToken = $this->midtrans->getSnapToken($transaction_data);
            if($snapToken){
				if( empty($customer_details)){
					redirect('checkout/');
				}
				// var_dump($transaction_data);
                $data['snapToken'] = $snapToken;
                $this->load->view('checkout_snap', $data);
				$this->index();
                
            }else{
                error_log(json_encode($transaction_data));
                error_log($snapToken);
                
            }
        // }  
            
            
        
        
        
        
        
        
        
    }

    public function shipping_address() {
       
        $this->form_validation->set_rules('recipient_name', 'Name', 'required');
		$this->form_validation->set_rules(
			'recipient_phone',
			'Phone Number',
			'required|numeric|min_length[10]|max_length[12]',
			array(
				'required' => 'Phone Number is required.',
				'numeric' => 'Phone Number must contain only numbers.',
				'min_length' => 'Phone Number must be at least 10 characters long.',
				'max_length' => 'Phone Number cannot exceed 12 characters.'
			)
		);
		
        $this->form_validation->set_rules('province_id', 'Provinsi', 'required');
        $this->form_validation->set_rules('city_id', 'Kota/Kabupaten', 'required');
        $this->form_validation->set_rules('district_id', 'Kecamatan', 'required');
        $this->form_validation->set_rules('subdistrict_id', 'Kelurahan', 'required');
        $this->form_validation->set_rules('address', 'Alamat Lengkap', 'required');

      if($this->input->post()){

          
          if($this->form_validation->run() == false){
              $this->session->set_flashdata('alertError','Please Insert The Shipping Address');
              
              redirect('checkout/address/');
              
            }else{     
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
            
            if($this->M_checkout->insert_shipping_address($data['shipping_address'])){
                $this->session->set_flashdata('alertSuccess','Alamat Berhasil di Simpan!');
                redirect('checkout/');
            }
        }
    }
		
        $this->load->view('template/header');
        $this->load->view('page/home/header');
        $this->load->view('components/ui/navbar_user');
        $this->load->view('components/content/form_address');
        $this->load->view('components/ui/alert');
        $this->load->view('page/home/footer');
        $this->load->view('template/footer');

    }

    public function success() {
      
     $user_Id = $this->session->userdata('userId');
	 $data_carts = $this->M_checkout->get_all_carts_by_id($user_Id);

	 if($data_carts){
		$order_id = $this->M_checkout->insert_order($user_Id);

		if ($order_id) {
			$success = true;
		
			foreach ($data_carts as $data) {
				$insert = array(
					'order_id'   => $order_id,
					'product_id' => $data['product_id'],
					'address_id' => $this->session->flashdata('address_id'),
					'quantity'   => $data['quantity'],
					'price'      => $data['price'],
					'status'     => 'waiting'
				);

				if($this->M_checkout->decrease_stock($data['product_id'], $data['quantity'])){
					$this->M_checkout->delete_from_carts_by_id($data['cart_id']);
				}


				
		
				if (!$this->M_checkout->insert_order_detail($insert)) {
					$success = false;
					break;
				}
			}
		
			if ($success) {
				$this->session->set_flashdata('alertSuccess', 'Berhasil');
                redirect('checkout/');

				
			} else {
				$this->session->set_flashdata('alertError', 'Terjadi kesalahan saat menyimpan detail pesanan!');
                redirect('checkout/');

			}
		}
		
	 }
        
    }

	
	public function history() {

		$data['orders'] = $this->M_checkout->history($this->session->userdata('userId'));
		
		// foreach(	$data['orders'] as &$order){
		// 	$order['order_id_hash'] =  hash('sha256',$order['order_id']);
		// }m
		$data['name'] = $this->session->userdata('sellerName');
		$data['email'] = $this->session->userdata('sellerEmail');

		// var_dump(	$data['orders'] );
		
		
		$data['title'] = "Seller Dashboard";
		$this->load->view('template/header');
        $this->load->view('page/home/header');
        $this->load->view('components/ui/navbar_user');
        $this->load->view('components/content/history_order',$data);
        $this->load->view('components/ui/alert');
        $this->load->view('page/home/footer');
        $this->load->view('template/footer');
    }

        


    public function logout() {
       
        $this->session->sess_destroy();
         redirect('user/login/');
    }
}
