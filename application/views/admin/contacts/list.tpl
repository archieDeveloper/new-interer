<ul class="list-page">
  {foreach from=$contacts key="key" item="value"}
    {include file="./item.tpl"}
  {/foreach}
</ul>