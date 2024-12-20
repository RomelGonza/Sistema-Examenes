<?php
class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_user_by_username($username) {
        $this->db->where('usuario', $username);
        $query = $this->db->get('Usuarios');  // Usar 'Usuarios' con mayúscula
        return $query->row_array();
    }

    public function get_user_by_name($name) {
        $this->db->where('nombres', $name);
        $query = $this->db->get('Usuarios');  // Usar 'Usuarios' con mayúscula
        return $query->row_array();
    }
}
?>
