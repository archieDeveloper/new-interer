<div class="table-wrap" data-controller="admin/portfolio/category">
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
    {include file="./table/list.tpl"}
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