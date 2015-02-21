<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

    var $data = array(),
        $template = 'page';

    public function index($name_page)
    {
        $this->load->model('page_model');
        $this->data['pages'] = $this->page_model->get_pages_list();
        $this->data['page_info'] = $this->page_model->get_page($name_page);
        if(!$this->data['page_info']) { show_404(); }

        if ($this->data['page_info']->id == 10) {
            $this->uauth->logout();
            header('Location: /auctions.html');
            exit();
        }

        if ($this->data['page_info']->id == 3) {
            $this->load->model('articles_model');
            if (!isset($_GET['page'])) { $_GET['page'] = 1; }
            $page = (integer) $_GET['page'];
            if (!$page) { show_404(); }
            $this->data['news'] = $this->articles_model->get_news($page);
            if(!$this->data['news']) { show_404(); }
            $this->data['num_pages'] = $this->articles_model->get_num_news();
        }

        if ($this->data['page_info']->id == 1 || $this->data['page_info']->id == 2) {
            $this->data['type0'] = $this->page_model->get_portfolio('0');
            $this->data['type1'] = $this->page_model->get_portfolio('1');
            $this->data['type2'] = $this->page_model->get_portfolio('2');
            $this->data['type3'] = $this->page_model->get_portfolio('3');
            $this->data['type4'] = $this->page_model->get_portfolio('4');
            $this->data['type5'] = $this->page_model->get_portfolio('5');
        }

        if ($this->data['page_info']->id == 6) {
            $this->load->model('articles_model');
            $this->data['current_article'] = $this->articles_model->get_current_article();
            if (!$this->data['current_article']) { show_404(); }
        }
        /* start block */
        # $this->uauth->logout();
        $this->data['is_auth'] = $this->uauth->is_authorised();
        $this->load->helper('url');

        if ($this->uauth->right_now()) {
            if ($this->uauth->userdata()) {
                $this->load->model('auth_model');
                $this->auth_model->register($this->uauth->userdata());
            }
        }


        $this->data['user'] = array();
        if($this->data['is_auth']){
            $this->data['user'] = $this->uauth->userdata();
            $this->data['soc_html'] = $this->data['user']['first_name'].' '.$this->data['user']['last_name'].' | <a href="/logout.html">Выход</a>';
        } else {
            $this->data['soc_html'] = $this->ulogin->get_html();
        }
        /* end block */

        if ($this->data['page_info']->id == 7) {
            $this->load->model('auctions_model');
            $this->data['auctions'] = $this->auctions_model->get_auctions_list();
        }
        if ($this->data['page_info']->id == 8) {
            $this->load->model('auctions_model');
            if (isset($_POST['send_rate'])) {
                if($this->data['is_auth']){
                    $this->data['set_rate'] = $this->auctions_model->set_rate($_POST['rate'], $this->data['user']);
                }
            }
            $this->data['current_lot'] = $this->auctions_model->get_current_lot();
            $this->data['user_lot'] = $this->auctions_model->get_user_lot();
        }

        if (!empty($this->data['page_info']->template)) :
            $this->template = explode(',', $this->data['page_info']->template);
        endif;
        $this->templates->view($this->data, $this->template, $this->data['page_info']->wrap);
    }
}