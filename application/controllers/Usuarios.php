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
            'variables_model',
            'comunidades_model'
        ));
    }

    public function login() {

        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $usuario = $this->usuarios_model->get_usuario($this->input->post('usuario'), sha1($this->input->post('password')));
            if (!empty($usuario)) {
                if ($usuario['estado'] == 'A') {  // Si el usuario está activo
                    $where = array(
                        'idusuario' => $usuario['idusuario'],
                        'idcomunidad' => $usuario['idcomunidad_activa']
                    );
                    $perfil = $this->usuarios_model->get_perfil($where);

                    $datos = array(
                        'SID' => $usuario['idusuario'],
                        'usuario' => $usuario['usuario'],
                        'nombre' => $usuario['nombre'],
                        'apellido' => $usuario['apellido'],
                        'correo' => $usuario['email'],
                        'perfil' => $perfil['idperfil'],
                        'comunidad_activa' => $usuario['idcomunidad_activa']
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
                } else if($usuario['estado'] == 'P') {  // Si falta la confirmación de Email
                    
                }
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
                    'widget' => $this->recaptcha->getWidget(),
                    'script' => $this->recaptcha->getScriptTag(),
                    'data' => validation_errors()
                );
                echo json_encode($json);
            } else {
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
                        // Creo la comunidad
                        $set = array(
                            'place_id' => $this->input->post('place_id'),
                            'latitud' => $this->input->post('lat'),
                            'longitud' => $this->input->post('lon'),
                            'pais' => $this->input->post('pais_nombre_largo'),
                            'abreviatura_pais' => $this->input->post('pais_nombre_corto'),
                            'direccion' => $this->input->post('direccion'),
                            'fecha_creacion' => date("Y-m-d H:i:s")
                        );
                        $idcomunidad = $this->comunidades_model->set($set);

                        // Creo el usuario
                        $set = array(
                            'usuario' => $this->input->post('email'),
                            'password' => sha1($this->input->post('password')),
                            'idcomunidad_activa' => $idcomunidad,
                            'fecha_creacion' => date("Y-m-d H:i:s")
                        );
                        $idusuario = $this->usuarios_model->set($set);

                        // Actualizo datos de usuario a la comunidad
                        $datos = array(
                            'creado_por' => $idusuario,
                            'modificado_por' => $idusuario
                        );
                        $where = array(
                            'idcomunidad' => $idcomunidad
                        );
                        $this->comunidades_model->update($datos, $where);

                        // Actualizo comunidad activa y creador
                        $datos = array(
                            'idcomunidad_activa' => $idcomunidad,
                            'idcreador' => $idusuario
                        );
                        $this->usuarios_model->update($datos, $idusuario);

                        // Agrego usuario y perfil a la nueva comunidad
                        $datos = array(
                            'idusuario' => $idusuario,
                            'idperfil' => 2,
                            'idcomunidad' => $idcomunidad,
                            'administrador_comunidad' => 'S'
                        );
                        $this->usuarios_model->set_comunidad($datos);
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
