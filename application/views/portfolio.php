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
        <?php if(isset($count_portfolio) && $count_portfolio['to'] > 1): ?>
        <li class="count-elem">
          Показано работ с <?=$count_portfolio['from']?> по <?=$count_portfolio['to']?>
        </li>
        <?php endif; ?>
        <div class="cleaner"></div>
      </ul>
      <div id="portfolio-container">
        <?php foreach ($portfolio as $product) :?>
        <article class="wrap-product">
          <a rel="<?=$product->link?>" href="/img/portfolio/big/<?=$product->img?>" data-id='<?=$product->id?>' title='<?=$product->title?>'>
            <img class="view-icon" src="/img/elem/zoomin.png" alt="<?=$product->title?>">
            <img src="/img/portfolio/small/<?=$product->img?>" alt="Полный размер изображения">
            <span><?=$product->title?></span>
          </a>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="cleaner"></div>
      <ul class="pagination">
        <?php pagination($_GET['page'], $num_pages); ?>
        <?php if(isset($count_portfolio) && $count_portfolio['to'] > 1): ?>
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

<div id="sing_up_froze">
  <div id="sing_up_froze_close">x</div>
  <div id="order_form_title"><h2>Запись на замер</h2></div>
  <div id="froze_status"><div style='display:none;' id='status'></div></div>
  <form id="order_form" method="post">
    <div><label for="name">Ваше имя:</label> <input style="float:right; width: 380px;" type="text" name="name" id="name" required><div class="cleaner"></div></div>
    <div><label for="number">Телефон:</label> <input style="float:right; width: 380px;" type="text" name="number" id="number" required><div class="cleaner"></div></div>
    <div><label style="width: 121px;">Желаемое время:</label>
      <span class="select-prev">с</span>
      <span class="select" id="start_time">
        <a href="javascript:void(0);" class="slct"><span>10</span><i class="flaticon-chevron8"></i></a>
        <ul class="drop" data-id="1">
          <li>10</li><li>11</li><li>12</li><li>13</li><li>14</li><li>15</li><li>16</li><li>17</li><li>18</li><li>19</li><li>20</li>
        </ul>
        <div class="cleaner"></div>
      </span>
      <span class="select-prev">до</span>
      <span class="select" id="end_time">
        <a href="javascript:void(0);" class="slct"><span>11</span><i class="flaticon-chevron8"></i></a>
        <ul class="drop" data-id="1">
          <li>11</li><li>12</li><li>13</li><li>14</li><li>15</li><li>16</li><li>17</li><li>18</li><li>19</li>
        </ul>
        <div class="cleaner"></div>
      </span>
    </div>
    <button style="float:right;" class="button" name="add_callback">Записаться</button>
  </form>
</div>