<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

  var $data = array(),
    $controller,
    $action;

  function __construct()
  {
    parent::__construct();
    $this->controller = $this->uri->segment(1);
    $this->action = $this->uri->segment(2);
  }

  public function index()
  {
    $this->data['errors'] = array(
      0 => 'Логин должен быть более 3-х символов',
      1 => 'Пароль должен быть не менее 6 символов',
      2 => 'Не правильный логин или пароль'
    );
    //если отправлена форма авторизации, то пытаемся авторизироваться
    if (filter_input(INPUT_POST, 'submit_login', FILTER_SANITIZE_SPECIAL_CHARS)) {
      $login = trim(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS));
      $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
      $this->data['log_in'] = $this->auth->login($login, $password);
    }
    // если админ вошел, то перекидывать на главную админки
    if ($this->auth->root()) {
      header("Location: /nimyadmin.html");
      exit();
    }
    //отображаем форму входа
    $this->load->view('admin/login', $this->data);
  }
}