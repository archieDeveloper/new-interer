<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once($_SERVER['DOCUMENT_ROOT'] . '/application/libraries/smarty/libs/Smarty.class.php');

class CI_Smarty extends Smarty
{

  public function __construct()
  {
    parent::__construct();
    $applicationDir = $_SERVER['DOCUMENT_ROOT'] . '/application/';
    $this->caching = 1;
    $this->setTemplateDir( $applicationDir . 'views' );
    $this->setCompileDir( $applicationDir . 'third_party/smarty/templates_c' );
    $this->setConfigDir( $applicationDir . 'third_party/smarty/configs' );
    $this->setCacheDir( $applicationDir . 'cache' );
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