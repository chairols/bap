<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Variables_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*
     *  Variables/agregar_ajax
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

}

?>