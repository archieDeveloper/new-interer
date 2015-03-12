<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  var $data = array(),
    $controller,
    $action,
    $page_title = 'Главная',
    $include_js = array(),
    $include_css = array();

  function __construct(){
    parent::__construct();
    $this->controller = $this->uri->segment(1);
    $this->action = $this->uri->segment(2);
  }

  public function index()
  {
    $this->data['page_title'] = $this->page_title;
    $this->data['page_controller'] = $this->controller;
    $this->data['page_action'] = $this->action;
    $this->data['include_js'] = $this->include_js;
    $this->data['include_css'] = $this->include_css;

    $this->load->view('admin/templates/up', $this->data);
    $this->load->view('admin/home', $this->data);
    $this->load->view('admin/templates/down', $this->data);
  }
}