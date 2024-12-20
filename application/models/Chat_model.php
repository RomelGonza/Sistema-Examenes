<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {

    public function getMessages() {
        $this->db->order_by('timestamp', 'ASC');
        return $this->db->get('chat_mensajes')->result();
    }

    public function saveMessage($remitente_id, $destinatario_id, $message) {
        $data = [
            'remitente_id' => $remitente_id,
            'destinatario_id' => $destinatario_id,
            'mensaje' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('chat_mensajes', $data);
    }
}