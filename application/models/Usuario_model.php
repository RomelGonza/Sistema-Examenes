<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Método para insertar un usuario
    public function insertarUsuario($data) {
        return $this->db->insert('Usuarios', $data);
    }
}
