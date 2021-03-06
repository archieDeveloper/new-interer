<?php if (isset($page_title)) { echo '<h2>'.$page_title.' <a href="/nimyadmin/portfolio/add.html" class="button green"><i class="flaticon-plus13"></i> Добавить работу</a></h2>'; } ?>

<div style="display: none">
  <span>Скрипт для обновления структуры БД</span>
  <span>UPDATE `portfolio`,`category_portfolio` SET `portfolio`.`category_id` = `category_portfolio`.`id` WHERE `portfolio`.`category_link` = `category_portfolio`.`link`</span>

  inputmask
</div>

<ul class="pagination">
  <?php pagination($_GET['page'], $num_pages, '<i class="flaticon-thin6"></i>', '<i class="flaticon-thin2"></i>'); ?>
  <div class="cleaner"></div>
</ul>
<ul class="list-page">
  <?php foreach ($portfolio as $key => $value) : ?>
    <li>
      <div class="img">
        <img src="/img/portfolio/small/<?=$value->img?>" alt="">
        <a class="button trash" data-id="<?=$value->id?>" href="javascript:void(0);"><i class="flaticon-trash3"></i> В корзину</a>
        <span class="edit-img" data-id="<?=$value->id?>"><i class="flaticon-photo7"></i> Изменить миниатюру</span>
      </div>
      <span>
        <b>Заголовок: </b><br>
        <input class="input-edit" type="text" value="<?=$value->title?>" size="60" data-id="<?=$value->id?>" placeholder="Без заголовка">
        <span>
          <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
          <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
        </span><br>
        <span class="select">
          <b>Категория: </b><br>
          <a href="javascript:void(0);" class="slct"><?=$value->name?><i class="flaticon-chevron8"></i></a>
          <span class="status-fields">
            <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
            <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
          </span>
          <ul class="drop" data-id="<?=$value->id?>">
            <?php foreach ($list_category_portfolio as $value) : ?>
              <li><?=$value->name?></li>
            <?php endforeach; ?>
          </ul>
        </span>
      </span>
      <div class="clr"></div>
    </li>
  <?php endforeach; ?>
</ul>
<ul class="pagination">
  <?php pagination($_GET['page'], $num_pages, '<i class="flaticon-thin6"></i>', '<i class="flaticon-thin2"></i>'); ?>
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
</div>