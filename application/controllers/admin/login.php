<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  var $data = array();

  public function index() {
    $this->load->view('admin/login_form', $this->data);
  }

  /*public function reg(){
    $this->load->model('admin/admin_auth_model');
    $this->admin_auth_model->reg('arkadij', '123456s');
  }*/
}