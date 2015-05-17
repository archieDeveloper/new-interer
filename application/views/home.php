<div class="wrap gray">
  <div class="wrap-center aniview" av-animation="slideInUp">
    <h2>Наши услуги</h2>
    <div class="big-circle-image">
      <img src="/img/soclogo.jpg" alt=""/>
    </div>
    <p>Компания «Новый интерьер» уже более 7 лет занимается изготовлением мебели на заказ. У нас Вы можете заказать кухни, шкафы-купе, прихожие, детские, гардеробные, двери и окна по Вашему индивидуальному проекту не выходя из дома, только представьте теперь всё что Вам нужно под рукой. </p>
    <p>В современную эпоху очень важно экономить свое время, поэтому Вы можете оставить заявку на нашем сайте. Мы свяжемся с Вами и начнем создавать Ваш проект Онлайн. Также вы можете придти к нам в офисы указанные в контактах. Не важно какой путь Вы выбираете важно что мы поможем создать в Вашем доме Новый интерьер...
    </p>
    <p>Стоимость Вашей мебели создаете Вы сами поэтому у нас есть решения от бюджетных до элитных вариантов.</p>
    <p><a href="#">Закажите звонок</a> или <a href="#">отправьте информацию</a> о проекте (может быть у вас уже есть техзадание) и тогда мы сможем сформировать цену которая подходит Вам.</p>
  </div>
</div>

<div class="wrap">
  <div class="wrap-center aniview" av-animation="slideInRight">
    <h2>Наши преимущества</h2>
    <ul class="about-list">
      <li>
        <div class="header-about">
          <div class="image"><img src="http://livedemo00.template-help.com/wt_42974/images/icon-1.png" alt=""/></div>
          <div>
            <b>Креативные</b><br>идеи
          </div>
        </div>
        <p>
          Изобретая новый дизайн вашего дома, мы постоянно придумываем новые креативные и оригинальные идеи, которые придают Вашему дому индивидуальность!
        </p>
      </li>
      <li>
        <div class="header-about">
          <div class="image"><img src="http://livedemo00.template-help.com/wt_42974/images/icon-2.png" alt=""/></div>
          <div>
            <b>Умные</b><br>проекты
          </div>
        </div>
        <p>
          Проектируя красивый дизайн нужно еще и учитывать его удобность и функциональность, наша мебель не только выглядит красиво, но и удобна в использовании!
        </p>
      </li>
      <li>
        <div class="header-about">
          <div class="image"><img src="http://livedemo00.template-help.com/wt_42974/images/icon-3.png" alt=""/></div>
          <div>
            <b>Экологические</b><br>матерьялы
          </div>
        </div>
        <p>
          Мы против порчи природы, по этому многие природные матерьялы заменены на безвредные аналоги, которые служат намного дольше!
        </p>
      </li>
      <li>
        <div class="header-about">
          <div class="image"><img src="http://livedemo00.template-help.com/wt_42974/images/icon-4.png" alt=""/></div>
          <div>
            <b>Лучшие</b><br>результаты
          </div>
        </div>
        <p>
          Более 6 000 заказов было выполненно, за этот период времени мы научились создавать лучшую мебель для Вашего дома, мы номер один!
        </p>
      </li>
    </ul>
  </div>
</div>

<div class="wrap pink wrap-portfolio-hidden">
  <div class="wrap-center aniview" av-animation="slideInLeft">
    <h2>Выполненные работы</h2>
    <div id="portfolio-container" style="width: 1280px;">
      <?php foreach ($portfolio as $product) : ?>
      <article class="wrap-product">
          <a href="/portfolio<?=$product->link ? '/category/'.$product->link : ''?>.html?id_product=<?=$product->id?>"><img src="/img/portfolio/small/<?=$product->img?>" alt=""><span><?=$product->title?></span></a>
      </article>
      <?php endforeach; ?>
    </div>
    <div class="cleaner"></div>
  </div>
</div>
<div class="wrap">
  <div class="wrap-center aniview" av-animation="rotateInUpLeft">
    <h2>Наши партнеры</h2>
    <img src="/img/logo-lacoste.jpg" width="190" alt=""/>
    <img src="/img/logo-cisco.jpg" width="190" alt=""/>
    <img src="/img/logo-macrumors.jpg" width="190" alt=""/>
    <img src="/img/logo-peugeot.jpg" width="190" alt=""/>
    <img src="/img/unicorn.png" width="190" alt=""/>
  </div>
</div>
