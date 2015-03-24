</div>
<div id="footer_wrap">
  <footer id="footer">
    <nav>
      <ul class="footer_nav">
        <span>Меню</span>
        <?php foreach ($page_list as $value): if($value->show_footer):?>
          <?php switch ($value->type): case "template": ?>
            <li><a href="/<?=$value->name;?><?php if (!empty($value->name)) : echo '.html'; endif;?>" <?php if($value->id == $page_info->id || $value->id == $page_info->parent) {echo 'id="nav_footer_active"';} ?>><?=$value->title;?></a></li>
          <?php break; case "page": ?>
            <li><a href="/<?=$value->name;?>.html" <?php if($value->id == $page_info->id || $value->id == $page_info->parent) {echo 'id="nav_footer_active"';} ?>><?=$value->title;?></a></li>
          <?php break; endswitch; ?>
        <?php endif; endforeach; ?>
      </ul>

      <ul class="footer_nav">
        <span>Каталог</span>
        <?php foreach ($list_category_portfolio as $item) : ?>
          <?php if ($item->link != 'no-category') : ?>
            <li <?php if(isset($category) && $item->link == $category) { echo 'class="active"'; } ?>><a href="/portfolio/category/<?=$item->link?>.html"><?=$item->name?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <ul class="footer_nav">
        <span>Информация</span>
        <li><a href="/">Карта сайта</a></li>
        <li><a href="/portfolio.html">Политика</a></li>
        <li><a href="/contacts.html">Обратная связь</a></li>
        <li><a href="/">Вакансии</a></li>
        <li><a href="/portfolio.html">Сотрудничество</a></li>
      </ul>
      <?php /*<ul id="footer_nav">
        <span>Сервис и помощь</span>
        <li><a href="">Правила аукциона</a></li>
        <li><a href="">Политика сайта</a></li>
        <li><a href="">Обратная связь</a></li>
      </ul>*/?>
    </nav>
    <div id="soc_seti">
      <div class="addthis_toolbox" id="social_block">
        <div id="addthis_toolbox_share" class="text">
          <p>Следуйте за нами в соц. сетях</p>
        </div>
        <div class="soc-icons">
          <a href="http://vk.com/newinterer" class="vk-icon"></a>
          <a href="http://odnoklassniki.ru/group/54243398516741" class="ok-icon"></a>
        </div>
        <div class="cleaner"></div>
        <p style="margin:15px 0 0 0;">+7 (951) 226-25-96</p>
        <p>Часы работы: с 9:00 до 18:00</p>
    </div>
  </footer>
</div>
<div class="copyrigth">Новый Интерьер <?php echo date('Y'); ?>г. Все права защищены.</div>
</div>
</body>
</html>