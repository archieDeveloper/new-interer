<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {

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
    $this->load->model('page_model');
    $this->data['page_list'] = $this->page_model->get_pages_list();
    $this->data['page_info'] = $this->page_model->get_page($this->controller);

    $this->load->model('articles_model');
    if (!isset($_GET['page'])) { $_GET['page'] = 1; }
    $page = (integer) $_GET['page'];
    if (!$page) { show_404(); }
    $this->data['news'] = $this->articles_model->get_news($page);
    if(!$this->data['news']) { show_404(); }
    $this->data['num_pages'] = $this->articles_model->get_num_news();

    $this->load->view('templates/up', $this->data);
    $this->load->view('articles', $this->data);
    $this->load->view('templates/down', $this->data);
  }
}