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
        $this->load->helper(array(
            'url'
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
        $config['base_url'] = '/paises/listar/';
        $config['total_rows'] = $total_rows['cantidad'];
        $config['per_page'] = $per_page;
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<i class="page-item fa fa-angle-double-right"></i>';
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
            $where = array(
                'pais' => $this->input->post('pais')
            );
            $resultado = $this->paises_model->get_where($where);
            if ($resultado) {  // Si existe
                if ($resultado['estado'] == 'A') {
                    $json = array(
                        'status' => 'error',
                        'data' => 'El País ' . $this->input->post('pais') . ' ya existe.'
                    );
                    echo json_encode($json);
                } else {  // Se vuelve a activar
                    $datos = array(
                        'estado' => 'A'
                    );
                    $where = array(
                        'idpais' => $resultado['idpais']
                    );
                    $res = $this->paises_model->update($datos, $where);
                    if ($res) {  // Si se volvió a activar
                        $json = array(
                            'status' => 'ok',
                            'data' => 'El País ' . $this->input->post('pais') . ' se volvió a activar.'
                        );
                        echo json_encode($json);
                    } else {  // No se pudo volver a activar
                        $json = array(
                            'status' => 'error',
                            'data' => 'El País ' . $this->input->post('pais') . ' ya existe y no se pudo volver a activar.'
                        );
                        echo json_encode($json);
                    }
                }
            } else {  // Si no existe
                $datos = array(
                    'pais' => $this->input->post('pais')
                );
                $resultado = $this->paises_model->set($datos);

                if ($resultado) {  // Si se creó el pais
                    $json = array(
                        'status' => 'ok',
                        'data' => 'El País ' . $this->input->post('pais') . ' se creó correctamente.'
                    );
                    echo json_encode($json);
                } else {
                    $json = array(
                        'status' => 'error',
                        'data' => 'El País ' . $this->input->post('pais') . ' no se pudo crear.'
                    );
                    echo json_encode($json);
                }
            }
        }
    }

}

?>