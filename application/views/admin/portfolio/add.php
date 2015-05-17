<?php if (isset($page_title)) { echo '<h2>'.$page_title.'</h2>'; } ?>

<div class="add-block">
  <?php echo form_open_multipart('/nimyadmin/portfolio', array('id' => 'fileupload')); ?>
  <span class="fileinput-button button green">
      <span><i class="flaticon-plus13"></i> Добавить работу</span>
      <input id="input-file" type="file" name="userfile" multiple>
  </span>
  <?php echo form_close(); ?>
  <div id="error"></div>
  <ul id="files" class="list-page"></ul>
</div>
<ul class="list-page">

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
      <a class="button blue save-first" data-id="" href="javascript:void(0);"><i class="flaticon-checkmark2"></i> Сохранить и продолжить</a>
    </div>
    <div class="clr"></div>
  </div>

  <div class="js-list-page" id="js-list-page2">
    <?php /*<div>
      <div class="img">
        <img src="/img/portfolio/big/" alt="">
      </div>
      <div class="preview-img"><img src="" alt="" style="position: relative"/></div>
    </div>
    <div class="buttons">
      <a class="button blue trash" data-id="" href="javascript:void(0);"><i class="flaticon-trash3"></i> Сохранить и продолжить</a>
      <a class="button green back2" data-id="" href="javascript:void(0);"><i class="flaticon-trash3"></i> Вернуться назад</a>
    </div>
    <div class="clr"></div>*/?>

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
          <?php foreach ($list_category_portfolio as $value) : ?>
            <li><?=$value->name?></li>
          <?php endforeach; ?>
        </ul>
      </span>
    </span>

    <div class="buttons">
      <a class="button blue close" data-id="" href="javascript:void(0);"><i class="flaticon-checkmark2"></i> Сохранить</a>
      <a class="button green back2" data-id="" href="javascript:void(0);"><i class="flaticon-thin6"></i> Вернуться назад</a>
    </div>
    <div class="clr"></div>
  </div>
</div>