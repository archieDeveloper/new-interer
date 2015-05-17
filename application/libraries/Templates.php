<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006 - 2012, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Shopping Cart Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Shopping Cart
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/cart.html
 */
class CI_Templates {

	// Private variables.  Do not change!
	var $CI;
  var $data = array();

  public function __construct()
  {
    $this->CI =& get_instance();
  }

  public function view($data, $content, $wrap = true){
    $this->CI->load->model('page_model');
    $data['page_list'] = $this->CI->page_model->get_pages_list();

    if ($wrap) { $this->CI->load->view('templates/up', $data); }
    if(is_array($content)){
      foreach($content as $value){
        $this->CI->load->view($value, $data);
      }
    } else {
      $this->CI->load->view($content, $data);
    }
    if ($wrap) { $this->CI->load->view('templates/down', $data); }
  }
}

/* End of file Cart.php */
/* Location: ./system/libraries/Cart.php */