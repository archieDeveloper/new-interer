<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {

  var $data = array(),
    $controller,
    $action;

  function __construct(){
    parent::__construct();
    $this->controller = $this->uri->segment(1);
    $this->action = $this->uri->segment(2);
  }

  public function index() {
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

    $this->data['breadcrumb'][] = array('name' => $this->data['page_info']->title, 'link' => $this->controller);

    $this->load->view('templates/up', $this->data);
    $this->load->view('articles', $this->data);
    $this->load->view('templates/down', $this->data);
  }
  public function id($id = null) {
    if ($id == null) { show_404(); }
    $this->load->model('page_model');
    $this->data['page_list'] = $this->page_model->get_pages_list();
    $this->data['page_info'] = $this->page_model->get_page($this->controller);

    $this->load->model('articles_model');
    $page = (integer) $id;
    if (!$page) { show_404(); }
    $this->data['current_article'] = $this->articles_model->get_current_article($page);
    if (!$this->data['current_article']) { show_404(); }

    $this->data['breadcrumb'][] = array('name' => $this->data['page_info']->title, 'link' => $this->controller);
    $this->data['breadcrumb'][] = array('name' => $this->data['current_article']->title, 'link' => 'id/'.$this->data['current_article']->id);

    $this->load->view('templates/up', $this->data);
    $this->load->view('article', $this->data);
    $this->load->view('templates/down', $this->data);
  }
}