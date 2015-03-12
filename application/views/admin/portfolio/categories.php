<?php if (isset($page_title)) { echo '<h2>'.$page_title.'</h2>'; } ?>

<div class="form-wrap">
  <h3>Добавить новую категорию</h3>
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
      <a href="#" name="submit" id="add-category-portfolio" class="button green left"><i class="flaticon-plus13"></i> Добавить новую категорию</a>
    </p>
  </form>
</div>

<div class="table-wrap">
  <table class="tg">
    <thead>
    <tr>
      <th><input type="checkbox"/></th>
      <th>Название</th>
      <th>Описание</th>
      <th>Ярлык</th>
      <th>Работы</th>
      <th></th>
    </tr>
    </thead>
    <tbody id="cat-list-tb">
    <?php $trKey = false; $trClass = array("tg-4eph","tg-031e");
    foreach ($list_category_portfolio as $current_field) :
      $trKey = !$trKey; ?>
      <tr class="<?=$trClass[$trKey]?>" data-id="<?=$current_field->id?>">
        <td class="tg-checkbox"><input type="checkbox" name="selected[]" value="<?=$current_field->id?>"/></td>
        <td class="tg-name"><?=$current_field->name?></td>
        <td class="tg-desc"><?=$current_field->description?></td>
        <td class="tg-slug"><?=$current_field->link?></td>
        <td class="tg-num"><?=$current_field->amount?></td>
        <td class="tg-tools">
          <a class="button blue edit-category" href="#" data-id="<?=$current_field->id?>"><i class="flaticon-edit4"></i></a>
          <a class="button" href="#"><i class="flaticon-trash3"></i></a>
        </td>
      </tr>
    <?php endforeach;?>
    </tbody>
    <tfoot>
    <tr>
      <th><input type="checkbox"/></th>
      <th>Название</th>
      <th>Описание</th>
      <th>Ярлык</th>
      <th>Работы</th>
      <th></th>
    </tr>
    </tfoot>
  </table>
  <p>
    <strong>Примечание:</strong>
  </p>
  <ul>
    <li>Удаление категории не приводит к удалению работ из этой категории. Вместо этого работы из удалённой категории будут перемещены в категорию <strong>Без категории</strong>.</li>
    <li>Изменить сортировку списка категорий можно обычным перетаскиванием элементов списка.</li>
  </ul>
</div>