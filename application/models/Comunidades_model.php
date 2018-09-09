<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidades_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    /*
     *  Comunidades/agregar
     */
    public function get_where($where) {
        $query = $this->db->get_where('comunidades', $where);
        return $query->row_array();
    }
    
    /*
     *  Comunidades/agregar_ajax
     */
    public function set($datos) {
        $this->db->insert('comunidades', $datos);
        return $this->db->insert_id();
    }
    
    /*
     *  Comunidades/listar
     */
    public function get_cantidad($code, $estado) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad
                                    FROM
                                        comunidades
                                    WHERE
                                        comunidad LIKE '%$code%' AND
                                        estado = '$estado'");
        return $query->row_array();
    }
    
    /*
     *  Comunidades/listar
     */
    public function gets_limit($comunidad, $pagina, $cantidad, $estado) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        comunidades
                                    WHERE
                                        comunidad LIKE '%$comunidad%' AND
                                        estado = '$estado' 
                                    ORDER BY
                                        comunidad
                                    LIMIT $pagina, $cantidad");
        return $query->result_array();
    }
}
?>