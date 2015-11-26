<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/smarty/libs/Smarty.class.php');

class CI_Smarty extends Smarty
{

  public function __construct()
  {
    parent::__construct();
    $this->setTemplateDir( APPPATH . 'views' );
    $this->setCompileDir( APPPATH . 'third_party/smarty/templates_c' );
    $this->setConfigDir( APPPATH . 'third_party/smarty/configs' );
    $this->setCacheDir( APPPATH . 'cache' );
  }

  //if specified template is cached then display template and exit, otherwise, do nothing.
  public function useCached( $tpl, $cacheId = null )
  {
    if ( $this->isCached( $tpl, $cacheId ) )
    {
      $this->display( $tpl, $cacheId );
      exit();
    }
  }

}