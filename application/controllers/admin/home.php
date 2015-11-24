<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  var $data = [];

  public function index()
  {
    header("Location: /admin/login");
    exit();
  }
}