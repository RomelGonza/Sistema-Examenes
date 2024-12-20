<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->helper('url');
	$this->load->library('session');
    }

    public function index() {
        $this->load->view('Auth/login');
    }

    public function register() {
        $this->load->view('Auth/register');
    }
 
    public function registration_form() {
        $this->auth_model->register_user();
    }

    public function login_form() {
        $user = $this->auth_model->login_user();

        if ($user) {
            // Obtener el tipo de usuario desde la sesión
            $tipo_usuario = $this->session->userdata('tipo_usuario');

            if ($tipo_usuario == 1) {
                redirect('admin/dashboard'); // Redirigir a la vista del administrador
            } elseif ($tipo_usuario == 0) {
                redirect('user/dashboard'); // Redirigir a la vista del usuario
            } else {
                show_error('Rol no autorizado.', 403);
            }
        } else {
            $this->session->set_flashdata('error', 'Credenciales incorrectas.');
            redirect('auth');
        }
    }

    public function main() {
        $this->load->view('Auth/index');
    }
}
