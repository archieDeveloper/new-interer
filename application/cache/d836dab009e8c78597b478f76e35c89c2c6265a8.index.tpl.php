<?php
/*%%SmartyHeaderCode:804704636565499cc961570_45727934%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd836dab009e8c78597b478f76e35c89c2c6265a8' => 
    array (
      0 => '/opt/lampp/htdocs/new-interer.ru.loc/application/views/admin/portfolio/index.tpl',
      1 => 1448384971,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '804704636565499cc961570_45727934',
  'tpl_function' => 
  array (
  ),
  'variables' => 
  array (
    'page_title' => 0,
    'pagination' => 0,
    'portfolio' => 0,
    'value' => 0,
    'list_category_portfolio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_565499cc9d9713_37587071',
  'cache_lifetime' => 3600,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_565499cc9d9713_37587071')) {
function content_565499cc9d9713_37587071 ($_smarty_tpl) {
?>
<h2>Настройка выполненых работ<a href="/nimyadmin/portfolio/add.html" class="button green"><i class="flaticon-plus13"></i> Добавить работу</a></h2><ul class="pagination">
  
  <div class="cleaner"></div>
</ul>
<ul class="list-page">
      <li>
      <div class="img">
        <img src="/img/portfolio/small/da9aea6eed35bd12563fcd1e2fa13946.jpg" alt="">
        <a class="button trash" data-id="77" href="javascript:void(0);"><i class="flaticon-trash3"></i> В корзину</a>
        <span class="edit-img" data-id="77"><i class="flaticon-photo7"></i> Изменить миниатюру</span>
      </div>
      <span>
        <b>Заголовок: </b><br>
        <input class="input-edit" type="text" value="hjhgukjf fghd" size="60" data-id="<?php echo '<?=';?>$value->id<?php echo '?>';?>" placeholder="Без заголовка">
        <span>
          <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
          <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
        </span><br>
        <span class="select">
          <b>Категория: </b><br>
          <a href="javascript:void(0);" class="slct">Шкафы-купе<i class="flaticon-chevron8"></i></a>
          <span class="status-fields">
            <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
            <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
          </span>
          <ul class="drop" data-id="77">
                          <li>Шкафы-купе</li>
                          <li>Кухни</li>
                          <li>Детские</li>
                          <li>Окна</li>
                          <li>Двери</li>
                          <li>Прихожие</li>
                          <li>Арки</li>
                          <li>Без категории</li>
                      </ul>
        </span>
      </span>
      <div class="clr"></div>
    </li>
      <li>
      <div class="img">
        <img src="/img/portfolio/small/974a0f6b4232e149c64b17a9f9f4ab39.jpg" alt="">
        <a class="button trash" data-id="76" href="javascript:void(0);"><i class="flaticon-trash3"></i> В корзину</a>
        <span class="edit-img" data-id="76"><i class="flaticon-photo7"></i> Изменить миниатюру</span>
      </div>
      <span>
        <b>Заголовок: </b><br>
        <input class="input-edit" type="text" value="fgdf sdfgsdfgs ad" size="60" data-id="<?php echo '<?=';?>$value->id<?php echo '?>';?>" placeholder="Без заголовка">
        <span>
          <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
          <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
        </span><br>
        <span class="select">
          <b>Категория: </b><br>
          <a href="javascript:void(0);" class="slct">Кухни<i class="flaticon-chevron8"></i></a>
          <span class="status-fields">
            <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
            <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
          </span>
          <ul class="drop" data-id="76">
                          <li>Шкафы-купе</li>
                          <li>Кухни</li>
                          <li>Детские</li>
                          <li>Окна</li>
                          <li>Двери</li>
                          <li>Прихожие</li>
                          <li>Арки</li>
                          <li>Без категории</li>
                      </ul>
        </span>
      </span>
      <div class="clr"></div>
    </li>
      <li>
      <div class="img">
        <img src="/img/portfolio/small/bfb3712957ddf8229737d592cc2c9f5e.png" alt="">
        <a class="button trash" data-id="75" href="javascript:void(0);"><i class="flaticon-trash3"></i> В корзину</a>
        <span class="edit-img" data-id="75"><i class="flaticon-photo7"></i> Изменить миниатюру</span>
      </div>
      <span>
        <b>Заголовок: </b><br>
        <input class="input-edit" type="text" value="sdfasdfa" size="60" data-id="<?php echo '<?=';?>$value->id<?php echo '?>';?>" placeholder="Без заголовка">
        <span>
          <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
          <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
        </span><br>
        <span class="select">
          <b>Категория: </b><br>
          <a href="javascript:void(0);" class="slct">Шкафы-купе<i class="flaticon-chevron8"></i></a>
          <span class="status-fields">
            <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
            <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
          </span>
          <ul class="drop" data-id="75">
                          <li>Шкафы-купе</li>
                          <li>Кухни</li>
                          <li>Детские</li>
                          <li>Окна</li>
                          <li>Двери</li>
                          <li>Прихожие</li>
                          <li>Арки</li>
                          <li>Без категории</li>
                      </ul>
        </span>
      </span>
      <div class="clr"></div>
    </li>
      <li>
      <div class="img">
        <img src="/img/portfolio/small/66913208cc589ef3f30533544368ad58.jpg" alt="">
        <a class="button trash" data-id="74" href="javascript:void(0);"><i class="flaticon-trash3"></i> В корзину</a>
        <span class="edit-img" data-id="74"><i class="flaticon-photo7"></i> Изменить миниатюру</span>
      </div>
      <span>
        <b>Заголовок: </b><br>
        <input class="input-edit" type="text" value="sdfasdf asdf sa" size="60" data-id="<?php echo '<?=';?>$value->id<?php echo '?>';?>" placeholder="Без заголовка">
        <span>
          <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
          <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
        </span><br>
        <span class="select">
          <b>Категория: </b><br>
          <a href="javascript:void(0);" class="slct">Шкафы-купе<i class="flaticon-chevron8"></i></a>
          <span class="status-fields">
            <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
            <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
          </span>
          <ul class="drop" data-id="74">
                          <li>Шкафы-купе</li>
                          <li>Кухни</li>
                          <li>Детские</li>
                          <li>Окна</li>
                          <li>Двери</li>
                          <li>Прихожие</li>
                          <li>Арки</li>
                          <li>Без категории</li>
                      </ul>
        </span>
      </span>
      <div class="clr"></div>
    </li>
  </ul>
<ul class="pagination">
  
  <div class="cleaner"></div>
</ul>
<div class="model-delete-category" title="Выбор фотографии">
  <div class="js-list-page" id="js-list-page">
    <div>
      <div class="img">
        <img src="/img/portfolio/big/" alt="">
      </div>
      <div class="preview-img"><img src="" alt="" style="position: relative"/></div>
    </div>
    <div class="buttons">
      <a class="button blue save-first" data-id="" href="javascript:void(0);"><i class="flaticon-checkmark2"></i> Сохранить</a>
    </div>
    <div class="clr"></div>
  </div>
</div><?php }
}
?>