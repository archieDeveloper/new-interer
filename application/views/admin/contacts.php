<?php if (isset($page_title)) { echo '<h2>'.$page_title.'</h2>'; } ?>
<div class="add-block">
    <a class="button green" href="#"><i class="flaticon-plus13"></i> Добавить группу</a>
</div>
<ul class="list-page">
<?php foreach ($contacts as $key => $value) : ?>
    <li>
        <div class="title-group">
            <?=$key?>
            <a class="button" style="float: right; height: 14px; line-height: 14px;" href="?del="><i class="flaticon-trash3"></i></a>
        </div>
        <ul>
        <?php foreach ($value as $current_contact) : ?>
            <li>
                <div class="row-tools">
                    <a class="button blue" href="?edit=<?=$current_contact->contact_id?>"><i class="flaticon-edit4"></i></a>
                    <a class="button" href="?del=<?=$current_contact->contact_id?>"><i class="flaticon-trash3"></i></a>
                </div>
                <span><?=$current_contact->contact?></span>
                <div class="clr"></div>
            </li>
        <?php endforeach; ?>
        <a class="button green" href="#"><i class="flaticon-plus13"></i> Добавить <?=$key?></a>
        </ul>
    </li>
<?php endforeach; ?>
</ul>