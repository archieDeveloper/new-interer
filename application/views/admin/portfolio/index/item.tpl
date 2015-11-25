<li class="js-portfolio-item">
  <div class="img">
    <img src="/img/portfolio/small/{$value->img}" alt="">
    <a class="button trash" data-id="{$value->id}" href="javascript:void(0);"><i class="flaticon-trash3"></i> В корзину</a>
    <span class="edit-img" data-id="{$value->id}"><i class="flaticon-photo7"></i> Изменить миниатюру</span>
  </div>
  <span>
    <b>Заголовок: </b><br>
    <input class="input-edit js-portfolio-title" type="text" value="{$value->title}" size="60" data-id="{$value->id}" placeholder="Без заголовка">
    <span>
      <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
      <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
    </span><br>
    <span class="select">
      <b>Категория: </b><br>
      <a href="javascript:void(0);" class="slct">{$value->name}<i class="flaticon-chevron8"></i></a>
      <span class="status-fields">
        <span class="status-field-edit"><i class="flaticon-edit4"></i> Редактирование...</span>
        <span class="status-field-save"><i class="flaticon-upload8"></i> Сохранение...</span>
      </span>
      <ul class="drop" data-id="{$value->id}">
        {foreach from=$list_category_portfolio item="value"}
          <li>{$value->name}</li>
        {/foreach}
      </ul>
    </span>
  </span>
  <div class="clr"></div>
</li>