<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resultado extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Resultado_model');
    }

    public function index() {
 	$this->load->view('resultados/formulario_consulta');

    }

    public function consultar() {
        $dni = $this->input->post('dni');

        if ($dni) {
            $data['resultados'] = $this->Resultado_model->buscar_resultados($dni);
           
            $this->load->view('resultados/mostrar_resultados', $data);
           
        } else {
            // Manejar el caso en que no se proporcione un DNI válido
            $this->session->set_flashdata('error', 'Por favor ingrese un DNI válido.');
            redirect('resultado');
        }
    }
     }
?>
