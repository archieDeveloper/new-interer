{if isset($page_title)}<h2>{$page_title}</h2>{/if}
<ul class="list-page">
  {foreach from=$pages_list key="key" item="value"}
    <li>
      <p><b>Название: </b>{$value->title}</p>
      <p><b>Описание: </b>{$value->description}</p>
      <p><b>Ключевые слова: </b>{$value->keywords}</p>
      <p><b>Текст: </b>{$value->text|htmlspecialchars}</p>
      <a class="button blue" href="?edit={$value->id}"><i
          class="flaticon-edit4"></i> Редактировать</a>
      <a class="button" href="?del={$value->id}"><i class="flaticon-trash3"></i></a>
    </li>
  {/foreach}
</ul>