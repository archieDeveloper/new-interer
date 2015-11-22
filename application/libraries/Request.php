<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CI_Request
{

  var $CI;

  public function __construct()
  {
    $this->CI =& get_instance();
  }

  public function isAjax()
  {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
      && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
      && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
  }

}