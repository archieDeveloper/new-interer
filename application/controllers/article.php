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

    public function index()
    {
        show_404();
    }
    public function id($id = null)
    {
        if ($id == null) { show_404(); }
        $this->load->model('page_model');
        $this->data['page_list'] = $this->page_model->get_pages_list();
        $this->data['page_info'] = $this->page_model->get_page($this->controller);

        $this->load->model('articles_model');
        $page = (integer) $id;
        if (!$page) { show_404(); }
        $this->data['current_article'] = $this->articles_model->get_current_article($page);
        if (!$this->data['current_article']) { show_404(); }

        $this->load->view('templates/up', $this->data);
        $this->load->view('article', $this->data);
        $this->load->view('templates/down', $this->data);
    }
}