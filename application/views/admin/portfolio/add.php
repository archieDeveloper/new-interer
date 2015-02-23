<?php if (isset($page_title)) { echo '<h2>'.$page_title.'</h2>'; } ?>

<?php if ($_GET['page'] == 1) : ?>
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
<?php endif; ?>
<ul class="list-page">
  <li id="js-list-page">
    <span class="img">
      <img src="/img/portfolio/small/" alt="">
      <a class="button trash" data-id="" href="javascript:void(0);"><i class="flaticon-trash3"></i> В корзину</a>
    </span>
    <span>
      <b>Заголовок: </b><br>
      <input class="input-edit" type="text" value="" data-id="" placeholder="Без заголовка">
      <span>
        <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
        <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
      </span><br>
      <span class="select">
        <b>Категория: </b><br>
        <a href="javascript:void(0);" class="slct">Без категории<i class="flaticon-chevron8"></i></a>
        <span class="status-fields">
          <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
          <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
        </span>
        <ul class="drop" data-id="">
          <?php foreach ($list_category_portfolio as $value) : ?>
            <li><?=$value->name?></li>
          <?php endforeach; ?>
        </ul>
      </span>
    </span>
    <div class="clr"></div>
  </li>
</ul>