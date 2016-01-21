<tr class="tg-jh46 js-edit-form" data-id="{$id}">
  <td colspan="6" class="colspanchange">
    <fieldset class="js-fieldset">
      <div class="inline-edit-col">
        <h4>Свойства</h4>
        <label>
          <span class="title">Название</span>
          <span class="input-text-wrap"><input type="text" name="name" class="ptitle input-edit tg-name js-name" value="{$name}"></span>
          </label>
        <label>
          <span class="title">Описание</span>
          <span class="input-text-wrap"><input type="text" name="desc" class="ptitle input-edit tg-desc js-description" value="{$desc}"></span>
          </label>
        <label>
          <span class="title">Ярлык</span>
          <span class="input-text-wrap"><input type="text" name="slug" class="ptitle input-edit tg-slug js-slug" value="{$slug}"></span>
          </label>
        </div>
    </fieldset>
    <p class="inline-edit-save submit js-tools">
      <a href="#inline-edit" class="button cancel-edit-category right green js-button-cancel-edit"><i class="flaticon-cross5"></i> Отменить</a>
      <a href="#inline-edit" class="button save-edit-category left blue js-button-save"><i class="flaticon-checkmark2"></i> Обновить категорию</a>
      <span class="error js-error" style="display:none;"></span>
    </p>
  </td>
</tr>