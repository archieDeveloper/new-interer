<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package    CodeIgniter
 * @since    Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Auth Class
 *
 * @package  CodeIgniter
 * @subpackage  Libraries
 * @category  Auth
 */
class CI_Auth
{

  var $CI;

  public function __construct()
  {
    $this->CI =& get_instance();
  }

  public function isAdmin()
  {
    $isLogin = $this->isLogin();
    $isAdmin = $this->CI->session->userdata('privileges') === 'admin';
    return ($isLogin && $isAdmin);
  }

  public function isLogin()
  {
    return (bool) $this->CI->session->userdata('logged_in');
  }

  public function login($login, $password)
  {
    $errors = [];
    if (mb_strlen($login) < 3) {
      $errors['login_errors'][] = 0;
    }
    if (mb_strlen($password) < 6) {
      $errors['login_errors'][] = 1;
    }
    if (!empty($errors)) {
      return $errors;
    }
    $this->CI->load->model('admin/auth_model');
    $user_id = $this->CI->auth_model->login($login, $password);
    if (!$user_id) {
      $errors['login_errors'][] = 2;
    }
    if (!empty($errors)) {
      return $errors;
    }
    $this->CI->session->set_userdata([
      'id' => $user_id,
      'logged_in' => TRUE,
      'privileges' => 'admin'
    ]);
    return true;
  }

  public function logout()
  {
    if ($this->isLogin()) {
      $this->CI->session->unset_userdata([
        'id' => '',
        'logged_in' => '',
        'privileges' => ''
      ]);
    }
  }
}

/* End of file Auth.php */