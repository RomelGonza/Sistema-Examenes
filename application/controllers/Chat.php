<?php
class Chat extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('chat_model');
        $this->load->library('session');
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }
    
    public function index() {
        $data['user_id'] = $this->session->userdata('user_id');
        $data['role'] = $this->session->userdata('rol');
        $this->load->view('view_chat', $data);
    }
    
    public function get_agents() {
        // Get all admin users
        $agents = $this->chat_model->get_agents();
        echo json_encode($agents);
    }
    
    public function get_messages() {
        $other_user_id = $this->input->get('other_user_id');
        $user_id = $this->session->userdata('user_id');
        
        $messages = $this->chat_model->get_messages($user_id, $other_user_id);
        echo json_encode($messages);
    }
    
    public function send() {
        $receiver_id = $this->input->post('receiver_id');
        $message = $this->input->post('message');
        $sender_id = $this->session->userdata('user_id');
        
        $result = $this->chat_model->save_message($sender_id, $receiver_id, $message);
        
        echo json_encode(['status' => $result ? 'success' : 'error']);
    }
}
<?
