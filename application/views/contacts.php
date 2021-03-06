<div class="wrap breadcrumb-wrap">
  <div class="wrap-center">
    <ul class="breadcrumb">
      <?php breadcrumb($breadcrumb); ?>
    </ul>
  </div>
</div>
<div class="wrap">
  <div class="wrap-center" id="feedback">
    <div class="contacts">
      <h2 class="header-small">Контакты</h2>
      <div class="contacts-block">
        <p><b>Адрес:</b><br>654000 г.Новокузнецк, пр.Запсибовцев, 39</p>
        <p><b>Телефон:</b><br>+7 (951) 226-25-96<br>+7 (951) 584-12-60<br>78-51-78<br>96-25-96</p>
        <p><b>Skype:</b><br><a href="skype:moteen84">moteen84</a></p>
        <?php /*<p><b>Email:</b><br><a href="arkadij.ok@gmail.com">arkadij.ok@gmail.com</a></p>*/?>
      </div>
      <div style="overflow: hidden; background: #ddd">
        <div style="overflow: hidden; float:left;">
          <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (начало) -->
          <div id="ymaps-map-id_136180719633749838048" style="width: 660px; height: 660px;"></div>
          <div style="display: none;"><a href="http://n.maps.yandex.ru" target="_blank" style="color: #1A3DC1; font: 13px Arial, Helvetica, sans-serif;">Создано с помощью сервиса Яндекса Народная карта.</a></div>
          <script type="text/javascript">function fid_136180719633749838048(ymaps) {var map = new ymaps.Map("ymaps-map-id_136180719633749838048", {center: [87.12682389814758, 53.898646190356686], zoom: 17, type: "yandex#publicMap"});map.controls.add("zoomControl").add("mapTools").add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));map.geoObjects.add(new ymaps.Placemark([87.123305, 53.750584], {balloonContent: "", iconContent: "15"}, {preset: "twirl#greenIcon"})).add(new ymaps.Placemark([87.126899, 53.898634], {balloonContent: "", iconContent: "39"}, {preset: "twirl#greenIcon"}));};</script>
          <script type="text/javascript" src="http://api-maps.yandex.ru/2.0-stable/?lang=ru-RU&coordorder=longlat&load=package.full&wizard=constructor&onload=fid_136180719633749838048"></script>
          <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) -->
        </div>
      </div>
    </div>
    <div class="callback">
      <h2 class="header-small">Обратная связь</h2>
      <p>Связаться с нами, вы можете по телефону или заполнив форму ниже.</p>

      <form method="post" id="callback-form" action="/contacts.html">
        <label for="name">Ваше имя:</label>
        <input name="name" type="text" required><br>
        <label for="email">Email:</label>
        <input name="email" type="text" required><br>
        <label for="number">Телефон:</label>
        <input name="number" type="text" required><br>
        <label for="topic">Тема письма:</label>
        <input name="topic" type="text" required><br>
        <label for="text">Сообщение:</label>
        <textarea name="text" required></textarea>
        <p class="warring">Все поля обязательны для заполнения!</p>
        <button class="button" name="add_feedback">Отправить</button>
      </form>
    </div>

    <div class="cleaner"></div>
  </div>
</div>