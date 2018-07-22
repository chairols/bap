<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mensajes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }
    
    public function inbox() {
        $data['title'] = 'Bandeja de Entrada';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array();
        
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('dashboard/index');
        $this->load->view('layout/footer');
    }
}
?>