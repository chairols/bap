<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paises_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /*
     *  comunidades/agregar
     */
    public function gets() {
        $this->db->select('*');
        $this->db->from('paises');
        $this->db->where(array('estado'=>'A'));
        $this->db->order_by('pais');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /*
     *  Paises/listar
     */
    public function get_cantidad_paises($pais) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad
                                    FROM
                                        paises
                                    WHERE
                                        pais LIKE '%$pais%'");
        
        return $query->row_array();
    }
    
    /*
     *  Paises/listar
     */
    public function gets_where_paises_limit($pais, $pagina, $cantidad_por_pagina) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        paises
                                    WHERE
                                        pais LIKE '%$pais%' 
                                    ORDER BY
                                        pais
                                    LIMIT $pagina, $cantidad_por_pagina");
        return $query->result_array();
    }
    
    /*
     *  Comunidades/listar
     * 
     *  Paises/agregar_ajax
     */
    public function get_where($where) {
        $query = $this->db->get_where('paises', $where);
        return $query->row_array();
    }
    
    /*
     *  Paises/agregar_ajax
     */
    public function update($data, $where) {
        $this->db->update('paises', $data, $where);
        return $this->db->affected_rows();
    }
    
    /*
     *  Paises/agregar_ajax
     */
    public function set($datos) {
        $this->db->insert('paises', $datos);
        return $this->db->insert_id();
    }
}
?>