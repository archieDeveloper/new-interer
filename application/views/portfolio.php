<div class="wrap breadcrumb-wrap">
  <div class="wrap-center">
    <ul class="breadcrumb">
      <?php breadcrumb($breadcrumb); ?>
    </ul>
  </div>
</div>
<div class="wrap">
  <div class="wrap-center">
    <div class="left-aside">
      <span>Категории</span>
      <ul>
        <?php foreach ($list_category_portfolio as $item) : ?>
          <?php if ($item->link != 'no-category') : ?>
          <li <?php if(isset($category) && $item->link == $category) { echo 'class="active"'; } ?>><a href="/portfolio/category/<?=$item->link?>.html"><?=$item->name?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="wrap-products">
      <ul class="pagination">
        <?php pagination($_GET['page'], $num_pages); ?>
        <?php if(isset($count_portfolio)): ?>
        <li class="count-elem">
          Показано работ с <?=$count_portfolio['from']?> по <?=$count_portfolio['to']?>
        </li>
        <?php endif; ?>
        <div class="cleaner"></div>
      </ul>
      <div id="portfolio-container">
        <?php foreach ($portfolio as $product) : ?>
        <article class="wrap-product">
          <a href="/img/portfolio/big/<?=$product->img?>" data-id='<?=$product->id?>' title='<?=$product->title?>'>
            <img class="view-icon" src="http://s1.iconbird.com/ico/2013/11/504/w128h1281385326527zoomin.png" alt="">
            <img src="/img/portfolio/small/<?=$product->img?>" alt="">
            <span><?=$product->title?></span>
          </a>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="cleaner"></div>
      <ul class="pagination">
        <?php pagination($_GET['page'], $num_pages); ?>
        <?php if(isset($count_portfolio)): ?>
        <li class="count-elem">
          Показано работ с <?=$count_portfolio['from']?> по <?=$count_portfolio['to']?>
        </li>
        <?php endif; ?>
        <div class="cleaner"></div>
      </ul>
      <div class="cleaner"></div>
    </div>
    <?php if (isset($current_product) && $current_product) : ?>
      <div id="current_product" data-id="<?=$current_product->id?>" data-img="<?=$current_product->img?>" data-title='<?=$current_product->title?>'></div>
    <?php endif; ?>
    <div class="cleaner"></div>
  </div>
</div>