<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'auth_helper']);
        $this->load->model(['auth_model', 'Resultado_model']);
    }

    public function dashboard() {
        $data['title'] = 'Dashboard - Admin';
        $this->load->view('admin/dashboard'); // Asegúrate de tener esta vista
    }
    public function resultados_view() { 

	$data['title'] = 'Resultados de Admisión'; 
	$data['resultados'] = 
	$this->Resultado_model->obtener_resultados(); 
	 
	$this->load->view('admin/resultados_view', $data); 
	 }

    public function resultados() {
        $data['title'] = 'Gestión de Resultados';
        $data['resultados'] = $this->Resultado_model->obtener_resultados();
        $data['carreras'] = $this->Resultado_model->obtener_carreras();

        $this->load->view('admin/resultados_view', $data);
    }

    public function importar_resultados() {
 
        if ($_FILES && $_FILES['archivo']['name']) {
            $anio = $this->input->post('anio');
            $semestre = $this->input->post('semestre');
            $contenido = file_get_contents($_FILES['archivo']['tmp_name']);
            $lineas = explode("\n", $contenido);

            $carrera_actual = '';
            $insertados = 0;

            foreach ($lineas as $linea) {
                if (strpos($linea, ']') !== false && preg_match('/

\[(.*?)\]

\s*(.*?)$/i', $linea, $matches)) {
                    $carrera_actual = trim($matches[2]);
                    continue;
                }

                if (preg_match('/^\s*(\d+)\s+(\d{8})\s+(.*?)\s+(\d+\.\d+)\s*$/', $linea, $matches)) {
                    $data = array(
                        'puesto' => $matches[1],
                        'dni' => $matches[2],
                        'apellidos_nombres' => trim($matches[3]),
                        'puntaje' => $matches[4],
                        'carrera' => $carrera_actual,
                        'anio' => $anio,  // Añadir el año
                        'semestre' => $semestre  // Añadir el semestre
                    );

                    if ($this->Resultado_model->insertar_resultado($data)) {
                        $insertados++;
                    }
                }
            }

            $this->session->set_flashdata('success', "Se importaron $insertados registros correctamente");
        }
        redirect('admin/resultados');
    }

    public function buscar_resultados() {
        $termino = $this->input->get('q');
        $carrera = $this->input->get('carrera');
        $anio = $this->input->get('anio'); // Añadir filtro de año
        $semestre = $this->input->get('semestre'); // Añadir filtro de semestre

        $resultados = $this->Resultado_model->buscar_resultados($termino, $carrera, $anio, $semestre);

        echo json_encode($resultados);
    }
}
?>
