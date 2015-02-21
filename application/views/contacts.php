				<div class="col-2">
					<h2>Обратная связь</h2>
					<p>Связаться с нами, вы можете по телефону или заполнив форму ниже.</p>

					<form method="post" id="obr_sva">
						<label>Ваше имя:</label>
						<input class="obr_input" name="author" type="text" required><br>
						<label>Email:</label>
						<input class="obr_input" name="email" type="text" required><br>
						<label>Телефон:</label>
						<input class="obr_input" name="number" type="text" required><br>
						<label>Тема письма:</label>
						<input class="obr_input" name="theme" type="text" required><br>
						<label>Сообщение:</label>
						<textarea class="obr_input" name="text" required></textarea>
						<p style="font-size:10px; color:#727272; margin:0 0 15px 0; text-transform: uppercase;">Все поля обязательны для заполнения!</p>
						<input class="buttom" name="submit" type="submit" value="Отправить">
					</form>
				</div>
				
				<div class="col-2 end">
					<h2>Контакты</h2>
					<p><b>Адрес:</b><br>654000 г.Новокузнецк, пр.Запсибовцев, 39</p>
					<p><b>Телефон:</b><br>+7 (951) 226-25-96<br>+7 (951) 584-12-60<br>78-51-78<br>96-25-96</p>
					<p><b>Skype:</b><br><a href="skype:moteen84">moteen84</a></p>
					<?php /*<p><b>Email:</b><br><a href="arkadij.ok@gmail.com">arkadij.ok@gmail.com</a></p>*/?><br>
					<div style="overflow: hidden;">
						<div style="overflow: hidden; float:left;">
						<!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (начало) -->
						<div id="ymaps-map-id_136180719633749838048" style="width: 420px; height: 400px;"></div>
						<div style="display: none;"><a href="http://n.maps.yandex.ru" target="_blank" style="color: #1A3DC1; font: 13px Arial, Helvetica, sans-serif;">Создано с помощью сервиса Яндекса Народная карта.</a></div>
						<script type="text/javascript">function fid_136180719633749838048(ymaps) {var map = new ymaps.Map("ymaps-map-id_136180719633749838048", {center: [87.12682389814758, 53.898646190356686], zoom: 17, type: "yandex#publicMap"});map.controls.add("zoomControl").add("mapTools").add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));map.geoObjects.add(new ymaps.Placemark([87.123305, 53.750584], {balloonContent: "", iconContent: "15"}, {preset: "twirl#greenIcon"})).add(new ymaps.Placemark([87.126899, 53.898634], {balloonContent: "", iconContent: "39"}, {preset: "twirl#greenIcon"}));};</script>
						<script type="text/javascript" src="http://api-maps.yandex.ru/2.0-stable/?lang=ru-RU&coordorder=longlat&load=package.full&wizard=constructor&onload=fid_136180719633749838048"></script>
						<!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) -->
						</div>
					</div>
				</div>
				<div class="cleaner"></div>
				