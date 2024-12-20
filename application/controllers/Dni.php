<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dni extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Dni_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('dni/dni_view');
    }

    public function consultar() {
        $dni = $this->input->post('dni');
        
        // Validar DNI (8 dígitos)
        if (!preg_match("/^[0-9]{8}$/", $dni)) {
            $this->session->set_flashdata('worng', 'DNI inválido. Debe contener 8 dígitos.');
            redirect('dni');
            return;
        }

        try {
            $resultado = $this->Dni_model->consultar_dni($dni);
            
            if ($resultado) {
                $this->session->set_flashdata('suc', 'Consulta exitosa');
                $this->session->set_userdata('datos_dni', $resultado);
            } else {
                $this->session->set_flashdata('worng', 'No se encontraron datos para el DNI ingresado');
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('worng', 'Error al consultar el DNI: ' . $e->getMessage());
        }
        
        redirect('dni');
    }
}
