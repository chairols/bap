<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /*
     *  Usuarios/login
     */
    public function get_usuario($usuario, $password) {
        $query = $this->db->query("SELECT 
                                        idusuario,
                                        usuario,
                                        nombre,
                                        apellido,
                                        email,
                                        idcomunidad_activa,
                                        estado
                                    FROM
                                        usuarios
                                    WHERE
                                        usuario = '$usuario' AND
                                        password = '$password'");
        return $query->row_array();
    }
    
    /*
     *  Usuarios/login
     */
    public function get_perfil($where) {
        $query = $this->db->get_where('usuarios_comunidades', $where);
        
        return $query->row_array();
    }
    
    /*
     *  Usuarios/login
     */
    public function update($where, $idusuario) {
        $this->db->update('usuarios', $where, array('idusuario' => $idusuario));
    }

    /*
     *  Usuarios/registrar_ajax
     */
    public function get_where($where) {
        $query = $this->db->get_where('usuarios', $where);
        return $query->row_array();
    }
    
    /*
     *  Usuarios/registrar_ajax
     */
    public function set($datos) {
        $this->db->insert('usuarios', $datos);
        return $this->db->insert_id();
    }
    
    /*
     *  Usuarios/registrar_ajax
     */
    public function set_comunidad($datos) {
        $this->db->insert('usuarios_comunidades', $datos);
        return $this->db->insert_id();
    }
}

?>
