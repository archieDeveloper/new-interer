<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller
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
    if (isset($_POST['add_callback']) && $_POST['add_callback']) {
      $froze = 0;
      if (isset($_POST['froze'])) {
        $froze = $_POST['froze'];
      }
      $this->_add_callback(
        $_POST['name'],
        $_POST['number'],
        $_POST['start_time'],
        $_POST['end_time'],
        $froze
      );
    }
    if (isset($_POST['add_feedback'])) {
      $this->_add_feedback(
        $_POST['name'],
        $_POST['email'],
        $_POST['number'],
        $_POST['topic'],
        $_POST['text']
      );
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

  public function _add_callback($name, $number, $start_time, $end_time, $froze = 0)
  {
    $this->load->model('callback_model');
    $this->callback_model->add($name, $number, $start_time, $end_time, $froze);

    $title = 'Заявка на обратный звонок';
    if ($froze) {
      $title = 'Заявка на замер';
    }

    $message = '<h2>' . $title . '</h2>'.
      '<p><b>Имя: </b>' . $name . '</p>
      <p><b>Номер телефона: </b>' . $number . '</p>
      <p><b>Желаемое время: </b>с ' . $start_time . ' до ' . $end_time . '</p>';
    $this->_push_email($title, $message);

    exit();
  }

  public function _add_feedback($name, $email, $number, $topic, $text)
  {
    $this->load->model('feedback_model');
    $this->feedback_model->add($name, $email, $number, $topic, $text);

    $message = '<h2>' . $topic . '</h2>
                <p><b>Имя: </b>' . $name . '</p>
                <p><b>Почта: </b>' . $email . '</p>
                <p><b>Телефон: </b>' . $number . '</p>
                <p><b>Текст: </b>' . $text . '</p>';
    $this->_push_email('Обратная связь', $message);
  }

  public function _push_email($subject, $message)
  {
    $this->load->library('email');

    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.spaceweb.ru';
    $config['smtp_user'] = 'support@new-interer.ru';
    $config['smtp_pass'] = '123supportbase';
    $config['smtp_port'] = '2525';
    $config['mailtype'] = 'html';

    $this->email->initialize($config);

    $this->email->from('support@new-interer.ru', 'Новый Интерьер');
    $this->email->to(array('arkadij.ok@gmail.com', 'skinoak@mail.ru'));
    $this->email->subject($subject);
    $this->email->message($message);

    $this->email->send();

    /*$config['smtp_username'] = 'support@new-interer.ru'; //Смените на имя своего почтового ящика.
    $config['smtp_port'] = '2525'; // Порт работы. Не меняйте, если не уверены.
    $config['smtp_host'] = 'smtp.spaceweb.ru'; //сервер для отправки почты(для наших клиентов менять не требуется)
    $config['smtp_password'] = '123supportbase'; //Измените пароль
    $config['smtp_debug'] = false; //Если Вы хотите видеть сообщения ошибок, укажите true вместо false
    $config['smtp_charset'] = 'Windows-1251'; //кодировка сообщений. (или UTF-8, итд)
    $config['smtp_from'] = 'Новый Интерьер'; //Ваше имя - или имя Вашего сайта. Будет показывать при прочтении в поле "От кого"*/
  }
}