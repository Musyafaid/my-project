<?php
class M_auth_seller extends CI_model {
    public function get_seller($email) {
        $this->db->where('seller_email',$email);
        return $this->db->get('seller')->row();
    }

    public function register_seller($data_seller) {
        return $this->db->insert('seller',$data_seller);
    }
}
