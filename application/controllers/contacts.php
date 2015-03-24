<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

  var $data = array(),
    $controller,
    $action;

  function __construct() {
    parent::__construct();
    $this->controller = $this->uri->segment(1);
    $this->action = $this->uri->segment(2);
  }

  public function index() {
    if (isset($_POST['add_feedback']) && $_POST['add_feedback']) {
      $this->load->model('feedback_model');
      $this->load->library('email');

      $this->feedback_model->add_feedback($_POST['name'],$_POST['number'],$_POST['address'],$_POST['start_time'],$_POST['end_time']);

      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'smtp.spaceweb.ru';
      $config['smtp_user'] = 'support@new-interer.ru';
      $config['smtp_pass'] = '123supportbase';
      $config['smtp_port'] = '2525';
      $config['mailtype'] = 'html';

      $this->email->initialize($config);

      $this->email->from('support@new-interer.ru', 'Новый Интерьер');
      $this->email->to('newinterer@mail.ru','arkadij.ok@gmail.com');
      $this->email->subject('Новый заказ на замер');
      $this->email->message('<h2>Заявка на замер</h2><p><b>Имя: </b>'.$_POST['name'].'</p><p><b>Номер телефона: </b>'.$_POST['number'].'</p><p><b>Адрес: </b>'.$_POST['address'].'</p><p><b>Желаемое время: </b>с '.$_POST['start_time'].' до '.$_POST['end_time'].'</p>');

      $this->email->send();

      /*$config['smtp_username'] = 'support@new-interer.ru'; //Смените на имя своего почтового ящика.
      $config['smtp_port'] = '2525'; // Порт работы. Не меняйте, если не уверены.
      $config['smtp_host'] = 'smtp.spaceweb.ru'; //сервер для отправки почты(для наших клиентов менять не требуется)
      $config['smtp_password'] = '123supportbase'; //Измените пароль
      $config['smtp_debug'] = false; //Если Вы хотите видеть сообщения ошибок, укажите true вместо false
      $config['smtp_charset'] = 'Windows-1251'; //кодировка сообщений. (или UTF-8, итд)
      $config['smtp_from'] = 'Новый Интерьер'; //Ваше имя - или имя Вашего сайта. Будет показывать при прочтении в поле "От кого"*/
      exit();
    }

    $this->load->model('page_model');
    $this->data['page_list'] = $this->page_model->get_pages_list();
    $this->data['page_info'] = $this->page_model->get_page($this->controller);

    $this->load->model('category_model');
    $this->data['list_category_portfolio'] = $this->category_model->get_list();

    $this->data['breadcrumb'][] = array('name' => $this->data['page_info']->title, 'link' => $this->controller);

    $this->load->view('templates/up', $this->data);
    $this->load->view('contacts', $this->data);
    $this->load->view('templates/down', $this->data);
  }
}