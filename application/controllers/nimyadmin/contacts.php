<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

  var $data = array(),
    $controller,
    $action,
    $page_title = 'Настройка контактной информации',
    $include_js = array(),
    $include_css = array();

  function __construct() {
    parent::__construct();
    $this->controller = $this->uri->segment(1);
    $this->action = $this->uri->segment(2);
  }

  public function index() {
    $this->data['page_title'] = $this->page_title;

    $this->load->model('contacts_model');
    $this->data['contacts'] = $this->contacts_model->get_contacts();
    $this->data['include_js'] = $this->include_js;
    $this->data['include_css'] = $this->include_css;

    $this->load->view('admin/templates/up', $this->data);
    $this->load->view('admin/contacts', $this->data);
    $this->load->view('admin/templates/down', $this->data);
  }
}