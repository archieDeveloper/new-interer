<ul class="list-page js-portfolio-list" data-controller="admin/portfolio/list">
  {foreach from=$portfolio item="value" key="key"}
    {include file="./item.tpl"}
  {/foreach}
</ul>