<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_role')) {
    function check_role($required_role) {
        $ci = &get_instance();
        $user_role = $ci->session->userdata('tipo_usuario'); 

        if ($user_role !== $required_role) {
            redirect('auth/no_permission'); 
            exit;
        }
    }
}
?>
