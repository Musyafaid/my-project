<?php 
class M_checkout extends CI_model {
    public function add_to_cart($user_id,$data_carts) {
        $this->db->insert('carts',array('user_id' => $user_id));
        $last_id = $this->db->insert_id();
        $data_carts['cart_id'] = $last_id;
        return $this->db->insert('cart_items',$data_carts);

    }

    public function get_all_carts_by_id($user_id) {
        return $this->db->query("
            SELECT 
                carts.user_id,
                cart_items.cart_items_id,
                cart_items.quantity,
                cart_items.price,
                SUM(cart_items.quantity * cart_items.price) AS total_price,
                product.product_name,
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

    public function delete_from_carts_by_id($cart_items_id) {
        $this->db->where('cart_items_id',$cart_items_id);
        $this->db->delete('cart_items');
        return $this->db->affected_rows();
    }
    
}   