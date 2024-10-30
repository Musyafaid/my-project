<?php
class M_product extends CI_model {
    public function get_category() {
        $this->db->select('category.category_name, 
        GROUP_CONCAT(sub_category.sub_category_id SEPARATOR ", ") AS sub_category_ids,
        GROUP_CONCAT(sub_category.sub_category_name SEPARATOR ", ") AS subcategories');
        $this->db->from('category');
        $this->db->join('sub_category', 'sub_category.category_id = category.category_id', 'left');
        $this->db->group_by('category.category_id, category.category_name');

        $query = $this->db->get();
        return $query->result();

    }

    public function add_product($data_product) {
        return $this->db->insert('product',$data_product);
    }

    public function count_all_products($keyword = null) {
        if($keyword) {
            $this->db->like('product_name', $keyword); 
        }
        return $this->db->count_all_results('product');
    }
    public function count_all_by_id($keyword = null,$id) {
        if($keyword) {
            $this->db->like('product_name', $keyword); 
        }
        $this->db->where('seller_id',$id);
        return $this->db->count_all_results('product');
    }
    
    public function get_products($limit, $offset ,$keyword = null) {
        if(!empty($keyword)){
        $this->db->like('product_name', $keyword);
        }
        $this->db->select('product.*, seller.*, sub_category.sub_category_name AS product_category');
        $this->db->from('product');
        $this->db->join('seller', 'product.seller_id = seller.seller_id', 'inner');
        $this->db->join('sub_category', 'product.sub_category_id = sub_category.sub_category_id', 'left');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }
    public function get_all_products_by_id($limit, $offset ,$keyword = null,$seller_id) {
        if(!empty($keyword)){
        $this->db->like('product_name', $keyword);
        }
        $this->db->select('product.*, seller.*, sub_category.sub_category_name AS product_category');
        $this->db->from('product');
        $this->db->join('seller', 'product.seller_id = seller.seller_id', 'inner');
        $this->db->join('sub_category', 'product.sub_category_id = sub_category.sub_category_id', 'left');
        $this->db->where('product.seller_id',$seller_id);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function count_all_products_is_sale($keyword = null) {
        $this->db->where('is_sale', 1); 
        if ($keyword) {
            $this->db->like('product_name', $keyword); 
        }
        return $this->db->count_all_results('product');
    }
    

    public function get_products_is_sale($limit, $offset ,$keyword = null) {
        if(!empty($keyword)){
        $this->db->like('product_name', $keyword);
        }

        $this->db->select('product.*, seller.*, sub_category.sub_category_name AS product_category');
        $this->db->from('product');
        $this->db->join('seller', 'product.seller_id = seller.seller_id', 'inner');
        $this->db->join('sub_category', 'product.sub_category_id = sub_category.sub_category_id', 'left');
        $this->db->where('is_sale','1');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function get_products_is_sale_by_id($product_id) {
        $this->db->select('product.*, seller.*, sub_category.sub_category_name AS product_category');
        $this->db->from('product');
        $this->db->join('seller', 'product.seller_id = seller.seller_id', 'inner');
        $this->db->join('sub_category', 'product.sub_category_id = sub_category.sub_category_id', 'left');
        $this->db->where('product.product_id', $product_id);
        $this->db->where('is_sale','1');
        return $this->db->get()->result_array();
    }
    

    public function get_product_by_id($product_id) {
        return $this->db->get_where('product',array('product_id' => $product_id))->result_array();

        
    }

    public function update_product($product_id,$product_data) {
        $this->db->where('product_id',$product_id);
        $this->db->update('product',$product_data);
        return $this->db->affected_rows();
        
    }

    public function update_status($product_id,$status) {
        $this->db->set('is_sale',$status);
        $this->db->where('product_id',$product_id);
        $this->db->update('product');
        return $this->db->affected_rows();
    }

    public function get_carts() {
    
    }
}


