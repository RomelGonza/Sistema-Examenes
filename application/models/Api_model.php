<?php
class Api_model extends CI_Model {
    public function validate_token($token) {
        $this->db->where('token', $token);
        $this->db->where('token_expires_at >', date('Y-m-d H:i:s'));
        $query = $this->db->get('Usuarios');  // Usar 'Usuarios' con mayúscula
        return $query->row_array();
    }

    public function create_token($idUsuarios, $token, $expires_at) {
        $data = [
            'token' => $token,
            'token_expires_at' => $expires_at
        ];
        $this->db->where('idUsuarios', $idUsuarios);
        return $this->db->update('Usuarios', $data);  // Usar 'Usuarios' con mayúscula
    }
}
?>
