<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Variables extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
        ));
    }

    public function agregar() {
        $data['title'] = 'Agregar Comunidad';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(
 
        );


        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('variables/agregar');
        $this->load->view('layout/footer');
    }
}

?>