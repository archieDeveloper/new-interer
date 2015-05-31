<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {

  var $data = array(),
    $controller,
    $action,
    $page_title = 'Обратная связь',
    $include_js = array(),
    $include_css = array();

  function __construct(){
    parent::__construct();
    $this->controller = $this->uri->segment(1);
    $this->action = $this->uri->segment(2);

    $this->load->library('auth');
    if (!$this->auth->root()) {
      header("Location: /nimyadmin/login.html"); exit();
    }
  }

  public function index()
  {
    $this->data['page_title'] = $this->page_title;
    $this->data['include_js'] = $this->include_js;
    $this->data['include_css'] = $this->include_css;
    $this->load->model('callback_model');

    $this->data['feedback_list'] = $this->callback_model->get();

    $this->load->view('admin/templates/up', $this->data);
    $this->load->view('admin/feedback', $this->data);
    $this->load->view('admin/templates/down', $this->data);
  }
}