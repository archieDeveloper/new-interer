{if isset($page_title)}<h2>{$page_title}</h2>{/if}
<a href="/nimyadmin/articles/add.html" class="button green btn-new-art"><i class="flaticon-plus13"></i> Добавить статью</a>
{include file="admin/templates/pagination.tpl"}
{include file="./index/list.tpl"}
{include file="admin/templates/pagination.tpl"}