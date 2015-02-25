<?php if (isset($page_title)) { echo '<h2>'.$page_title.'</h2>'; } ?>

<table class="tg">
  <thead>
    <tr>
      <th style="border-radius: 5px 0 0 0">Название</th>
      <th>Описание</th>
      <th>Ярлык</th>
      <th>Кол-во работ</th>
      <th style="border-radius: 0 5px 0 0"></th>
    </tr>
  </thead>
  <tbody id="cat-list-tb">
    <?php $trKey = false; $trClass = array("tg-4eph","tg-031e");
    foreach ($list_category_portfolio as $current_field) :
      $trKey = !$trKey; ?>
      <tr class="<?=$trClass[$trKey]?>" data-id="<?=$current_field->id?>">
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
</table>