<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('chat_model');
        $this->load->library('session');
        
        // Verificar sesión
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }
    
    public function index() {
        $data['user_id'] = $this->session->userdata('user_id');
        $data['role'] = $this->session->userdata('rol');
        $this->load->view('chat/index', $data);
    }
    
    public function get_agents() {
        header('Content-Type: application/json');
        $agents = $this->chat_model->get_agents();
        echo json_encode($agents);
    }
    
    public function get_messages() {
        header('Content-Type: application/json');
        $other_user_id = $this->input->get('other_user_id');
        $user_id = $this->session->userdata('user_id');
        
        $messages = $this->chat_model->get_messages($user_id, $other_user_id);
        echo json_encode($messages);
    }
    
    public function get_pending_chats() {
        header('Content-Type: application/json');
        if ($this->session->userdata('rol') !== 'admin') {
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }
        
        $pending = $this->chat_model->get_pending_chats($this->session->userdata('user_id'));
        echo json_encode($pending);
    }
    
    public function send() {
        header('Content-Type: application/json');
        $receiver_id = $this->input->post('receiver_id');
        $message = $this->input->post('message');
        $sender_id = $this->session->userdata('user_id');
        
        $result = $this->chat_model->save_message($sender_id, $receiver_id, $message);
        
        echo json_encode(['status' => $result ? 'success' : 'error']);
    }
}
