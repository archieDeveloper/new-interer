<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    var $data = array(),
        $controller,
        $action;

    function __construct(){
        parent::__construct();
        $this->controller = $this->uri->segment(1);
        $this->action = $this->uri->segment(2);
    }

    public function index()
    {
        $this->load->view('admin/login',$this->data);
    }
}