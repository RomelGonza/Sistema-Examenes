<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta_model extends CI_Model {

    // Método para obtener todos los datos
    public function obtener_datos() {
        // Ejemplo: consulta a la tabla que necesites
        $query = $this->db->get('Usuarios'); // Cambia 'usuarios' por el nombre real de tu tabla
        return $query->result();
    }

    // Método para buscar registros según un parámetro
    public function buscar_por_parametro($parametro) {
        $this->db->like('nombre', $parametro); // Cambia 'nombre' por la columna que necesites
        $query = $this->db->get('Usuarios'); // Cambia 'usuarios' por el nombre real de tu tabla
        return $query->result();
    }
}
