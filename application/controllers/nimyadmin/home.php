<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

  var $data = array(),
    $controller,
    $action,
    $page_title = 'Главная',
    $include_js = array(),
    $include_css = array();

  function __construct()
  {
    parent::__construct();
    $this->controller = $this->uri->segment(1);
    $this->action = $this->uri->segment(2);

    $this->load->library('auth');
    if (!$this->auth->isAdmin()) {
      header("Location: /nimyadmin/login.html");
      exit();
    }
  }

  public function index()
  {
    $this->smarty->assign('page_title', $this->page_title);
    $this->smarty->assign('page_controller', $this->controller);
    $this->smarty->assign('page_action', $this->action);
    $this->smarty->assign('include_js', $this->include_js);
    $this->smarty->assign('include_css', $this->include_css);

    $this->smarty->display('admin/templates/up.tpl');
    $this->smarty->display('admin/home.tpl');
    $this->smarty->display('admin/templates/down.tpl');
  }
}