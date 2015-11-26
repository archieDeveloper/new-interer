<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Portfolio extends CI_Controller
{

  var $data = [],
    $controller,
    $action,
    $page_title = 'Настройка выполненых работ',
    $include_js = [
      'lib/jquery.fileupload',
      'lib/jquery.fileupload-process',
      'lib/jquery.iframe-transport',
      'lib/jquery.imgareaselect.min',
      'admin'
    ],
    $include_css = [
      'lib/jquery.fileupload'
    ];


  function __construct()
  {
    parent::__construct();
    $this->controller = $this->uri->segment(2);
    $this->action = $this->uri->segment(3);

    $this->load->library('auth');
    if (!$this->auth->isAdmin()) {
      header("Location: /nimyadmin/login.html");
      exit();
    }
  }

  public function index()
  {
    if (!empty($_FILES) && isset($_POST['type']) && $_POST['type'] == 'portfolio') $this->_upload_portfolio();
    if (isset($_POST['id']) && isset($_POST['crop_image'])) $this->_crop_image($_POST['id'], $_POST['x'], $_POST['y'], $_POST['width'], $_POST['height']);

    $this->smarty->assign('page_title', $this->page_title);
    $this->smarty->assign('page_controller', $this->controller);
    $this->smarty->assign('page_action', $this->action);
    $this->smarty->assign('include_js', $this->include_js);
    $this->smarty->assign('include_css', $this->include_css);

    if (!isset($_GET['page'])) {
      $_GET['page'] = 1;
    }
    $page = (integer)$_GET['page'];
    if (!$page) {
      show_404();
    }
    $this->smarty->assign('page', $page);
    $this->load->model('portfolio_model');
    $this->smarty->assign(
      'portfolio', $this->portfolio_model->get(null, $page)
    );
    $this->smarty->assign('num_pages', $this->portfolio_model->get_num());
    $this->load->model('category_model');
    $this->smarty->assign(
      'list_category_portfolio',$this->category_model->get_list()
    );

    $this->smarty->display('admin/templates/up.tpl');
    $this->smarty->display('admin/portfolio/index.tpl');
    $this->smarty->display('admin/templates/down.tpl');
  }

  public function add()
  {
    $this->smarty->assign('page_title', 'Добавить работу');
    $this->smarty->assign('page_controller', $this->controller);
    $this->smarty->assign('page_action', $this->action);
    $this->smarty->assign('include_js', [
      'lib/jquery.fileupload',
      'lib/jquery.fileupload-process',
      'lib/jquery.iframe-transport',
      'lib/jquery.imgareaselect.min',
      'uploads'
    ]);
    $this->smarty->assign('include_css', [
      'lib/jquery.fileupload',
      'lib/imgareaselect/imgareaselect-animated'
    ]);
    $this->load->model('category_model');
    $this->smarty->assign(
      'list_category_portfolio', $this->category_model->get_list()
    );
    $this->smarty->display('admin/templates/up.tpl');
    $this->smarty->display('admin/portfolio/add.tpl');
    $this->smarty->display('admin/templates/down.tpl');
  }

  public function categories()
  {
    $this->smarty->assign('page_title', 'Категории');
    $this->smarty->assign('page_controller', $this->controller);
    $this->smarty->assign('page_action', $this->action);
    $this->smarty->assign('include_js', $this->include_js);
    $this->smarty->assign('include_css', $this->include_css);
    $this->load->model('category_model');
    $this->smarty->assign(
      'list_category_portfolio', $this->category_model->get_list()
    );
    $this->smarty->display('admin/templates/up.tpl');
    $this->smarty->display('admin/portfolio/categories.tpl');
    $this->smarty->display('admin/templates/down.tpl');
  }

  /**
   *
   * @Ajax
   *
   */
  public function trash()
  {
    $this->load->library('request');
    if (!$this->request->isAjax() || empty($_POST['id'])) {
      show_404();
    }
    header('Content-type: application/json');
    $this->load->model('portfolio_model');
    $this->portfolio_model->trash($_POST['id']);
    $this->data['id'] = $_POST['id'];
    $response['html'] = $this->load->view(
      'admin/templates/portfolio/trash', $this->data, true
    );
    $response['data'] = $this->data;
    echo json_encode($response);
  }

  /**
   *
   * @Ajax
   *
   */
  public function restore()
  {
    $this->load->library('request');
    if (!$this->request->isAjax() || empty($_POST['id'])) {
      show_404();
    }
    header('Content-type: application/json');
    $this->load->model('portfolio_model');
    $this->portfolio_model->restore($_POST['id']);
    $this->data['id'] = $_POST['id'];
    $response['html'] = $this->load->view(
      'admin/templates/portfolio/trash', $this->data, true
    );
    $response['data'] = $this->data;
    echo json_encode($response);
  }

  /**
   *
   * @Ajax
   *
   */
  public function title()
  {
    $this->load->library('request');
    if (!$this->request->isAjax() || empty($_POST['id']) || !isset($_POST['title'])) {
      show_404();
    }
    header('Content-type: application/json');
    $this->load->model('portfolio_model');
    $this->portfolio_model->edit_title($_POST['id'], $_POST['title']);
    $this->data['id'] = $_POST['id'];
    $this->data['title'] = $_POST['title'];
    $response['data'] = $this->data;
    echo json_encode($response);
  }


  /**
   *
   * @Ajax
   *
   */
  public function category()
  {
    $this->load->library('request');
    if (!$this->request->isAjax() || empty($_POST['id']) || empty($_POST['category_link'])) {
      show_404();
    }
    header('Content-type: application/json');
    $this->load->model('portfolio_model');
    $this->portfolio_model->edit_category($_POST['id'], $_POST['category_link']);
    $this->data['id'] = $_POST['id'];
    $this->data['category_link'] = $_POST['category_link'];
    $response['data'] = $this->data;
    echo json_encode($response);
  }

  /**
   *
   * @Ajax
   *
   */
  public function save_category()
  {
    $this->load->library('request');
    if (!$this->request->isAjax() || empty($_POST['id'])) {
      show_404();
    }
    header('Content-type: application/json');
    $this->load->model('category_model');
    $this->data['error'] = $this->category_model->update(
      $_POST['id'], $_POST['name'], $_POST['desc'], $_POST['slug']
    );
    $response['data'] = $this->data;
    echo json_encode($response);
  }

  /**
   *
   * @Ajax
   *
   */
  public function add_category()
  {
    $this->load->library('request');
    if (!$this->request->isAjax()) {
      show_404();
    }
    header('Content-type: application/json');
    $this->load->model('category_model');
    $this->data = $this->category_model->add(
      $_POST['name'], $_POST['desc'], $_POST['slug']
    );
    $response['data'] = $this->data;
    echo json_encode($response);
  }

  /**
   *
   * @Ajax
   *
   */
  public function remove_category()
  {
    $this->load->library('request');
    if (!$this->request->isAjax() || empty($_POST['id'])) {
      show_404();
    }
    header('Content-type: application/json');
    $this->load->model('category_model');
    $this->data = $this->category_model->delete($_POST['id']);
    $response['data'] = $this->data;
    echo json_encode($response);
  }

  /**
   *
   * @Ajax
   *
   */
  public function sortable_category()
  {
    $this->load->library('request');
    if (!$this->request->isAjax() || empty($_POST['data_id'])) {
      show_404();
    }
    header('Content-type: application/json');
    $this->load->model('category_model');
    $this->category_model->position_rewrite($_POST['data_id']);
    $response['data'] = 'OK';
    echo json_encode($response);
  }

  public function _upload_portfolio()
  {
    header('Content-type: application/json');

    $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . "/img/portfolio/big";
    $config['allowed_types'] = "jpg|jpeg|png";
    $config['max_size'] = 20000;
    $config['max_width'] = 3000;
    $config['max_height'] = 3000;
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload() == false) {
      $error = ['error' => $this->upload->display_errors()];
      echo json_encode($error);
    } else {
      $data = $this->upload->data();
      $this->load->model('portfolio_model');
      $data['current_row_id'] = $this->portfolio_model->add($data['file_name']);

      $this->_crop_image($data['current_row_id'], 0, 0, 1, 1);
      echo json_encode($data);
    }

    exit();
  }

  public function  _crop_image($id, $x, $y, $width, $height)
  {
    $data['current_row_id'] = $id;
    $this->load->model('portfolio_model');
    $portfolio = $this->portfolio_model->get_current($id);
    $data['file_name'] = $portfolio->img;
    header('Content-type: application/json');

    $config['image_library'] = 'gd2'; // выбираем библиотеку
    $config['source_image'] = $_SERVER['DOCUMENT_ROOT'] . '/img/portfolio/big/' . $portfolio->img;
    $config['maintain_ratio'] = false; // сохранять пропорции
    $config['new_image'] = $_SERVER['DOCUMENT_ROOT'] . "/img/portfolio/small";

    $size = getimagesize($config['source_image']);

    $config['x_axis'] = $size[0] * $x;
    $config['y_axis'] = $size[1] * $y;
    $config['width'] = $size[0] * $width;
    $config['height'] = $size[1] * $height;

    $this->load->library('image_lib', $config); // загружаем библиотеку

    if (!$this->image_lib->crop()) {
      $data['crop_error'] = $this->image_lib->display_errors();
    }

    $size = getimagesize($config['new_image'] . '/' . $portfolio->img);

    $data['image_width'] = $size[0];
    $data['image_height'] = $size[1];

    $this->image_lib->clear();

    $config['image_library'] = 'gd2'; // выбираем библиотеку
    $config['source_image'] = $_SERVER['DOCUMENT_ROOT'] . "/img/portfolio/small/" . $portfolio->img;
    $config['maintain_ratio'] = TRUE; // сохранять пропорции
    $config['new_image'] = $_SERVER['DOCUMENT_ROOT'] . "/img/portfolio/small";
    $config['width'] = 217; // и задаем размеры

    $this->image_lib->initialize($config);

    if (!$this->image_lib->resize()) {
      $data['resize_error'] = $this->image_lib->display_errors();
    }
    echo json_encode($data);
    exit();
  }
}