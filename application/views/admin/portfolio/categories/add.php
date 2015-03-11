<?php if (isset($page_title)) { echo '<h2>'.$page_title.'</h2>'; } ?>

<div class="form-wrap">
  <form id="addcat" method="post" action="/nimyadmin/portfolio.html" class="validate">
    <div class="form-field">
      <label for="tag-name">Название</label>
      <input class="input-edit" name="tag-name" id="tag-name" type="text" size="30" aria-required="true">
      <p>Название определяет, как категория будет отображаться на вашем сайте.</p>
    </div>
    <div class="form-field term-slug-wrap">
      <label for="tag-slug">Ярлык</label>
      <input class="input-edit" name="slug" id="tag-slug" type="text" size="30">
      <p>«Ярлык» — это вариант названия, подходящий для URL. Обычно содержит только латинские буквы в нижнем регистре, цифры и дефисы.</p>
    </div>
    <div class="form-field term-description-wrap">
      <label for="tag-description">Описание</label>
      <textarea class="input-edit" name="description" id="tag-description" rows="5" cols="30"></textarea>
      <p>Описание по умолчанию не отображается, однако некоторые темы могут его показывать.</p>
    </div>
    <p class="submit">
      <a href="#" name="submit" id="submit" class="button green left"><i class="flaticon-plus13"></i> Добавить</a>
      <a href="/nimyadmin/portfolio/categories.html" class="button right"><i class="flaticon-cross5"></i> Отменить</a>
    </p>
  </form>
</div>