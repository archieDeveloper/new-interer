<?php if (isset($page_title)) { echo '<h2>'.$page_title.'</h2>'; } ?>
<?php if ($_GET['page'] == 1) : ?>
  <div class="add-block">
    <div id="error"></div>
    <ul id="new-articles-box" class="list-page">
      <li>
        <p><b>Заголовок: </b><br><input id="title-new" class="input-edit" type="text"S></p>
        <p><b>Дата: </b><br><input id="date-new" type="date" class="input-edit data"></p>
        <p><b>Текст: </b><br><textarea id="text-new" class="input-edit textarea" cols="30" rows="10"></textarea></p>
        <a class="button green btn-publised-new" href="#"><i class="flaticon-checkmark2"></i> Опубликовать</a>
        <div class="clr"></div>
      </li>
    </ul>
  </div>
<?php endif; ?>