<?php 
class M_checkout extends CI_model {
    public function add_to_cart($data_carts,$data_carts_items) {
        $this->db->insert('carts',$data_carts);
        $last_id = $this->db->insert_id();
        $data_carts_items['cart_id'] = $last_id;
        return $this->db->insert('cart_items',$data_carts_items);

    }


    public function insert_order_detail($data_detail) {
		
	
		return $this->db->insert('order_detail',$data_detail);
		
    }

    public function insert_order($data) {
		$this->db->insert('order_table',array('user_id' => $data));
        return $this->db->insert_id();
    }


    public function get_all_carts_by_id($user_id) {
        return $this->db->query("
            SELECT 
                carts.user_id,
                carts.cart_id,
                carts.seller_id,
                cart_items.cart_items_id,
                cart_items.quantity,
                cart_items.price,
                SUM(cart_items.quantity * cart_items.price) AS total_price,
                product.product_name,
                product.product_id,
                product.product_stock,
                product.product_image,
                product.description,
                seller.shop_name
            FROM 
                carts
            INNER JOIN 
                cart_items ON carts.cart_id = cart_items.cart_id
            INNER JOIN 
                product ON cart_items.product_id = product.product_id
            INNER JOIN 
                seller ON product.seller_id = seller.seller_id
            WHERE 
                carts.user_id = ?
            GROUP BY 
                carts.updated_at DESC, 
                product.seller_id, 
                cart_items.cart_items_id,
                cart_items.quantity,
                cart_items.price,
                product.product_name,
                product.product_image,
                product.description,
                seller.shop_name;
        ", array($user_id))->result_array();
    }
    public function count_all_carts_by_id($user_id) {
        $query = $this->db->query("
            SELECT 
                carts.user_id,
                carts.cart_id,
                carts.seller_id,
                cart_items.cart_items_id,
                cart_items.quantity,
                cart_items.price,
                SUM(cart_items.quantity * cart_items.price) AS total_price,
                product.product_name,
                product.product_id,
                product.product_image,
                product.description,
                seller.shop_name
            FROM 
                carts
            INNER JOIN 
                cart_items ON carts.cart_id = cart_items.cart_id
            INNER JOIN 
                product ON cart_items.product_id = product.product_id
            INNER JOIN 
                seller ON product.seller_id = seller.seller_id
            WHERE 
                carts.user_id = ?
            GROUP BY 
                carts.updated_at DESC, 
                product.seller_id, 
                cart_items.cart_items_id,
                cart_items.quantity,
                cart_items.price,
                product.product_name,
                product.product_image,
                product.description,
                seller.shop_name;
        ", array($user_id));

		return $query->num_rows();

    }

	public function checking_cart($product_id) {
		$this->db->select('cart_items_id');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('cart_items');
		
		$result = $query->result_array();
		$count = $query->num_rows();
		
		return [
			'cart_items_id' => $result,
			'count' => $count
		];
	}
	
    public function increment($cart_items_id) {
        if(!$cart_items_id) return 0;
    
        $this->db->set('quantity', 'quantity + 1', FALSE);
        $this->db->where('cart_items_id', $cart_items_id);
        $this->db->update('cart_items');
        
        return $this->db->affected_rows();
    }

    public function decrement($cart_items_id) {
        if(!$cart_items_id) return 0;
    
        $this->db->set('quantity', 'quantity - 1', FALSE);
        $this->db->where('cart_items_id', $cart_items_id);
        $this->db->update('cart_items');
        
        return $this->db->affected_rows();
    }

    public function delete_from_carts_by_id($carts_id) {
		$this->db->where('cart_id',$carts_id);
        $this->db->delete('carts');
        
        return $this->db->affected_rows();
    }


    public function insert_shipping_address($data) {
        return $this->db->insert('shipping_address',$data);
    }

    public function get_shipping_address($user_id){
        return $this->db->get_where('shipping_address',array('user_id' => $user_id))->result_array();
    }
	
    public function get_shipping_address_by_id($shipping_id){
        return $this->db->get_where('shipping_address',array('address_id' => $shipping_id))->result_array();
    }

    public function buy($user_Id) {
        $this->db->where('user_id', $user_Id);
        return $this->db->delete('carts');
    }

    public function decrease_stock($product_id,$quantity) {
        $this->db->set('product_stock', 'product_stock-'.$quantity.'', FALSE); 
        $this->db->where('product_id', $product_id);
        $this->db->update('product'); 
        if ($this->db->affected_rows() > 0) {
            return true; 
        }
    }

	public function history($user_id ) { 
		$query = $this->db->query("
 		SELECT 
		order_table.order_id, 
		product.product_name,
		seller.seller_name,
		seller.shop_name,
		SUM(order_detail.quantity * order_detail.price) AS total_price,
		GROUP_CONCAT(order_detail.product_id) AS product_ids,
		MAX(order_detail.status) AS latest_status

		FROM order_table
		INNER JOIN order_detail ON order_detail.order_id = order_table.order_id
		INNER JOIN `user` ON user.user_id = order_table.user_id
		INNER JOIN product ON product.product_id = order_detail.product_id
		INNER JOIN seller ON seller.seller_id = product.seller_id
		WHERE order_table.user_id = ?
		GROUP BY order_table.order_id DESC;
		",array($user_id));

		return $result = $query->result_array();

}

   
    
}   
