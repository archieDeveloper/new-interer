<div class="form-wrap">
  <h3>Добавить новую категорию</h3>
  <form id="addcat" method="post" action="/nimyadmin/portfolio.html" class="validate js-category-add-form" data-controller="admin/portfolio/categories/add">
    <div class="form-field addcat-name">
      <label for="tag-name">Название</label>
      <input class="input-edit js-name" name="tag-name" id="tag-name" type="text" size="30" aria-required="true">
      <p class="error js-name-error"></p>
      <p>Название определяет, как категория будет отображаться на вашем сайте.</p>
    </div>
    <div class="form-field addcat-slug">
      <label for="tag-slug">Ярлык</label>
      <input class="input-edit js-slug" name="slug" id="tag-slug" type="text" size="30">
      <p class="error js-slug-error"></p>
      <p>«Ярлык» — это вариант названия, подходящий для URL. Обычно содержит только латинские буквы в нижнем регистре, цифры и дефисы.</p>
    </div>
    <div class="form-field addcat-desc">
      <label for="tag-description">Описание</label>
      <textarea class="input-edit js-description" name="description" id="tag-description" rows="5" cols="30"></textarea>
      <p>Описание по умолчанию не отображается, однако некоторые темы могут его показывать.</p>
    </div>
    <p class="submit">
      <a href="#" name="submit" id="add-category-portfolio" class="button green left js-button-add"><i class="flaticon-plus13"></i> Добавить новую категорию</a>
    </p>
  </form>
</div>