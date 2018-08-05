<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Consorcios extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }
    
    public function agregar() {
        $data['title'] = 'Dashboard';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('consorcios/agregar');
        $this->load->view('layout/footer');
    }
}
?>