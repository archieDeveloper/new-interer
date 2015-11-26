{if isset($page_title)}<h2>{$page_title}</h2>{/if}
<a href="/nimyadmin/portfolio/add.html" class="button green"><i class="flaticon-plus13"></i> Добавить работу</a>
{include file="admin/templates/pagination.tpl"}
{include file="./portfolio/list.tpl"}
{include file="admin/templates/pagination.tpl"}
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