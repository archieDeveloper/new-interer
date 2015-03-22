<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portfolio extends CI_Controller {

  var $data = array(),
    $controller,
    $action;

  function __construct() {
    parent::__construct();
    $this->controller = $this->uri->segment(1);
    $this->action = $this->uri->segment(2);
  }

  public function index() {
    $this->load->model('page_model');
    $this->data['page_list'] = $this->page_model->get_pages_list();
    $this->data['page_info'] = $this->page_model->get_page($this->controller);

    if (!isset($_GET['page'])) { $_GET['page'] = 1; }
    $page = (integer) $_GET['page'];
    if (!$page) { show_404(); }

    $this->load->model('portfolio_model');
    if (isset($_GET['id_product'])) {
      $this->data['current_product'] = $this->portfolio_model->get_current($_GET['id_product']);
    }

    $this->data['portfolio'] = $this->portfolio_model->get(null, $page, 12);
    if(!$this->data['portfolio']) { show_404(); }

    $count = 12*($page-1);
    $this->data['count_portfolio']['from'] = $count+1;
    $this->data['count_portfolio']['to'] = $count+count($this->data['portfolio']);

    $this->load->model('category_model');
    $this->data['list_category_portfolio'] = $this->category_model->get_list();

    $this->data['num_pages'] = $this->portfolio_model->get_num(null, 12);

    $this->data['breadcrumb'][] = array('name' => $this->data['page_info']->title, 'link' => $this->controller);

    $this->load->view('templates/up', $this->data);
    $this->load->view('portfolio', $this->data);
    $this->load->view('templates/down', $this->data);
  }

  public function category($link = null) {
    if (is_null($link)) { show_404(); }
    $this->load->model('page_model');
    $this->data['page_list'] = $this->page_model->get_pages_list();
    $this->data['page_info'] = $this->page_model->get_page($this->controller);

    if (!isset($_GET['page'])) { $_GET['page'] = 1; }
    $page = (integer) $_GET['page'];
    if (!$page) { show_404(); }

    $this->load->model('portfolio_model');
    if (isset($_GET['id_product'])) {
      $this->data['current_product'] = $this->portfolio_model->get_current($_GET['id_product']);
    }

    $this->data['portfolio'] = $this->portfolio_model->get($link, $page, 12);

    $this->data['category'] = $link;

    $count = 12*($page-1);
    $this->data['count_portfolio']['from'] = $count+1;
    $this->data['count_portfolio']['to'] = $count+count($this->data['portfolio']);

    $this->load->model('category_model');
    $this->data['list_category_portfolio'] = $this->category_model->get_list();

    $this->data['num_pages'] = $this->portfolio_model->get_num($link, 12);

    $this->data['current_category'] = $this->category_model->get_current($link);

    if(!$this->data['current_category']) { show_404(); }

    $this->data['breadcrumb'][] = array('name' => $this->data['page_info']->title, 'link' => $this->controller);
    $this->data['breadcrumb'][] = array('name' => $this->data['current_category']->name, 'link' => 'category/'.$link);

    $this->load->view('templates/up', $this->data);
    $this->load->view('portfolio', $this->data);
    $this->load->view('templates/down', $this->data);
  }
}