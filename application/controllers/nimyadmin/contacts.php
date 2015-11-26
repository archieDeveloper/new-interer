<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller
{
  var $data = [],
    $controller,
    $action,
    $page_title = 'Настройка контактной информации',
    $include_js = [],
    $include_css = [];

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
    $this->load->model('contacts_model');

    $this->smarty->assign('page_title', $this->page_title);
    $this->smarty->assign('contacts', $this->contacts_model->get_contacts());
    $this->smarty->assign('include_js', $this->include_js);
    $this->smarty->assign('include_css', $this->include_css);

    $this->smarty->display('admin/templates/up.tpl');
    $this->smarty->display('admin/contacts.tpl');
    $this->smarty->display('admin/templates/down.tpl');
  }
}