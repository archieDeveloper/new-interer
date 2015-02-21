<?php if (isset($page_title)) { echo '<h2>'.$page_title.'</h2>'; } ?>
<ul class="list-page">
<?php foreach ($pages_list as $key => $value) : ?>
    <li>
        <p><b>Название: </b><?=$value->title?></p>
        <p><b>Описание: </b><?=$value->description?></p>
        <p><b>Ключевые слова: </b><?=$value->keywords?></p>
        <p><b>Текст: </b><?php echo htmlspecialchars($value->text); ?></p>
        <a class="button blue" href="?edit=<?=$value->id?>"><i class="flaticon-edit4"></i> Редактировать</a>
        <a class="button" href="?del=<?=$value->id?>"><i class="flaticon-trash3"></i></a>
    </li>
<?php endforeach; ?>
</ul>