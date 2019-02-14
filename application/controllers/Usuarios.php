<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'form_validation',
            'session',
            'recaptcha'
        ));
        $this->load->model(array(
            'usuarios_model'
        ));
    }

    public function login() {

        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $usuario = $this->usuarios_model->get_usuario($this->input->post('usuario'), sha1($this->input->post('password')));
            if (!empty($usuario)) {
                $perfil = $this->usuarios_model->get_perfil($usuario['idusuario']);

                $datos = array(
                    'SID' => $usuario['idusuario'],
                    'usuario' => $usuario['usuario'],
                    'nombre' => $usuario['nombre'],
                    'apellido' => $usuario['apellido'],
                    'correo' => $usuario['email'],
                    'perfil' => $perfil['idperfil']
                );
                $this->session->set_userdata($datos);

                $datos = array(
                    'ultimo_acceso' => date("Y-m-d H:i:s")
                );
                $this->usuarios_model->update($datos, $usuario['idusuario']);

                redirect('/dashboard/', 'refresh');
            }
        }

        $data['title'] = "Login de Usuarios";
        $session = $this->session->all_userdata();
        if (!empty($session['SID'])) {
            redirect('/dashboard/', 'refresh');
        } else {
            $this->load->view('usuarios/login', $data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/usuarios/login/', 'refresh');
    }

    public function registrar() {

        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) and $response['success'] === true) {
                echo "You got it!";
            }
        }
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );
        $this->load->view('usuarios/registrar', $data);
    }

    public function registrar_ajax() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('place_id', 'Dirección', 'required');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');

        $captcha_answer = $this->input->post('g-recaptcha-response');

        $response = $this->recaptcha->verifyResponse($captcha_answer);

        if ($response['success']) {
            if ($this->form_validation->run() == FALSE) {
                $json = array(
                    'status' => 'error',
                    'data' => validation_errors()
                );
                echo json_encode($json);
            } else {

                $json = array(
                    'status' => 'ok',
                    'data' => 'CORRECTO'
                );
                echo json_encode($json);
            }
        } else {
            $json = array(
                'status' => 'error',
                'data' => 'Debe verificar Captcha'
            );
            echo json_encode($json);
        }
    }

}

?>
