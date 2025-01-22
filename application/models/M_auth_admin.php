<?php 
class M_auth_admin extends CI_model {

	public function get_admin($email) {
        $this->db->where('admin_email',$email);
        return $this->db->get('super_admin')->row();
    }
	public function register_admin($data_admin) {
        return $this->db->insert('super_admin',$data_admin);
    }
}