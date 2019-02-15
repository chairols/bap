<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Variables_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*
     *  Variables/agregar_ajax
     *  Variables/modificar
     */

    public function get_where($where) {
        $query = $this->db->get_where('variables', $where);
        return $query->row_array();
    }

    /*
     *  Variables/agregar_ajax
     */

    public function set($datos) {
        $this->db->insert('variables', $datos);
        return $this->db->insert_id();
    }

    /*
     *  Variables/listar
     */
    public function get_cantidad_pendientes($variable) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad
                                    FROM
                                        variables
                                    WHERE
                                        variable LIKE '%$variable%'");
        
        return $query->row_array();
    }
    
    /*
     *  Variables/listar
     */
    public function gets_where_variable_limit($variable, $pagina, $cantidad_por_pagina) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        variables
                                    WHERE
                                        variable LIKE '%$variable%'
                                    ORDER BY
                                        variable
                                    LIMIT $pagina, $cantidad_por_pagina");
        return $query->result_array();
    }
    
    /*
     *  Variables/modificar_ajax
     */
    public function update($datos, $where) {
        $this->db->update('variables', $datos, $where);
        return $this->db->affected_rows();
    }
}

?>