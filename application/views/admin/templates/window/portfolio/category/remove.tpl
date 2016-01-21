<div class="model-delete-category" title="Вы абсолютно уверены?">
  <p>
    Это действие <strong>не может</strong> быть отменено. Оно навсегда удалит
    категорию <strong>«<span class="tg-name">{$category->name}</span>»</strong>.
    Удаление категории <strong>не приведет</strong> к удалению выполненных работ
    из этой категории. Вместо этого выполненные работы из удалённой категории
    будут перемещены в категорию <strong>«Без категории»</strong>.
  </p>
  <p>Пожалуйста, введите имя категории для подтверждения.</p>
  <form id="delete-category" method="post" class="validate">
    <div class="form-field addcat-name">
      <input class="input-edit" name="tag-name" id="tag-name" type="text"
             size="30" aria-required="true" required>
      <input id="tag-id" name="tag-id" type="hidden" aria-required="true"
             required value="{$category->id}">
      <p class="error"></p>
    </div>
    <p class="submit">
      <button name="submit" id="delete-category-portfolio" class="button left js-button-remove"
              disabled>
        <i class="flaticon-trash3"></i> Я понимаю последствия, удалить эту категорию
      </button>
    </p>
  </form>
</div>