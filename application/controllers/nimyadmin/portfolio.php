<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portfolio extends CI_Controller {

  var $data = array(),
    $controller,
    $action,
    $page_title = 'Настройка выполненых работ',
    $include_js = array(
      'lib/jquery.fileupload',
      'lib/jquery.fileupload-process',
      'lib/jquery.iframe-transport',
      'uploads'),
    $include_css = array(
      'lib/jquery.fileupload');

  function __construct(){
    parent::__construct();
    $this->controller = $this->uri->segment(2);
    $this->action = $this->uri->segment(3);

    $this->load->library('auth');
    if (!$this->auth->root()) {
      header("Location: /nimyadmin/login.html"); exit();
    }
  }

  public function index() {
    if (!empty($_FILES)) $this->_upload();
    if (isset($_POST['id']) && isset($_POST['title'])) $this->_update_title_portfolio($_POST['id'], $_POST['title']);
    if (isset($_POST['id']) && isset($_POST['category_link'])) $this->_update_category_portfolio($_POST['id'], $_POST['category_link']);
    if (isset($_POST['id']) && isset($_POST['trash'])) $this->_trash_portfolio($_POST['id']);
    if (isset($_POST['id']) && isset($_POST['no_trash'])) $this->_no_trash_portfolio($_POST['id']);
    if (isset($_POST['id']) && isset($_POST['update_category_portfolio'])) $this->_update_category_portfolio_date($_POST['id'], $_POST['name'], $_POST['desc'], $_POST['slug']);
    if (isset($_POST['add_category_portfolio'])) $this->_add_category_portfolio($_POST['name'], $_POST['desc'], $_POST['slug']);
    if (isset($_POST['delete_category_portfolio'])) $this->_delete_category_portfolio($_POST['id']);
    if (isset($_POST['data_id'])) $this->_position_rewrite($_POST['data_id']);

    $this->data['page_title'] = $this->page_title;
    $this->data['page_controller'] = $this->controller;
    $this->data['page_action'] = $this->action;
    $this->data['include_js'] = $this->include_js;
    $this->data['include_css'] = $this->include_css;

    $this->load->model('portfolio_model');
    if (!isset($_GET['page'])) { $_GET['page'] = 1; }
    $page = (integer) $_GET['page'];
    if (!$page) { show_404(); }
    $this->data['portfolio'] = $this->portfolio_model->get(null, $page);

    $this->data['num_pages'] = $this->portfolio_model->get_num();

    $this->load->model('category_model');
    $this->data['list_category_portfolio'] = $this->category_model->get_list();

    $this->load->view('admin/templates/up', $this->data);
    $this->load->view('admin/portfolio/index', $this->data);
    $this->load->view('admin/templates/down', $this->data);
  }

  public function add() {
    $this->data['page_title'] = 'Добавить работу';
    $this->data['page_controller'] = $this->controller;
    $this->data['page_action'] = $this->action;
    $this->data['include_js'] = $this->include_js;
    $this->data['include_css'] = $this->include_css;

    $this->load->model('category_model');
    $this->data['list_category_portfolio'] = $this->category_model->get_list();

    $this->load->view('admin/templates/up', $this->data);
    $this->load->view('admin/portfolio/add', $this->data);
    $this->load->view('admin/templates/down', $this->data);
  }

  public function categories() {
    $this->data['page_title'] = 'Категории';
    $this->data['page_controller'] = $this->controller;
    $this->data['page_action'] = $this->action;
    $this->data['include_js'] = array('admin/category');
    $this->data['include_css'] = $this->include_css;

    $this->load->model('category_model');
    $this->data['list_category_portfolio'] = $this->category_model->get_list();

    $this->load->view('admin/templates/up', $this->data);
    $this->load->view('admin/portfolio/categories', $this->data);
    $this->load->view('admin/templates/down', $this->data);
  }

  public function _upload() {
    header('Content-type: application/json');

    $config['upload_path']      = $_SERVER['DOCUMENT_ROOT']."/img/portfolio/big";
    $config['allowed_types']    = "jpg|jpeg|png";
    $config['max_size']         = 20000;
    $config['max_width']        = 3000;
    $config['max_height']       = 3000;
    $config['encrypt_name']     = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload() == false) {
      $error = array('error' => $this->upload->display_errors());
      echo json_encode($error);
    } else {
      $data = $this->upload->data();
      $this->load->model('portfolio_model');
      $data['current_row_id'] = $this->portfolio_model->add($data['file_name']);

      $config['image_library'] = 'gd2'; // выбираем библиотеку
      $config['source_image'] = $data['full_path'];
      $config['maintain_ratio'] = false; // сохранять пропорции
      $config['new_image'] = $_SERVER['DOCUMENT_ROOT']."/img/portfolio/small";

      $width = $data['image_width'];
      $height = $data['image_height'];

      if ($width > $height) { //горизонтальное изображение
        $config['x_axis'] = ($width/2)-($height/2);
        $config['y_axis'] = 0;
        $config['width'] = $height;
        $config['height'] = $height;
      } elseif ($width < $height) { //вертикальное изображение
        $config['x_axis'] = 0;
        $config['y_axis'] = ($height/2)-($width/2);
        $config['width'] = $width;
        $config['height'] = $width;
      } else { // квадратное изображение
        $config['x_axis'] = 0;
        $config['y_axis'] = 0;
        $config['width'] = $width;
        $config['height'] = $height;
      }

      $this->load->library('image_lib', $config); // загружаем библиотеку

      if ( ! $this->image_lib->crop())
      {
        $data['crop_error'] = $this->image_lib->display_errors();
      }
      $this->image_lib->clear();

      $config['image_library'] = 'gd2'; // выбираем библиотеку
      $config['source_image'] = $_SERVER['DOCUMENT_ROOT']."/img/portfolio/small/".$data['file_name'];
      $config['maintain_ratio'] = TRUE; // сохранять пропорции
      $config['width']    = 200; // и задаем размеры
      $config['height']   = 200;

      $this->image_lib->initialize($config);

      if ( ! $this->image_lib->resize()) {
        $data['resize_error'] = $this->image_lib->display_errors();
      }

      echo json_encode($data);
    }

    exit();
  }

  public function _update_title_portfolio($id,$title) {
    // header('Content-type: application/json');

    $this->load->model('portfolio_model');
    $this->portfolio_model->edit_title($id,$title);

    exit();
  }

  public function _update_category_portfolio($id,$link)
  {
    $this->load->model('portfolio_model');
    $this->portfolio_model->edit_category($id,$link);
    exit();
  }

  public function _update_category_portfolio_date($id, $name, $desc, $slug) {
    header('Content-type: application/json');
    $data = array();
    $this->load->model('category_model');
    $data['error'] = $this->category_model->update($id, $name, $desc, $slug);
    echo json_encode($data);
    exit();
  }

  public function _add_category_portfolio($name, $desc, $slug) {
    header('Content-type: application/json');
    $data = array();
    $this->load->model('category_model');
    $data = $this->category_model->add($name, $desc, $slug);
    echo json_encode($data);
    exit();
  }

  public function _delete_category_portfolio($id) {
    header('Content-type: application/json');
    $data = array();
    $this->load->model('category_model');
    $data = $this->category_model->delete($id);
    echo json_encode($data);
    exit();
  }

  public function _trash_portfolio($id)
  {
    $this->load->model('portfolio_model');
    $this->portfolio_model->trash($id);
    exit();
  }

  public function _no_trash_portfolio($id)
  {
    $this->load->model('portfolio_model');
    $this->portfolio_model->no_trash($id);
    exit();
  }

  public function _position_rewrite($data_links)
  {
    $this->load->model('category_model');
    $this->category_model->position_rewrite($data_links);
    exit();
  }
}