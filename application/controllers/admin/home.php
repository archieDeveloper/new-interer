<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  var $data = array();

  public function index()
  {
    if(!$this->auth->root()){ header("Location: /admin/login"); exit(); }

    $this->templates->view($this->data, array('welcome_message'));
  }
}