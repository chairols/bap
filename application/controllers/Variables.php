<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Variables extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'form_validation',
            'pagination'
        ));
        $this->load->model(array(
            'variables_model'
        ));
    }

    public function agregar() {
        $data['title'] = 'Agregar Variable de Sistema';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(
            '/assets/modulos/variables/js/agregar.js'
        );


        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('variables/agregar');
        $this->load->view('layout/footer');
    }

    public function agregar_ajax() {
        $this->form_validation->set_rules('variable', 'Variable', 'required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $where = array(
                'variable' => $this->input->post('variable')
            );
            $variable = $this->variables_model->get_where($where);

            if ($variable) {  // Si existe
                $json = array(
                    'status' => 'error',
                    'data' => 'La variable ' . $this->input->post('variable') . ' ya existe'
                );
                echo json_encode($json);
            } else {  // Si no existe
                $set = array(
                    'variable' => $this->input->post('variable'),
                    'valor' => $this->input->post('valor'),
                    'comentarios' => $this->input->post('comentarios')
                );

                $this->variables_model->set($set);
                
                $id = $this->variables_model->get_where($set);
                if ($id) {
                    $json = array(
                        'status' => 'ok',
                        'data' => 'Se creó la variable ' . $this->input->post('variable')
                    );
                    echo json_encode($json);
                } else {
                    $json = array(
                        'status' => 'error',
                        'data' => 'No se pudo crear la variable ' . $this->input->post('variable')
                    );
                    echo json_encode($json);
                }
            }
        }
    }
    
    public function listar($pagina = 0) {
        $data['title'] = 'Listado de Variables del Sistema';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array();


        $per_page = 10;
        $variable = '';
        if ($this->input->get('variable') !== null) {
            $variable = $this->input->get('variable');
        }

        /*
         * inicio paginador
         */
        $total_rows = $this->variables_model->get_cantidad_pendientes($variable);
        $config['reuse_query_string'] = TRUE;
        $config['base_url'] = '/variables/listar/';
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

        $data['variables'] = $this->variables_model->gets_where_variable_limit($variable, $pagina, $per_page);
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('variables/listar');
        $this->load->view('layout/footer');
    }
    
    public function modificar($variable = null) {
        if($variable == null) {
            redirect('/variables/listar/', 'refresh');
        }
        $data['title'] = 'Modificar Variable de Sistema';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(
            '/assets/modulos/variables/js/modificar.js'
        );

        $where = array(
            'variable' => $variable
        );
        $data['variable'] = $this->variables_model->get_where($where);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('variables/modificar');
        $this->load->view('layout/footer');
    }
    
    public function modificar_ajax() {
        $this->form_validation->set_rules('variable', 'Variable', 'required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $datos = array(
                'valor' => $this->input->post('valor'),
                'comentarios' => $this->input->post('comentarios')
            );
            $where = array(
                'variable' => $this->input->post('variable')
            );
            $resultado = $this->variables_model->update($datos, $where);
            
            if ($resultado) {
                $json = array(
                    'status' => 'ok',
                    'data' => 'La variable '.$this->input->post('variable').' se actualizó correctamente'
                );
                echo json_encode($json);
            } else {
                $json = array(
                    'status' => 'error',
                    'data' => 'No se pudo actualizar la variable '.$this->input->post('variable')
                );
                echo json_encode($json);
            }
        }
    }
}

?>