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
}
?>