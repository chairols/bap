<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perfiles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'pagination',
            'form_validation'
        ));
        $this->load->model(array(
            'perfiles_model'
        ));

        $session = $this->session->all_userdata();
        $this->r_session->check($session);
    }

    public function listar($pagina = 0) {
        $data['title'] = 'Listado de Perfiles';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array();

        $per_page = 10;
        $perfil = '';
        if ($this->input->get('perfil') !== null) {
            $perfil = $this->input->get('perfil');
        }
        /*
         * inicio paginador
         */
        $total_rows = $this->perfiles_model->get_cantidad($perfil, 'A');
        $config['reuse_query_string'] = TRUE;
        $config['base_url'] = '/perfiles/listar/';
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

        $data['perfiles'] = $this->perfiles_model->gets_limit($perfil, $pagina, $config['per_page'], 'A');

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('perfiles/listar');
        $this->load->view('layout/footer');
    }

    public function modificar($idperfil = null) {
        if ($idperfil == null) {
            redirect('/perfiles/listar/', 'refresh');
        }
        $data['title'] = 'Modificar Perfil';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(
            '/assets/vendors/Nestable-master/jquery.nestable.js',
            '/assets/modulos/perfiles/js/modificar.js'
        );

        $datos = array(
            'idperfil' => $idperfil
        );
        $data['perfil'] = $this->perfiles_model->get_where($datos);
        $ids = $this->menu_model->gets_menu_por_perfil($data['session']['perfil']);
        $data['ids'] = array();
        foreach ($ids as $id) {
            $data['ids'][] = $id['idmenu'];
        }
        $data['ids'] = implode(",", $data['ids']);
        $data['mmenu'] = $this->menu_model->obtener_menu_por_padre_con_accesos(0, $idperfil);
        foreach ($data['mmenu'] as $key => $value) {
            $data['mmenu'][$key]['submenu'] = $this->menu_model->obtener_menu_por_padre_con_accesos($value['idmenu'], $idperfil);
            foreach ($data['mmenu'][$key]['submenu'] as $k1 => $v1) {
                $data['mmenu'][$key]['submenu'][$k1]['submenu'] = $this->menu_model->obtener_menu_por_padre_con_accesos($v1['idmenu'], $idperfil);
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('perfiles/modificar');
        $this->load->view('layout/footer');
    }

    public function modificar_ajax() {
        $this->form_validation->set_rules('idperfil', 'ID de Perfil', 'required|integer');
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $datos = array(
                'perfil' => $this->input->post('perfil')
            );
            $where = array(
                'idperfil' => $this->input->post('idperfil')
            );
            $respuesta = $this->perfiles_model->update($datos, $where);
            if ($respuesta) {
                $json = array(
                    'status' => 'ok',
                    'data' => 'El perfil se actualizó correctamente'
                );
                echo json_encode($json);
            } else {
                $json = array(
                    'status' => 'error',
                    'data' => 'No se pudo actualizar el perfil <strong>' . $this->input->post('perfil') . '</strong>'
                );
                echo json_encode($json);
            }
        }
    }

    public function actualizar_accesos() {
        $this->form_validation->set_rules('idmenu', 'Menú', 'required|integer');
        $this->form_validation->set_rules('idperfil', 'Perfil', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $where = array(
                'idperfil' => $this->input->post('idperfil'),
                'idmenu' => $this->input->post('idmenu')
            );
            $resultado = $this->perfiles_model->get_where_perfiles_menu($where);
            if ($resultado) {
                $this->perfiles_model->borrar_perfiles_menu($where);
                $json = array(
                    'status' => 'ok'
                );
                echo json_encode($json);
            } else {
                $this->perfiles_model->set_perfiles_menu($where);
                $json = array(
                    'status' => 'ok'
                );
                echo json_encode($json);
            }
        }
    }

    public function actualizar_orden() {
        $this->form_validation->set_rules('orden', 'Orden', 'required');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $resultado = json_decode($this->input->post('orden'));
            $contador1 = 1;
            foreach ($resultado as $r1) {
                $data = array(
                    'orden' => $contador1,
                    'padre' => 0
                );
                $where = array(
                    'idmenu' => $r1->id
                );
                $this->menu_model->update_menu($data, $where);
                if (isset($r1->children)) {
                    $contador2 = 1;
                    foreach ($r1->children as $r2) {
                        $data = array(
                            'orden' => $contador2,
                            'padre' => $r1->id
                        );
                        $where = array(
                            'idmenu' => $r2->id
                        );
                        $this->menu_model->update_menu($data, $where);
                        if (isset($r2->children)) {
                            $contador3 = 1;
                            foreach ($r2->children as $r3) {
                                $data = array(
                                    'orden' => $contador3,
                                    'padre' => $r2->id
                                );
                                $where = array(
                                    'idmenu' => $r3->id
                                );
                                $this->menu_model->update_menu($data, $where);
                                $contador3++;
                            }
                        }
                        $contador2++;
                    }
                }
                $contador1++;
            }
            $json = array(
                'status' => 'ok'
            );
            echo json_encode($json);
        }
    }

    public function agregar() {
        $data['title'] = 'Agregar Perfil';
        $data['session'] = $this->session->all_userdata();
        $data['menu'] = $this->r_session->get_menu();
        $data['javascript'] = array(
            '/assets/modulos/perfiles/js/agregar.js'
        );



        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu');
        $this->load->view('perfiles/agregar');
        $this->load->view('layout/footer');
    }

    public function agregar_ajax() {
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');

        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => 'error',
                'data' => validation_errors()
            );
            echo json_encode($json);
        } else {
            $datos = array(
                'perfil' => $this->input->post('perfil')
            );
            $resultado = $this->perfiles_model->get_where($datos);

            if ($resultado) {
                $json = array(
                    'status' => 'error',
                    'data' => 'El perfil ' . $this->input->post('perfil') . " ya existe."
                );
                echo json_encode($json);
            } else {
                $id = $this->perfiles_model->set($datos);
                if ($id) {
                    $json = array(
                        'status' => 'ok',
                        'data' => 'Se agregó el perfil ' . $this->input->post('perfil') . "."
                    );
                    echo json_encode($json);
                } else {
                    $json = array(
                        'status' => 'error',
                        'data' => 'No se pudo agregar el perfil ' . $this->input->post('perfil') . "."
                    );
                    echo json_encode($json);
                }
            }
        }
    }

}

?>
