<?php
class M_auth_user extends CI_model {
    public function get_user($email) {
        $this->db->where('user_email',$email);
        return $this->db->get('user')->row();
    }

    public function register_user($data_user) {
        return $this->db->insert('user',$data_user);
    }
}