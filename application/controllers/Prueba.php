<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
        ));
    }
    
    public function chat() {
        $data['title'] = 'Dashboard';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(
            '/assets/modulos/prueba/js/chat.js'
        );  
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('prueba/chat');
        $this->load->view('layout/footer');
    }
    
    public function oreo() {
        $data['title'] = 'Prueba del Template Oreo';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(); 
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('prueba/oreo');
        $this->load->view('layout/footer');
    }
}
?>