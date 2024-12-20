<?php

class auth_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    public function register_user() {
        $password = $this->input->post('password');
        $con_password = $this->input->post('con_password');

        if ($password != $con_password) {
            $this->session->set_flashdata('wrong', 'Las contraseñas no coinciden!');
            redirect('Auth/register');
        } else {
            $data = array(
		"usuario" => $this->input->post('usuario'),
                "nombres" => $this->input->post('nombre'),
		"apellidos" => $this->input->post('apellido'),
                "email" => $this->input->post('email'),
                "password" => password_hash($password, PASSWORD_BCRYPT), // Hasheamos la contraseña
                "tipo_usuario" => $this->input->post('tipo_usuario') 
            );

            $this->db->insert('Usuarios', $data);
            $this->session->set_flashdata('suc', 'Ya estas registrado, por favor Inicia Sesion');
            redirect('Auth/');
        }
    }
 
    public function login_user() {
        $email = $this->input->post('usuario');
        $password = $this->input->post('password');

        $this->db->where('usuario', $email);
        $query = $this->db->get('Usuarios');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                $this->session->set_userdata('user_id', $user->id_usuarios); // Guarda el ID del usuario en la sesión
                $this->session->set_userdata('tipo_usuario', $user->tipo_usuario); // Guarda el tipo de usuario en la sesión
                $this->session->set_flashdata('suc', 'You are logged in');
                return $user;
            } else {
                $this->session->set_flashdata('warning', '¡Contraseña o usuario incorrecto!!!');
                redirect('Auth/');
            }
        } else {
            $this->session->set_flashdata('warning', '¡Contraseña o usuario incorrecto!!!');
            redirect('Auth/');
        }

        return false;
    }
    public function get_all_users() {
	 $query = $this->db->get('usuarios'); 
	return $query->result_array(); }
}
?>
