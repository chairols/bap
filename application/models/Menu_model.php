<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /*
     *  libraries/r_session
     */
    public function get_perfil_menu($idperfil, $menu) {
        $query = $this->db->query("SELECT * 
                                    FROM
                                        menu m,
                                        perfiles_menu pm
                                    WHERE
                                        m.href = '$menu' AND
                                        pm.idperfil = '$idperfil' AND
                                        m.idmenu = pm.idmenu");
        
        return $query->result_array();
    }
    
    /*
     *  libraries/r_session
     */
    public function obtener_menu_por_padre_para_menu($idpadre, $idperfil) {
        $query = $this->db->query("SELECT m.*, pm.idperfil 
                                    FROM
                                        (menu m
                                    INNER JOIN
                                        perfiles_menu pm
                                    ON
                                        m.idmenu = pm.idmenu AND
                                        pm.idperfil = '$idperfil')
                                    WHERE
                                        m.padre = '$idpadre' AND
                                        m.visible = '1'
                                    ORDER BY
                                        m.orden, m.menu" );
        return $query->result_array();
    }

    /*
     *  Menu/listar
     */
    public function get_cantidad_pendientes($titulo) {
        $query = $this->db->query("SELECT COUNT(*) as cantidad
                                    FROM
                                        menu
                                    WHERE
                                        titulo LIKE '%$titulo%' OR
                                        menu LIKE '%$titulo%'");
        
        return $query->row_array();
    }
    
    /*
     *  Menu/listar
     */
    public function gets_where_titulo_limit($titulo, $pagina, $cantidad_por_pagina) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        menu
                                    WHERE
                                        titulo LIKE '%$titulo%' OR
                                        menu LIKE '%$titulo%'
                                    ORDER BY
                                        titulo
                                    LIMIT $pagina, $cantidad_por_pagina");
        return $query->result_array();
    }
    
    /*
     *  Menu/listar
     */
    public function get_where($where) {
        $query = $this->db->get_where('menu', $where);
        
        return $query->row_array();
    }
    
    /*
     *  Menu/agregar
     */
    public function gets_padres_ordenados($idpadre) {
        $query = $this->db->query("SELECT *
                                    FROM
                                        menu
                                    WHERE
                                        padre = '$idpadre' AND
                                        visible = '1'
                                    ORDER BY
                                        orden");
        return $query->result_array();              
    }
    
    /*
     *  Menu/agregar
     */
    public function set($datos) {
        $this->db->insert('menu', $datos);
        return $this->db->insert_id();
    }
    
    /*
     *  Perfiles/modificar
     */
    public function gets_menu_por_perfil($idperfil) {
        $query = $this->db->query("SELECT * 
                                    FROM
                                        perfiles_menu
                                    WHERE
                                        idperfil = '$idperfil'");
        
        return $query->result_array();
    }
    
    /*
     *  Perfiles/modificar
     */
    public function obtener_menu_por_padre($idpadre) {
        $query = $this->db->query("SELECT * 
                                    FROM
                                        menu
                                    WHERE
                                        padre = '$idpadre'
                                    ORDER BY
                                        orden, menu" );
        return $query->result_array();
    }
    
    /*
     *  Perfiles/modificar
     */
    public function obtener_menu_por_padre_con_accesos($idpadre, $idperfil) {
        $this->db->select("menu.*, perfiles_menu.idperfil");
        $this->db->from("menu");
        $this->db->join("perfiles_menu", "menu.idmenu = perfiles_menu.idmenu AND perfiles_menu.idperfil = '$idperfil'", "left");
        $this->db->where(array("menu.padre" => $idpadre));
        $this->db->order_by("menu.orden, menu.menu");
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /*
     *  Perfiles/actualizar_orden
     */
    public function update_menu($data, $where) {
        $this->db->update('menu', $data, $where);
    }
}

?>
