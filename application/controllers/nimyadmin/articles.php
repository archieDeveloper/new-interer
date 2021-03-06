<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller
{

  var $data = array(),
    $controller,
    $action,
    $page_title = 'Настройка статей',
    $include_js = array('admin/articles'),
    $include_css = array('lib/jquery.fileupload');

  function __construct()
  {
    parent::__construct();
    $this->controller = $this->uri->segment(2);
    $this->action = $this->uri->segment(3);

    $this->load->library('auth');
    if (!$this->auth->root()) {
      header("Location: /nimyadmin/login.html");
      exit();
    }
  }

  public function index()
  {
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
      $this->_add_new($_POST['title'], $_POST['date'], $_POST['text']);
    }
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
      $this->_edit_new($_POST['id'], $_POST['title'], $_POST['date'], $_POST['text']);
    }
    if (isset($_POST['id']) && isset($_POST['trash'])) {
      $this->_trash_new($_POST['id']);
    }
    if (isset($_POST['id']) && isset($_POST['no_trash'])) {
      $this->_no_trash_new($_POST['id']);
    }
    $this->data['page_title'] = $this->page_title;

    if (!isset($_GET['page'])) {
      $_GET['page'] = 1;
    }
    $page = (integer)$_GET['page'];
    if (!$page) {
      show_404();
    }
    $this->load->model('articles_model');
    $this->data['articles'] = $this->articles_model->get_news($page);
    $this->data['num_pages'] = $this->articles_model->get_num_news();
    $this->data['page_controller'] = $this->controller;
    $this->data['page_action'] = $this->action;
    $this->data['include_js'] = $this->include_js;
    $this->data['include_css'] = $this->include_css;

    $this->load->view('admin/templates/up', $this->data);
    $this->load->view('admin/articles/index', $this->data);
    $this->load->view('admin/templates/down', $this->data);
  }

  public function add()
  {
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
      $this->_add_new($_POST['title'], $_POST['date'], $_POST['text']);
    }
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
      $this->_edit_new($_POST['id'], $_POST['title'], $_POST['date'], $_POST['text']);
    }
    if (isset($_POST['id']) && isset($_POST['trash'])) {
      $this->_trash_new($_POST['id']);
    }
    if (isset($_POST['id']) && isset($_POST['no_trash'])) {
      $this->_no_trash_new($_POST['id']);
    }
    $this->data['page_title'] = $this->page_title;

    if (!isset($_GET['page'])) {
      $_GET['page'] = 1;
    }
    $page = (integer)$_GET['page'];
    if (!$page) {
      show_404();
    }
    $this->load->model('articles_model');
    $this->data['articles'] = $this->articles_model->get_news($page);
    $this->data['num_pages'] = $this->articles_model->get_num_news();
    $this->data['page_controller'] = $this->controller;
    $this->data['page_action'] = $this->action;
    $this->data['include_js'] = $this->include_js;
    $this->data['include_css'] = $this->include_css;

    $this->load->view('admin/templates/up', $this->data);
    $this->load->view('admin/articles/add', $this->data);
    $this->load->view('admin/templates/down', $this->data);
  }

  public function _add_new($title, $date, $text)
  {
    header('Content-type: application/json');
    $this->load->model('articles_model');
    $new_art = $this->articles_model->add_new($title, $date, $text);
    $new_art->date_rus = date_rus($new_art->date);
    $new_art_text = explode_article($new_art->text);
    $new_art->text = $new_art_text[0];
    echo json_encode($new_art);
    exit();
  }

  public function _edit_new($id, $title, $date, $text)
  {
    header('Content-type: application/json');
    $this->load->model('articles_model');
    $edit_art = $this->articles_model->edit_new($id, $title, $date, $text);
    $edit_art->date_rus = date_rus($edit_art->date);
    $edit_art_text = explode_article($edit_art->text);
    $edit_art->text = $edit_art_text[0];
    echo json_encode($edit_art);
    exit();
  }

  public function _trash_new($id)
  {
    $this->load->model('articles_model');
    $this->articles_model->trash_new($id);
    exit();
  }

  public function _no_trash_new($id)
  {
    $this->load->model('articles_model');
    $this->articles_model->no_trash_new($id);
    exit();
  }
}