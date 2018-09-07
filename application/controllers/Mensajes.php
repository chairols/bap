<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mensajes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
        ));
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
    
    public function chat() {
        $data['title'] = 'Chat';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['css'] = array(
            '/assets/oreoadmin-140/html-light/assets/css/chatapp.css',
            '/assets/oreoadmin-140/html-light/assets/css/color_skins.css',
            '/assets/oreoadmin-140/html-light/assets/css/color_skins.css'
        );
        
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('mensajes/chat');
        $this->load->view('layout/footer');
    }
    
    public function crear() {
        $data['title'] = 'Crear Mensaje';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(
            '/assets/modulos/mensajes/js/crear.js'
        );
        
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('mensajes/crear');
        $this->load->view('layout/footer');
    }
}
?>