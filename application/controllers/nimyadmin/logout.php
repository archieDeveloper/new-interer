<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller
{

  var $data = array(),
    $controller,
    $action;

  function __construct()
  {
    parent::__construct();
    $this->controller = $this->uri->segment(1);
    $this->action = $this->uri->segment(2);
  }

  public function index()
  {
    // если вошел, то выходим и направляем на главную страницу сайта
    $this->auth->logout();
    header("Location: /");
    exit();
  }
}