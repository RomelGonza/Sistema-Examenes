<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/JWT/JWT.php';

use \Firebase\JWT\JWT;

class Api extends CI_Controller {
    private $key = "tu_clave_secreta";

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('User_model');
        $this->load->model('Api_model');
        $this->load->helper(['form', 'url']);
        $this->load->library(['session']);
    }

    public function generate_token() {
        $username = $this->input->post('usuario');
        $password = $this->input->post('password');
        
        $user = $this->User_model->get_user_by_username($username);
        
        if ($user && password_verify($password, $user['password'])) {
            if (!isset($user['idUsuarios'])) {
                echo json_encode(['error' => 'User ID not found']);
                return;
            }

            $payload = [
                'id' => $user['idUsuarios'],
                'username' => $user['usuario']
            ];
            $token = JWT::encode($payload, $this->key, 'HS256');
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour')); // Expira en una hora
            
            // Actualiza el token en la tabla Usuarios
            $this->Api_model->create_token($user['idUsuarios'], $token, $expires_at);

            echo json_encode(['token' => $token]);
        } else {
            echo json_encode(['error' => 'Invalid username or password']);
        }
    }

    public function consulta($token) {
        $user = $this->Api_model->validate_token($token);

        if (!$user) {
            $this->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Invalid token']));
            return;
        }

        $name = $this->input->get('nombre');

        if ($name === null) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Nombre no proporcionado']));
            return;
        }

        $user = $this->User_model->get_user_by_name($name);

        if ($user) {
            // Limitar la respuesta a solo nombres, apellidos y email
            $filtered_user = [
                'nombres' => $user['nombres'],
                'apellidos' => $user['apellidos'],
                'email' => $user['email']
            ];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true, 'usuario' => $filtered_user]));
        } else {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Usuario no encontrado']));
        }
    }
}
?>
