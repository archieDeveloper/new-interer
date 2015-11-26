<ul class="list-page">
  {foreach from=$feedback_list key="key" item="value"}
    {include file="./item.tpl"}
  {foreachelse}
    <li>
      <p>Нет заявок на замер</p>
    </li>
  {/foreach}
</ul>