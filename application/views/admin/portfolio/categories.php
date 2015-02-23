<?php if (isset($page_title)) { echo '<h2>'.$page_title.'</h2>'; } ?>

<ul class="list-page">
    <li>
        <div class="title-group">Список категорий</div>
        <ul id="cat-list">
            <?php foreach ($list_category_portfolio as $current_field) : ?>
                <li data-position="<?=$current_field->position?>" data-link="<?=$current_field->link?>">
                    <div class="row-tools">
                        <a class="button blue" href="?edit=1"><i class="flaticon-edit4"></i></a>
                        <a class="button" href="?del=1"><i class="flaticon-trash3"></i></a>
                    </div>
                    <span><?=$current_field->name?> / <?=$current_field->link?></span>
                    <div class="clr"></div>
                </li>
            <?php endforeach;?>
        </ul>
        <a class="button green" href="#"><i class="flaticon-plus13"></i> Добавить пункт меню</a>
    </li>
</ul>