<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidades extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session'
        ));

        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }

    public function agregar() {
        $data['title'] = 'Agregar Comunidad';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();

        $data['random'] = $this->generateRandomString(6);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('comunidades/agregar');
        $this->load->view('layout/footer');
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}

?>