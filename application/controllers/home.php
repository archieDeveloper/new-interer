<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  var $data = array();

  public function index()
  {
    $this->load->model('page_model');
    $this->data['page_list'] = $this->page_model->get_pages_list();
    $this->data['page_info'] = $this->page_model->get_page('');

    $this->load->model('portfolio_model');
    $this->data['portfolio'] = $this->portfolio_model->get(null,1,4);
    $this->load->model('category_model');
    $this->data['list_category_portfolio'] = $this->category_model->get_list();

    $this->data['slider_boolean'] = true;
    if(!$this->data['page_info']) { show_404(); }

    $this->load->view('templates/up', $this->data);
    $this->load->view('home', $this->data);
    $this->load->view('templates/down', $this->data);
  }
}