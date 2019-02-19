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
            'usuarios_model',
            'variables_model'
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

                if (!empty($this->input->post('remember'))) {
                    setcookie("login_usuario", $this->input->post('usuario'), time() + (10 * 365 * 24 * 60 * 60));
                    setcookie("login_password", $this->input->post('password'), time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    setcookie("login_usuario", "", time() - 100);
                    setcookie("login_password", "", time() - 100);
                }

                redirect('/dashboard/', 'refresh');
            }
        }

        $data['post'] = $this->input->post();

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

        $where = array(
            'variable' => 'google_maps_api_key'
        );
        $variable = $this->variables_model->get_where($where);
        $data['google_maps_api_key'] = $variable['valor'];

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
                /*
                 * Compruebo si existe el usuario
                 */

                $where = array(
                    'usuario' => $this->input->post('usuario')
                );
                $usuario = $this->usuarios_model->get_where($where);
                if ($usuario) {  // Si el usuario ya existe
                    $json = array(
                        'status' => 'error',
                        'data' => 'El Usuario ' . $this->input->post('usuario') . ' ya se encuentra registrado'
                    );
                    echo json_encode($json);
                } else {  // Si el usuario no existe
                    $where = array(
                        'place_id' => $this->input->post('place_id')
                    );
                    $comunidad = $this->comunidades_model->get_where($where);

                    if ($comunidad) { // Si existe la comunidad
                    } else {  // Si no existe la comunidad
                        $set = array(
                            'place_id' => $this->input->post('place_id')
                        );
                    }
                }

                /*
                 *  Comprobar si existe 
                 *  
                 *  Si existe - Se solicita al administrador unirse
                 * 
                 *  Si no existe la crea
                 */


                $json = array(
                    'status' => 'ok',
                    'data' => 'CORRECTO'
                );
                echo json_encode($json);
            }
        } else {
            $json = array(
                'status' => 'error',
                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
                'data' => 'Debe verificar Captcha'
            );
            echo json_encode($json);
        }
    }

}

?>
