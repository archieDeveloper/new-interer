<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller
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
    $this->load->library('request');
    if (!$this->request->isAjax()) {
      show_404();
    }
    $view = $_GET['view'];
    unset($_GET['view']);
    $this->load->view($view, $_GET);
  }
}