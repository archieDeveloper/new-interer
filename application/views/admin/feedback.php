<?php if (isset($page_title)) {
  echo '<h2>' . $page_title . '</h2>';
} ?>

<ul class="list-page">
  <?php if ($feedback_list) : foreach ($feedback_list as $key => $value) : ?>
    <li>
      <h3>Заявка на замер</h3>

      <p><b>Имя: </b><?= $value->name ?></p>

      <p><b>Номер телефона: </b><?= $value->number ?></p>

      <p><b>Желаемое время: </b>с <?= $value->start_time ?> до <?= $value->end_time ?></p>
      <a class="button" href="?del=<?= $value->id ?>"><i class="flaticon-trash3"></i></a>

      <div class="clr"></div>
    </li>
  <?php endforeach;
  else: ?>
    <li>
      <p>Нет заявок на замер</p>
    </li>
  <?php endif; ?>
</ul>