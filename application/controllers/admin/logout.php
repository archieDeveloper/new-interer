<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

  var $data = array();

  public function index()
  {
    // если вошел, то выходим и направляем на страницу авторизации
    $this->auth->logout();
    header("Location: /admin/login");
    exit();
  }

  /*public function reg(){
    $this->load->model('admin/admin_auth_model');
    $this->admin_auth_model->reg('arkadij', '123456s');
  }*/
}