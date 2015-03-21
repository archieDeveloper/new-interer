<div class="wrap">
  <div class="wrap-center">
    <div class="left-aside">
      <span>Категории</span>
      <ul>
        <?php foreach ($list_category_portfolio as $element_category_portfolio) : ?>
          <?php if ($element_category_portfolio->link != 'no-category') : ?>
          <li><a href="/portfolio/category/<?=$element_category_portfolio->link?>.html"><?=$element_category_portfolio->name?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="wrap-products">
      <ul class="pagenation">
          <?php pagination($_GET['page'], $num_pages); ?>
          <div class="cleaner"></div>
      </ul>
      <?php foreach ($portfolio as $product) : ?>
      <article class="wrap-product">
        <a href="/img/portfolio/big/<?=$product->img?>" data-id='<?=$product->id?>' title='<?=$product->title?>'><img src="/img/portfolio/small/<?=$product->img?>" alt=""><span><?=$product->title?></span></a>
      </article>
      <?php endforeach; ?>
      <div class="cleaner"></div>
      <ul class="pagenation">
          <?php pagination($_GET['page'], $num_pages); ?>
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