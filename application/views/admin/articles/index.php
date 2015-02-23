<?php if (isset($page_title)) { echo '<h2>'.$page_title.' <a href="/nimyadmin/articles/add.html" class="button green btn-new-art"><i class="flaticon-plus13"></i> Добавить статью</a></h2>'; } ?>

<ul class="pagenation">
  <?php pagination($_GET['page'], $num_pages, '<i class="flaticon-thin6"></i>', '<i class="flaticon-thin2"></i>'); ?>
  <div class="cleaner"></div>
</ul>
<ul class="list-page ajax-pre">
  <?php foreach ($articles as $key => $value) : ?>
    <li>
      <div>
        <b>Заголовок: </b>
        <span class="title-art"><?=$value->title?></span>
        <div class="edit-title-art"><input class="input-edit" type="text"></div>
      </div>
      <div>
        <b>Дата: </b>
        <span class="date-art" data-date="<?=$value->date?>"><?php echo date_rus($value->date); ?></span>
        <div class="edit-date-art"><input class="input-edit data" type="date"></div>
      </div>
      <div>
        <b>Текст: </b><br>
            <span class="text-art">
                <span class="desc-art"><?php $art = explode_article($value->text); echo $art[0]; ?></span>
              <?php if (!empty($art[1])) : ?>
                <a href="#" class="show-all-text">Показать полный текст</a>
                <span class="all-text">
                    <a href="#" class="hide-all-text">Скрыть полный текст</a>
                    <span class="fulltext-art"><?=$art[1]?></span>
                    <a href="#" class="hide-all-text">Скрыть полный текст</a>
                </span>
              <?php endif; ?>
            </span>
        <div class="edit-text-art"><textarea class="input-edit textarea" name="" id="" cols="30" rows="10"></textarea></div>
      </div>
      <div class="art-nav-1">
        <a class="button blue edit-art" href="#" data-id="<?=$value->id?>"><i class="flaticon-edit4"></i> Редактировать</a>
        <a class="button del-art" href="#" data-id="<?=$value->id?>"><i class="flaticon-trash3"></i></a>
      </div>
      <div class="art-nav-2">
        <a class="button fr no-edit-art" href="#"><i class="flaticon-cross5"></i> Отменить</a>
        <a class="button green save-edit-art" href="#" data-id="<?=$value->id?>"><i class="flaticon-checkmark2"></i> Сохранить</a>
      </div>
      <div class="clr"></div>
    </li>
  <?php endforeach; ?>
</ul>
<ul class="pagenation">
  <?php pagination($_GET['page'], $num_pages, '<i class="flaticon-thin6"></i>', '<i class="flaticon-thin2"></i>'); ?>
  <div class="cleaner"></div>
</ul>