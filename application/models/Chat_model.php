<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {
    public function get_agents() {
        return $this->db
            ->select('idUsuarios, nombres, apellidos')
            ->where('rol', 'admin')
            ->get('usuarios')
            ->result();
    }
    
    public function get_messages($user_id, $other_user_id) {
        return $this->db
            ->where('(remitente_id = ' . $user_id . ' AND destinatario_id = ' . $other_user_id . ')')
            ->or_where('(remitente_id = ' . $other_user_id . ' AND destinatario_id = ' . $user_id . ')')
            ->order_by('timestamp', 'ASC')
            ->get('chat_mensajes')
            ->result();
    }
    
    public function save_message($sender_id, $receiver_id, $message) {
        $data = [
            'remitente_id' => $sender_id,
            'destinatario_id' => $receiver_id,
            'mensaje' => $message,
            'timestamp' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->db->insert('chat_mensajes', $data);
    }
    
    public function get_pending_chats($admin_id) {
        return $this->db
            ->select('DISTINCT u.idUsuarios as sender_id, u.nombres, u.apellidos')
            ->from('chat_mensajes cm')
            ->join('usuarios u', 'u.idUsuarios = cm.remitente_id')
            ->where('cm.destinatario_id', $admin_id)
            ->where('u.rol', 'estudiante')
            ->get()
            ->result();
    }
}
