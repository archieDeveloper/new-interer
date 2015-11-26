<tbody id="cat-list-tb">
{assign var='trKey' value=false}
{assign var='trClass' value=['tg-4eph', 'tg-031e']}
{foreach from=$list_category_portfolio item="current_field"}
  {$trKey = !$trKey}
  {include file="./list/item.tpl"}
{/foreach}
</tbody>