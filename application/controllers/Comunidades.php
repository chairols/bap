<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidades extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'form_validation'
        ));
        $this->load->model(array(
            'comunidades_model'
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

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('comunidades/agregar');
        $this->load->view('layout/footer');
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