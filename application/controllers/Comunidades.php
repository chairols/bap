<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidades extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'form_validation',
            'pagination'
        ));
        $this->load->model(array(
            'comunidades_model',
            'paises_model'
        ));

        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }

    public function agregar() {
        $data['title'] = 'Agregar Comunidad';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(
            '/assets/modulos/comunidades/js/agregar.js'
        );

        $flag = 1;
        while ($flag) {
            $data['random'] = $this->generateRandomString(6);
            $where = array(
                'codigo' => $data['random']
            );
            $resultado = $this->comunidades_model->get_where($where);
            if (!$resultado) {
                $flag = 0;
            }
        }
        
        $data['paises'] = $this->paises_model->gets();

        $this->load->view('layout_mpify/header', $data);
        $this->load->view('layout_mpify/menu');
        $this->load->view('comunidades/agregar');
        $this->load->view('layout_mpify/footer');
    }

    public function agregar_ajax() {
        $session = $this->session->all_userdata();

        $this->form_validation->set_rules('codigo', 'Código', 'required');
        $this->form_validation->set_rules('comunidad', 'Comunidad', 'required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $where = array(
                'codigo' => $this->input->post('codigo')
            );
            $resultado = $this->comunidades_model->get_where($where);
            if ($resultado) {
                $json = array(
                    'status' => 'error',
                    'data' => '<strong>NO SE PUEDE AGREGAR</strong><br>El código de la comunidad ya existe'
                );
                echo json_encode($json);
            } else {
                $datos = array(
                    'comunidad' => $this->input->post('comunidad'),
                    'direccion' => $this->input->post('direccion'),
                    'codigo' => $this->input->post('codigo'),
                    'fecha_creacion' => date("Y-m-d H:i:s"),
                    'creado_por' => $session['SID'],
                    'modificado_por' => $session['SID']
                );
                $id = $this->comunidades_model->set($datos);
                if ($id) {
                    $json = array(
                        'status' => 'ok',
                        'data' => 'Se creó la comunidad <strong>' . $this->input->post('comunidad') . '</strong>'
                    );
                    echo json_encode($json);
                } else {
                    $json = array(
                        'status' => 'error',
                        'data' => '<strong>NO SE PUDO AGREGAR</strong><br>Ha ocurrido un error interno'
                    );
                    echo json_encode($json);
                }
            }
        }
    }
    
    public function listar($pagina = 0) {
        $data['title'] = 'Listado de Comunidades';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        
        $per_page = 10;
        $comunidad = '';
        if ($this->input->get('comunidad') !== null) {
            $comunidad = $this->input->get('comunidad');
        }
        /*
         * inicio paginador
         */
        $total_rows = $this->comunidades_model->get_cantidad($comunidad, 'A');
        $config['reuse_query_string'] = TRUE;
        $config['base_url'] = '/comunidades/listar/';
        $config['total_rows'] = $total_rows['cantidad'];
        $config['per_page'] = $per_page;
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['total_rows'] = $total_rows['cantidad'];
        /*
         * fin paginador
         */

        $data['comunidades'] = $this->comunidades_model->gets_limit($comunidad, $pagina, $config['per_page'], 'A');

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('comunidades/listar');
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