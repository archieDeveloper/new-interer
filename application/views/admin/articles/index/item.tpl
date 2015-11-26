<li>
  <div>
    <b>Заголовок: </b>
    <span class="title-art">{$value->title}</span>
    <div class="edit-title-art"><input class="input-edit" type="text"></div>
  </div>
  <div>
    <b>Дата: </b>
    <span class="date-art" data-date="{$value->date}">{date_rus($value->date)}</span>
    <div class="edit-date-art"><input class="input-edit data" type="date"></div>
  </div>
  <div>
    <b>Текст: </b><br>
        <span class="text-art">
          {assign var='art' value=explode_article($value->text)}
          <span class="desc-art">{$art[0]}</span>
          {if !empty($art[1])}
            <a href="#" class="show-all-text">Показать полный текст</a>
            <span class="all-text">
                <a href="#" class="hide-all-text">Скрыть полный текст</a>
                <span class="fulltext-art">{$art[1]}</span>
                <a href="#" class="hide-all-text">Скрыть полный текст</a>
            </span>
          {/if}
        </span>
    <div class="edit-text-art"><textarea class="input-edit textarea" name="" id="" cols="30" rows="10"></textarea></div>
  </div>
  <div class="art-nav-1">
    <a class="button blue edit-art" href="#" data-id="{$value->id}"><i class="flaticon-edit4"></i> Редактировать</a>
    <a class="button del-art" href="#" data-id="{$value->id}"><i class="flaticon-trash3"></i></a>
  </div>
  <div class="art-nav-2">
    <a class="button fr no-edit-art" href="#"><i class="flaticon-cross5"></i> Отменить</a>
    <a class="button green save-edit-art" href="#" data-id="{$value->id}"><i class="flaticon-checkmark2"></i> Сохранить</a>
  </div>
  <div class="clr"></div>
</li>