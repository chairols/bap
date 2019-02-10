<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paises extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'pagination',
            'form_validation'
        ));
        $this->load->model(array(
            'paises_model'
        ));
    }
    
    public function listar($pagina = 0) {
        $data['title'] = 'Listado de Paises';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array();
        
        $per_page = 10;
        $pais = '';
        if ($this->input->get('pais') !== null) {
            $pais = $this->input->get('pais');
        }
        
        /*
         * inicio paginador
         */
        $total_rows = $this->paises_model->get_cantidad_paises($pais);
        $config['reuse_query_string'] = TRUE;
        $config['base_url'] = '/menu/listar/';
        $config['total_rows'] = $total_rows['cantidad'];
        $config['per_page'] = $per_page;
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<i class="page-item zmdi zmdi-chevron-right"></i>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        /*
         * fin paginador
         */

        $data['total_rows'] = $total_rows['cantidad'];

        $data['paises'] = $this->paises_model->gets_where_paises_limit($pais, $pagina, $per_page);

        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('paises/listar');
        $this->load->view('layout/footer');
    }
    
    public function agregar() {
        $data['title'] = 'Agregar País';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(
            '/assets/modulos/paises/js/agregar.js'
        );
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('paises/agregar');
        $this->load->view('layout/footer');
    }
    
    public function agregar_ajax() {
        $session = $this->session->all_userdata();

        $this->form_validation->set_rules('pais', 'País', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            
        }
    }
}
?>