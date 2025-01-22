<?php 
class M_admin extends CI_model {
	public function count_user() {
		$query = $this->db->get('user');
		return $query->num_rows();
	}
	public function count_seller() {
		$query = $this->db->get('seller');
		return $query->num_rows();
	}
	public function count_order() {
		$query = $this->db->get('order_table');
		return $query->num_rows();
	}

	public function get_all_categories() {
        return $this->db->get('category')->result_array();
    }

    public function insert_category($data) {
        return $this->db->insert('category', $data);
    }

    public function get_category_by_id($category_id) {
        return $this->db->get_where('category', ['category_id' => $category_id])->row_array();
    }

    public function update_category($category_id, $data) {
        return $this->db->where('category_id', $category_id)->update('category', $data);
    }

	public function delete_category($id) {
		$this->db->delete('category', ['category_id' => $id]);
		return $this->db->affected_rows();
	}
	

	public function count_all_categories($search) {
		$this->db->like('category_name', $search);
		$query = $this->db->get('category');
		return $query->num_rows();
	}
	
	public function get_categories_with_pagination($limit, $start, $search = '') {
		$this->db->like('category_name', $search); 
		$query = $this->db->get('category', $limit, $start);
		return $query->result_array();
	}

	
	public function get_categories_with_search_and_pagination($search, $limit, $start) {
		$this->db->like('category_name', $search);
		$this->db->limit($limit, $start);
		$query = $this->db->get('category');
		return $query->result_array();
	}


	public function count_all_sub_categories($search) {
		$this->db->like('sub_category_name', $search);
		$query = $this->db->get('sub_category');
		return $query->num_rows();
	}

	public function get_sub_categories_with_search_and_pagination($search, $limit, $start) {
		$this->db->like('sub_category_name', $search);
		$this->db->limit($limit, $start);
		$query = $this->db->get('sub_category');
		return $query->result_array();
	}

	public function get_all_category() {
		return $this->db->get('category')->result_array();

	
	}

	
    public function get_sub_category_by_id($sub_category_id) {
        return $this->db->get_where('sub_category', ['sub_category_id' => $sub_category_id])->row_array();
    }

	public function insert_sub_category($data) {
		return $this->db->insert('sub_category',$data);
	}

	public function delete_sub_category($id) {
		$this->db->delete('sub_category', ['sub_category_id' => $id]);
		return $this->db->affected_rows();
	}

	public function update_sub_category($sub_category_id, $data) {
        return $this->db->where('sub_category_id', $sub_category_id)->update('sub_category', $data);
    }



}
