<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    var $data = array(),
    	$template = 'home';

    public function index()
    {
    	$this->template = 'home';
        $this->load->model('page_model');
        $this->data['page_list'] = $this->page_model->get_pages_list();
        $this->data['page_info'] = $this->page_model->get_page('');
        $this->data['portfolio'] = $this->page_model->get_portfolio(null,1,4);
        $this->data['list_category_portfolio'] = $this->page_model->get_list_category_portfolio();

        $this->data['slider_boolean'] = true;
        if(!$this->data['page_info']) { show_404(); }
        if (!empty($this->data['page_info']->template)) :
        	$this->template = explode(',', $this->data['page_info']->template);
        endif;


        $this->load->view('templates/up', $this->data);
        $this->load->view('home', $this->data);
        $this->load->view('templates/down', $this->data);
        //$this->templates->view($this->data, $this->template);
    }
}