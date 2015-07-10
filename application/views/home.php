<div class="wrap gray">
  <div class="wrap-center aniview" av-animation="slideInUp">
    <h2>Наши услуги</h2>
    <div class="big-circle-image">
      <img src="/img/cir.jpg" alt=""/>
    </div>
    <p>Компания «Новый интерьер» уже 10 лет занимается изготовлением мебели по индивидуальному проекту. В нашей компании вы можете заказать кухни, шкафы - купе, двери и <a href="/portfolio.html">другие проекты</a>.</p>

    <p>Вся мебель в нашей компании создается по дизайн-проектам наших специалистов и исключительно индивидуально для каждого гостя нашей компании.</p>

    <p>В современном мире очень важна мобильность, поэтому после того как вы оставите заявку на <a href="#" class="obr_sv pseudo">обратный звонок</a> вам перезвонят наши менеджеры и ответят на все интересующие Вас вопросы.</p>

    <p>Мы поможем выбрать из множества цветов и красок этого огромного мира, мы поможем создать
    в вашем доме Новый интерьер.</p>

    <p><a href="#" class="obr_sv pseudo">Закажите звонок</a> или <a href="/contacts.html#feedback">отправьте информацию</a> о проекте и тогда мы сможем сформировать цену которая подходит Вам.</p>
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
            <b>Качество</b><br>мебели
          </div>
        </div>
        <ul>
          <li>Новейшие разработки наших партнеров</li>
          <li>Первоклассные материалы и фурнитура</li>
          <li>Многообразие моделей и стилевых решений</li>
        </ul>
      </li>
      <li>
        <div class="header-about">
          <div class="image"><img src="http://livedemo00.template-help.com/wt_42974/images/icon-2.png" alt=""/></div>
          <div>
            <b>Экологичные</b><br>материалы
          </div>
        </div>
          <ul>
            <li>Безопасно для окружающей среды</li>
            <li>Комфорт и удобство для Вас</li>
            <li>Приоритет природным материалам</li>
          </ul>
      </li>
      <li>
        <div class="header-about">
          <div class="image"><img src="http://livedemo00.template-help.com/wt_42974/images/icon-3.png" alt=""/></div>
          <div>
            <b>Ценовая</b><br>политика
          </div>
        </div>
          <ul>
            <li>Подбор цен в пользу клиента</li>
            <li>Уменьшение себестоимости на всех этапах производства</li>
            <li>Беспроцентная рассрочка без банка</li>
          </ul>
      </li>
      <li>
        <div class="header-about">
          <div class="image"><img src="http://livedemo00.template-help.com/wt_42974/images/icon-4.png" alt=""/></div>
          <div>
            <b>Забота</b><br>о клиенте
          </div>
        </div>
          <ul>
            <li>Индивидуальный дизайн</li>
            <li>Бесплатный замер</li>
            <li>Консультации дизайнера</li>
            <li>Квалифицированные монтажники</li>
          </ul>
      </li>
    </ul>
  </div>
</div>

<div class="wrap pink wrap-portfolio-hidden">
  <div class="wrap-center aniview" av-animation="slideInLeft">
    <h2>Выполненные работы</h2>
    <div id="portfolio-container">
      <?php foreach ($portfolio as $product) : ?>
      <article class="wrap-product">
          <a href="/portfolio<?=$product->link ? '/category/'.$product->link : ''?>.html?id_product=<?=$product->id?>">
            <img src="/img/portfolio/small/<?=$product->img?>" alt=""><span><?=$product->title?></span>
          </a>
      </article>
      <?php endforeach; ?>
    </div>
    <div class="cleaner"></div>
  </div>
  <div class="warp_view-all-portfolio">
    <a class="aniview view-all-portfolio" av-animation="slideInUp" href="/portfolio.html">
      Посмотреть все работы<br>
      <i class="flaticon-chevron8"></i>
    </a>
  </div>
</div>
<div class="wrap">
  <div class="wrap-center aniview" av-animation="rotateInUpLeft">
    <h2>Наши партнеры</h2>
    <div class="partners">
      <img src="/img/partners/blum.png" alt="Blum" title="Blum"/>
      <img src="/img/partners/boyard.png" alt="Boyard" title="Boyard"/>
      <img src="/img/partners/egger.png" alt="Egger" title="Egger"/>
      <img src="/img/partners/hellitech.png" alt="Hellitech" title="Hellitech"/>
      <img src="/img/partners/zevs.png" alt="Zevs" title="Zevs"/>
    </div>
  </div>
</div>
