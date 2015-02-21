<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Auth Class
 *
 * @package	CodeIgniter
 * @subpackage	Libraries
 * @category	Auth
 */
class CI_Auth {

    var $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function root(){
        //если пользователь не вошел, то вернуть лож
        if(!$this->login_it()){ return false; }
        //если пользователь не админ, то вернуть лож
        if($this->CI->session->userdata('privileges') != 'admin') { return false; }
        //два предыдущик условия не сработали значит это админ, истина
        return true;
    }
    
    public function login_it() {
        //если пользователь не вошел, то вернуть лож
        if(!$this->CI->session->userdata('logged_in')){ return false; }
        //предыдущее условие не сработало значит вошел, истина
        return true;
    }

    public function login($login, $password){
        $errors = array();
        if(mb_strlen($login) < 3){ $errors['login_errors'][] = 0;}
        if(mb_strlen($password) < 6){ $errors['login_errors'][] = 1;}
        if(!empty($errors)){ return $errors; }
        //подключение модели авторизации
        $this->CI->load->model('admin/admin_auth_model');
        //авторизация
        $user_id = $this->CI->admin_auth_model->login($login, $password);
        //если авторизация не прошла успешно, то вывести ошибку
        if(!$user_id){ $errors['login_errors'][] = 2; }
        if(!empty($errors)){ return $errors; }
        $this->CI->session->set_userdata(array('id'=>$user_id,'logged_in' => TRUE, 'privileges'=>'admin'));
        return true;
    }
    
    public function logout(){
        if($this->login_it()){
            $user_data = array('id' => '', 'logged_in' => '', 'privileges' => '');
            $this->CI->session->unset_userdata($user_data);
        }
    }
}

/* End of file Auth.php */