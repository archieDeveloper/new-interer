<?php
/*%%SmartyHeaderCode:2085138448565495b419d7f9_69660291%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84117f2acc279383101297329ce501f2fd0dfa5c' => 
    array (
      0 => '/opt/lampp/htdocs/new-interer.ru.loc/application/views/admin/portfolio/add.tpl',
      1 => 1448383922,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2085138448565495b419d7f9_69660291',
  'tpl_function' => 
  array (
  ),
  'variables' => 
  array (
    'page_title' => 0,
    'list_category_porftolio' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_565495b420eae7_70670199',
  'cache_lifetime' => 3600,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_565495b420eae7_70670199')) {
function content_565495b420eae7_70670199 ($_smarty_tpl) {
?>
<h2>Добавить работу</h2><div class="add-block">
  <form action="http://new-interer.ru.loc/nimyadmin/portfolio.html" method="post" accept-charset="utf-8" id="fileupload" enctype="multipart/form-data">
    <span class="fileinput-button button green">
        <span><i class="flaticon-plus13"></i> Добавить работу</span>
        <input id="input-file" type="file" name="userfile" multiple>
    </span>
  </form>
  <div id="error"></div>
  <ul id="files" class="list-page"></ul>
</div>
<ul class="list-page"></ul>
<div class="model-delete-category" title="Выбор фотографии">
  <div class="js-list-page" id="js-list-page">
    <div>
      <div class="img">
        <img src="/img/portfolio/big/" alt="">
      </div>
      <div class="preview-img"><img src="" alt="" style="position: relative"/></div>
    </div>
    <div class="buttons">
      <a class="button blue save-first" data-id="" href="javascript:void(0);"><i class="flaticon-checkmark2"></i> Сохранить и продолжить</a>
    </div>
    <div class="clr"></div>
  </div>
  <div class="js-list-page" id="js-list-page2">
    <span class="img">
      <img src="/img/portfolio/small/" alt="">
      <a class="button trash" data-id="" id="trash-portfolio" href="javascript:void(0);"><i class="flaticon-trash3"></i> В корзину</a>
    </span>
    <span>
      <b>Заголовок: </b><br>
      <input class="input-edit" id="title-portfolio" type="text" value="" size="60" data-id="" placeholder="Без заголовка">
      <span>
        <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
        <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
      </span><br>
      <span class="select">
        <b>Категория: </b><br>
        <a href="javascript:void(0);" class="slct"><i class="flaticon-chevron8"></i></a>
        <span class="status-fields">
          <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
          <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
        </span>
        <ul class="drop" data-id="" id="category-portfolio">
          <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Undefined index: list_category_porftolio</p>
<p>Filename: templates_c/84117f2acc279383101297329ce501f2fd0dfa5c_0.file.add.tpl.cache.php</p>
<p>Line Number: 81</p>

</div><div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Trying to get property of non-object</p>
<p>Filename: templates_c/84117f2acc279383101297329ce501f2fd0dfa5c_0.file.add.tpl.cache.php</p>
<p>Line Number: 81</p>

</div>        </ul>
      </span>
    </span>
    <div class="buttons">
      <a class="button blue close" data-id="" href="javascript:void(0);"><i class="flaticon-checkmark2"></i> Сохранить</a>
      <a class="button green back2" data-id="" href="javascript:void(0);"><i class="flaticon-thin6"></i> Вернуться назад</a>
    </div>
    <div class="clr"></div>
  </div>
</div><?php }
}
?>