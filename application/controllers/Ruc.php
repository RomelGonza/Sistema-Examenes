<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ruc extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Ruc_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('ruc/ruc_view');
    }

    public function consultar() {
        $ruc = $this->input->post('ruc');
        
        // Validar ruc (8 dÃƒÂ­gitos)
        if (!preg_match("/^[0-9]{11}$/", $ruc)) {
            $this->session->set_flashdata('worng', 'ruc invÃƒÂ¡lido. Debe contener 8 dÃƒÂ­gitos.');
            redirect('ruc');
            return;
        }

        try {
            $resultado = $this->Ruc_model->consultar_ruc($ruc);
            
            if ($resultado) {
                $this->session->set_flashdata('suc', 'Consulta exitosa');
                $this->session->set_userdata('datos_ruc', $resultado);
            } else {
                $this->session->set_flashdata('worng', 'No se encontraron datos para el ruc ingresado');
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('worng', 'Error al consultar el ruc: ' . $e->getMessage());
        }
        
        redirect('ruc');
    }
}
