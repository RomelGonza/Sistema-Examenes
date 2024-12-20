<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

    public function index() {
        $data['title'] = 'Acerca de Nosotros - ExamTrack';
        $data['user'] = $this->session->userdata();
        
        // Cargar las vistas
        $this->load->view('request/index', $data);
    }
}
