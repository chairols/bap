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

}

?>
