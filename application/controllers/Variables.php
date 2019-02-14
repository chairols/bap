<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Variables extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'form_validation'
        ));
        $this->load->model(array(
            'variables_model'
        ));
    }

    public function agregar() {
        $data['title'] = 'Agregar Comunidad';
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

}

?>