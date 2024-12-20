<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resultado_model extends CI_Model {
    
    private $table = 'resultados_admision';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insertar_resultado($data) {
        return $this->db->insert($this->table, $data);
    }
    
    public function obtener_resultados() {
        $this->db->order_by('carrera', 'ASC');
        $this->db->order_by('puesto', 'ASC');
        return $this->db->get($this->table)->result();
    }
    
    public function obtener_carreras() {
        $this->db->distinct();
        $this->db->select('carrera');
        $this->db->order_by('carrera', 'ASC');
        return $this->db->get($this->table)->result();
    }
    
    public function buscar_resultados($termino, $carrera = null, $anio = null, $semestre = null) {
        if ($carrera) {
            $this->db->where('carrera', $carrera);
        }

        if ($anio) {
            $this->db->where('anio', $anio);
        }

        if ($semestre) {
            $this->db->where('semestre', $semestre);
        }
        
        if ($termino) {
            $this->db->group_start();
            $this->db->like('apellidos_nombres', $termino);
            $this->db->or_like('dni', $termino);
            $this->db->group_end();
        }
        
        $this->db->order_by('carrera', 'ASC');
        $this->db->order_by('puesto', 'ASC');
        return $this->db->get($this->table)->result();
    }
}
?>

