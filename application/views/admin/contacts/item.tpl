<li>
  <div class="title-group">
    {$key}
    <a class="button" style="float: right; height: 14px; line-height: 14px;"
       href="?del="><i class="flaticon-trash3"></i></a>
  </div>
  <ul>
    {foreach from=$value item="current_contact"}
      <li>
        <div class="row-tools">
          <a class="button blue"
             href="?edit={$current_contact->contact_id}"><i
              class="flaticon-edit4"></i></a>
          <a class="button" href="?del={$current_contact->contact_id}"><i
              class="flaticon-trash3"></i></a>
        </div>
        <span>{$current_contact->contact}</span>
        <div class="clr"></div>
      </li>
    {/foreach}
    <a class="button green" href="#"><i class="flaticon-plus13"></i>
      Добавить {$key}</a>
  </ul>
</li>