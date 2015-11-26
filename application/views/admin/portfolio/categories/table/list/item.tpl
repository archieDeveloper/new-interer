<tr class="{$trClass[$trKey]}" data-id="{$current_field->id}">
  <td class="tg-checkbox"><input type="checkbox" name="selected[]" value="{$current_field->id}"/></td>
  <td class="tg-name">{$current_field->name}</td>
  <td class="tg-desc">{$current_field->description}</td>
  <td class="tg-slug">{$current_field->link}</td>
  <td class="tg-num">{$current_field->amount}</td>
  <td class="tg-tools">
    {if $current_field->link != 'no-category'}
      <a class="button blue edit-category" href="#" data-id="{$current_field->id}"><i class="flaticon-edit4"></i></a>
      <a class="button delete-category" href="#" data-id="{$current_field->id}"><i class="flaticon-trash3"></i></a>
    {/if}
  </td>
</tr>