<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
    public function index() {
        $this->load->view('chat/chat_view'); // Aseg�rate de que exista esta vista
    }

    public function sendMessage() {
        $message = $this->input->post('message');
        // Procesa el mensaje (esto puede incluir l�gica para almacenar en base de datos o enviar al WebSocket)
        echo json_encode(['status' => 'success', 'message' => $message]);
    }
}
