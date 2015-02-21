<h2><?=$page_info->title?></h2>
<ul class="pagenation">
    <?php pagination($_GET['page'], $num_pages); ?>
    <div class="cleaner"></div>
</ul>
<div id='wrap-post-news'>
<?php foreach ($news as $arr) : ?>
<article class="post_news">
    <div class="title_news">
        <h3><a href="/article/id/<?=$arr->id?>.html"><?=$arr->title?></a></h3>
        <span style="font-size:12px; margin: 15px 0 0 0;"><?php echo date_rus($arr->date); ?></span>
    </div>
    <div class="content_news">
        <span><?php $art = explode_article($arr->text); echo $art[0]; ?></span> <a href="/article/id/<?=$arr->id?>.html">Читать далее</a>
    </div>
</article>
<?php endforeach; ?>
</div>
<ul class="pagenation">
    <?php pagination($_GET['page'], $num_pages); ?>
    <div class="cleaner"></div>
</ul>
<div class="cleaner"></div>