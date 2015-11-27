<tr class="{$trClass[$trKey]} js-category-item" data-id="{$current_field->id}">
  <td class="tg-checkbox js-checkbox"><input type="checkbox" name="selected[]" value="{$current_field->id}"/></td>
  <td class="tg-name js-name">{$current_field->name}</td>
  <td class="tg-desc js-description">{$current_field->description}</td>
  <td class="tg-slug js-slug">{$current_field->link}</td>
  <td class="tg-num js-amount">{$current_field->amount}</td>
  <td class="tg-tools js-tools">
    {if $current_field->link != 'no-category'}
      <a class="button blue edit-category js-button-edit" href="#"><i class="flaticon-edit4"></i></a>
      <a class="button delete-category js-button-remove" href="#"><i class="flaticon-trash3"></i></a>
    {/if}
  </td>
</tr>