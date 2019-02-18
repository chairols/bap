<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array(
            'session',
            'r_session',
            'email'
        ));
        $this->load->model(array(
            'variables_model'
        ));
    }
    
    public function email() {
        $where = array(
            'variable' => 'nombre_sistema'
        );
        $nombre_sistema = $this->variables_model->get_where($where);
        
        $where = array(
            'variable' => 'noreply_email'
        );
        $email = $this->variables_model->get_where($where);
        
        $where = array(
            'variable' => 'noreply_email_password'
        );
        $email_password = $this->variables_model->get_where($where);
        
        
        $subject = 'Bienvenido a '.$nombre_sistema['valor'];
        
        $message = '<p>Les Diputades Indecises.</p>';

// Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
    <title>' . html_escape($subject) . '</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>
' . $message . '
</body>
</html>';
// Also, for getting full html you may use the following internal method:
//$body = $this->email->full_html($subject, $message);
        
        $result = $this->email
                ->from($email['valor'], $nombre_sistema['valor'])
                //->reply_to('ventas@rollerservice.com.ar')    // Optional, an account where a human being reads.
                ->to('hernanbalboa@gmail.com')
                //->to($this->input->post('email'))
                ->subject($subject)
                //->attach(base_url().'retenciones/pdf/'.$this->input->post('idretencion').'/', '', 'Nuevo Nombre.pdf')
                //->attach(base_url().'extranet/retencion/'.$this->input->post('idretencion').'/')
                ->message($body)
                ->send();
        
       
        exit;
    }
    
}
?>