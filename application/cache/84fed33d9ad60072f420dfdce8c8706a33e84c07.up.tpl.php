<?php
/*%%SmartyHeaderCode:117499543856549cb0376d42_32402839%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84fed33d9ad60072f420dfdce8c8706a33e84c07' => 
    array (
      0 => '/opt/lampp/htdocs/new-interer.ru.loc/application/views/admin/templates/up.tpl',
      1 => 1448385707,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117499543856549cb0376d42_32402839',
  'tpl_function' => 
  array (
  ),
  'variables' => 
  array (
    'page_title' => 0,
    'include_js' => 0,
    'js_path' => 0,
    'include_css' => 0,
    'css_path' => 0,
    'page_controller' => 0,
    'page_action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56549cb03caec1_33594816',
  'cache_lifetime' => 3600,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56549cb03caec1_33594816')) {
function content_56549cb03caec1_33594816 ($_smarty_tpl) {
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Добавить работу</title>
  <link rel="stylesheet" href="/styles/admin.css">
  <link rel="stylesheet" href="/styles/flaticon.css">
  <script type="text/javascript" src="/js/lib/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="/js/lib/jquery-ui-1.10.4.custom.min.js"></script>
      <script type="text/javascript" src="/js/lib/jquery.fileupload.js"></script>
      <script type="text/javascript" src="/js/lib/jquery.fileupload-process.js"></script>
      <script type="text/javascript" src="/js/lib/jquery.iframe-transport.js"></script>
      <script type="text/javascript" src="/js/lib/jquery.imgareaselect.min.js"></script>
      <script type="text/javascript" src="/js/uploads.js"></script>
        <link rel="stylesheet" href="/styles/lib/jquery.fileupload.css">
      <link rel="stylesheet" href="/styles/lib/imgareaselect/imgareaselect-animated.css">
    <link rel="shortcut icon" href="/img/favicon_admin.ico" type="image/x-icon">
</head>
<body>
  <div class="wrap-container">
    <div class="wrap-color-line">
      <div class="wcl-item-1"></div>
      <div class="wcl-item-2"></div>
      <div class="wcl-item-3"></div>
      <div class="wcl-item-4"></div>
      <div class="wcl-item-5"></div>
      <div class="wcl-item-6"></div>
      <div class="wcl-item-7"></div>
    </div>
    <div class="header">
      <h1>Админ панель</h1>
      <a href="/" target="_blank" class="button blue">Просмотреть сайт</a>
      <a href="/nimyadmin/logout.html" class="button">Выйти</a>
    </div>
    <div class="wrap-content">
      <div class="left-aside">
        <span><i class="flaticon-menu10"></i> Меню</span>
        <ul>
          <li><a href="/nimyadmin.html">Консоль</a></li>
          <li class="separator"></li>
          <li><a href="/nimyadmin/pages.html">Страницы</a></li>
          <li class="active">
            <a href="/nimyadmin/portfolio.html">Выполненные работы</a>
            <ul>
              <li ><a href="/nimyadmin/portfolio.html">Все работы</a></li>
              <li class="active"><a href="/nimyadmin/portfolio/add.html">Добавить новую</a></li>
              <li ><a href="/nimyadmin/portfolio/categories.html">Категории</a></li>
            </ul>
          </li>
          <li >
            <a href="/nimyadmin/articles.html">Статьи</a>
            <ul>
              <li ><a href="/nimyadmin/articles.html">Все статьи</a></li>
              <li ><a href="/nimyadmin/articles/add.html">Добавить новую</a></li>
            </ul>
          </li>
          <li><a href="/nimyadmin/contacts.html">Контакты</a></li>
          <li><a href="/nimyadmin/feedback.html">Обратная связь</a></li>
          <li class="separator"></li>
          <li><a href="/nimyadmin/feedback.html">Модераторы</a></li>
          <li><a href="/nimyadmin/feedback.html">Настройки</a></li>
        </ul>
      </div>
      <div class="content"><?php }
}
?>