<?php 
class M_checkout extends CI_model {
    public function add_to_cart($data_carts,$data_carts_items) {
        $this->db->insert('carts',$data_carts);
        $last_id = $this->db->insert_id();
        $data_carts_items['cart_id'] = $last_id;
        return $this->db->insert('cart_items',$data_carts_items);

    }

    public function insert_order_detail() {
    
    }

    public function insert_order($data) {
        return $this->db->insert('order_table',array('user_id' => $data));
    }


    public function get_all_carts_by_id($user_id) {
        return $this->db->query("
            SELECT 
                carts.user_id,
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
        ", array($user_id))->result_array();
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

    public function delete_from_carts_by_id($cart_items_id) {
        $this->db->where('cart_items_id',$cart_items_id);
        $this->db->delete('cart_items');
        return $this->db->affected_rows();
    }

    public function insert_shipping_address($data) {
        return $this->db->insert('shipping_address',$data);
    }

    public function get_shipping_address($user_id){
        return $this->db->get_where('shipping_address',array('user_id' => $user_id))->result_array();
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

   
    
}   