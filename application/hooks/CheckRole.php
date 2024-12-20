<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckRole {

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function check($required_role) {
        // Obtener el rol del usuario actual
        $user_id = $this->CI->session->userdata('user_id');
        if (!$user_id) {
            redirect('login'); 
        }

        // Obtener el rol del usuario desde la base de datos
        $this->CI->load->model('User_model');
        $user_roles = $this->CI->User_model->get_user_roles($user_id);

        // Verificar si el usuario tiene el rol requerido
        if (!in_array($required_role, $user_roles)) {
            show_error('No tienes permisos para acceder a esta pagina.', 403);
        }
    }
}
