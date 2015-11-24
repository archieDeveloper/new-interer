<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  var $data = [];

  public function index() {
    $this->smarty->display('admin/login.tpl');
  }

  /*public function reg(){
    $this->load->model('admin/admin_auth_model');
    $this->admin_auth_model->reg('arkadij', '123456s');
  }*/
}