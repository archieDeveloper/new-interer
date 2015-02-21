-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 27 2014 г., 15:42
-- Версия сервера: 5.5.38-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `newinterer-db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auctions`
--

CREATE TABLE IF NOT EXISTS `auctions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `descriptions` varchar(255) NOT NULL,
  `design` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `last_time` int(5) NOT NULL,
  `rate` int(10) NOT NULL,
  `id_user_rate` int(10) NOT NULL,
  `start_price` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `auctions`
--

INSERT INTO `auctions` (`id`, `title`, `descriptions`, `design`, `img`, `date_time`, `last_time`, `rate`, `id_user_rate`, `start_price`) VALUES
(1, 'Кухня в берюзовых тонах по спец. заказу', 'Описание кухни будет расположенно тут, можно будет его прочесть и всё вот так вот. Описание кухни будет расположенно тут, можно будет его прочесть и всё вот так вот. ', 'Челове-Паук', '', '2014-02-21 22:50:58', 72, 134140, 10, 15000),
(2, 'Дизайнерские печеньки', 'Дизайнерские печеньки - это лучшее что можно купить в этом мире, разве Вы могли подумать что печеньки могут быть так прекрастны', 'Мистер Разработчик', '', '2014-02-22 21:35:12', 72, 2147483647, 10, 300000);

-- --------------------------------------------------------

--
-- Структура таблицы `category_portfolio`
--

CREATE TABLE IF NOT EXISTS `category_portfolio` (
  `link` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` int(2) NOT NULL,
  PRIMARY KEY (`link`),
  UNIQUE KEY `link` (`link`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_portfolio`
--

INSERT INTO `category_portfolio` (`link`, `name`, `position`) VALUES
('arch', 'Арки', 0),
('children', 'Детские', 0),
('doors', 'Двери', 0),
('hallways', 'Прихожие', 0),
('kitchens', 'Кухни', 0),
('no-category', 'Без категории', 7),
('wardrobes', 'Шкафы-купе', 0),
('window', 'Окна', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `ip_address` varchar(45) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `user_agent` varchar(120) CHARACTER SET latin1 NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('084a71598f58727fee9e2626c66b1b17', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1413531820, ''),
('17ed0a304d1ccbbea6142818d2279ab0', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1414399322, ''),
('d241ed69127f3ca3a294134ab75f48f9', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1414399322, '');

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(5) NOT NULL AUTO_INCREMENT,
  `group_id` int(5) NOT NULL,
  `contact` varchar(255) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`contact_id`, `group_id`, `contact`) VALUES
(1, 1, '654000 г.Новокузнецк, пр.Запсибовцев, 39'),
(2, 2, '+7 (951) 226-25-96'),
(3, 2, '+7 (951) 584-12-60'),
(4, 2, '78-51-78'),
(5, 2, '96-25-96'),
(6, 3, 'moteen84'),
(7, 4, 'arkadij.ok@gmail.com'),
(8, 1, 'ttrr');

-- --------------------------------------------------------

--
-- Структура таблицы `contact_groups`
--

CREATE TABLE IF NOT EXISTS `contact_groups` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `contact_groups`
--

INSERT INTO `contact_groups` (`id`, `name`) VALUES
(1, 'Адрес'),
(2, 'Телефон'),
(3, 'Skype'),
(4, 'Email');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `start_time` int(3) NOT NULL,
  `end_time` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `number`, `address`, `start_time`, `end_time`) VALUES
(41, 'Кожедуб Аркадий', ' 7 913 315 58 59', 'Кутузова 48 39', 12, 13),
(42, 'проверяю на работу еще раз', ' 7 913 315 5859', 'Кутузова 48 39', 10, 11),
(43, 'проверка', 'проверка', 'проверка', 10, 11),
(44, 'проверка', 'проверка', 'проверка', 10, 11),
(45, 'Арываыва', 'ываывпв', 'ывапвыап', 10, 11),
(46, 'вапывап', 'выапвап', 'ывапвыап', 10, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `trash` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `date`, `trash`) VALUES
(1, '"Новый интерьер"', 'Теперь у компании "Новый интерьер" есть свой сайт.', '2013-01-30', 0),
(6, 'У нас Вы найдете то что вам нужно!', 'Приходите к нам!!!\nОгромный выбор кухонь, шкафов-купе, детских, корпусной мебели, также в продаже Двери.\nУ нас вы найдете качество!\n\nКачественная продукция произведенная по самым современным технологиям, дорогие материалы, которые очень хорошо выглядят и долго не портятся.', '2013-07-20', 0),
(39, 'Как отчистить организм?', '\nСпособ 1.\n\nВам нужно приучить себя кушать один раз в неделю утром натощак пучок зелени (листья чеснока, салат, лук, сельдерей, укроп, петрушка). При этом постарайтесь не есть хлеб и соль. Если какого-то ингредиента нет, то не беда. Ключевым звеном в очищении является петрушка. Спустя полчаса можно приступать к другому этапу очищения - ешьте, не запивая свежие ягоды, фрукты или овощи.', '2014-05-05', 0),
(40, 'Новая статья', 'ывап ывап ывап ывалпоывлапорыраоптывало птывалпо ывапло ывалпотиывмлот выалоп ывап ылвапр ылваоти выа.<br>\neuioeuioeuieouioeuio eui doteuitoeduitoedidho.prheui nhodeuti doeuthihoeuit oeuithoe d<br><br>oaeuaoeuaoheudaohteud aoeudthaoeduathoediuhaoediuahoeiuhaoeu<br><!--more-->\ntoehunotheuna toenu haoneuth asotneuh saoethua otudeuhi euiat eudi taoeudan<br>oeuioehutiodehtiu doehuidoehuid toehuito', '2014-10-17', 1),
(41, 'euieo', 'oeuieoi', '2014-10-17', 1),
(42, 'uuuu', 'uuuu', '2014-10-17', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_link` varchar(100) CHARACTER SET utf8 NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(2) CHARACTER SET utf8 NOT NULL,
  `trash` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=697 ;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id`, `category_link`, `img`, `title`, `type`, `trash`) VALUES
(150, 'wardrobes', '77661885.jpg', 'Шкаф-купе', '0', 0),
(151, 'wardrobes', 'd0ad9273.jpg', 'Шкаф', '0', 0),
(153, 'wardrobes', '40ce253b.jpg', 'Шкаф', '0', 0),
(154, 'wardrobes', '3d41b97e.jpg', 'Стенка', '0', 0),
(155, 'wardrobes', '9f68e3f9.jpg', 'Стенка', '0', 0),
(156, 'wardrobes', 'bd7e4c05.jpg', '', '0', 0),
(157, 'wardrobes', '24a52eec.jpg', '', '0', 0),
(158, 'wardrobes', '8b1303c5.jpg', '', '0', 0),
(159, 'wardrobes', '3d4a35af.jpg', '', '0', 0),
(160, 'wardrobes', '470455ed.jpg', '', '0', 0),
(161, 'wardrobes', '9b178052.jpg', '', '0', 0),
(179, 'kitchens', '9682cd28.jpg', 'Кухня', '1', 0),
(164, 'kitchens', 'f3da5ef6.jpg', '', '1', 0),
(180, 'wardrobes', '28f0b43c.jpg', 'Прихожая', '2', 0),
(167, 'kitchens', 'a645f604.jpg', '', '1', 0),
(168, 'kitchens', '46104231.jpg', '', '1', 0),
(169, 'kitchens', '6940e14e.jpg', '', '1', 0),
(171, 'kitchens', '0e2e631a.jpg', '', '1', 0),
(172, 'kitchens', '36df216f.jpg', '', '1', 0),
(173, 'kitchens', '4268a8f8.jpg', '', '1', 0),
(174, 'kitchens', 'd05a64f7.jpg', '', '1', 0),
(176, 'kitchens', '74d13efb.jpg', '', '1', 0),
(177, 'kitchens', 'cce56f27.jpg', 'Кухня на ильинке', '1', 0),
(178, 'kitchens', '82b87152.jpg', 'Кухня на Бардина', '1', 0),
(181, 'wardrobes', '2ec181c8.jpg', 'Прихожая', '2', 0),
(182, 'kitchens', 'b74bc77b.jpg', 'Необычная идея дя хозяйки', '2', 0),
(183, 'wardrobes', '9c995b1a.jpg', 'Шкаф-купе', '2', 0),
(189, 'children', '4601ed8c.jpg', 'Натяжной потолок', '3', 0),
(186, 'wardrobes', '9ac20031.jpg', 'Шкаф на Запсибе', '2', 0),
(187, 'wardrobes', '438961fb.jpg', 'Прихожая-шкаф', '2', 0),
(188, 'wardrobes', 'b84f1c17.jpg', 'Шкаф-купе на ильинке', '2', 0),
(190, 'children', '6d0a90bb.jpg', '', '3', 0),
(197, 'wardrobes', 'a12b0420.jpg', 'Детский шкаф', '3', 0),
(192, 'children', '6a8a52f1.jpg', 'Детская комната', '3', 0),
(205, 'window', '5893e02d.png', 'Окна', '4', 0),
(206, 'wardrobes', '43b73027.jpg', 'Азиатские мотивы', '0', 0),
(203, 'window', '6d4c20a5.jpg', 'Rehau "Окна"', '4', 0),
(207, 'wardrobes', 'b65afe5a.jpg', '', '0', 0),
(208, 'kitchens', 'ce953472.jpg', '"Облачная мечта"', '1', 0),
(391, 'kitchens', 'ff919cd9296c4a778575ddb5a5eff5b2.png', 'Полосочки', '', 1),
(392, '', 'a05736d45d812494cb3699e9fdfe3304.png', '', '', 1),
(393, '', '105b41437f2647ca7bf04c7279ee5737.png', '', '', 1),
(394, '', 'f1137ed638c9ce2e71b07798cba2502d.png', '', '', 1),
(395, '', 'e98d92e2d4b1e6fd2313efdf9e4fe5f1.png', '', '', 1),
(396, '', '69d712c2e40048da49c3abcb444c7647.png', '', '', 1),
(455, '', '1888e664ea7930267475933982547d6c.png', '', '', 1),
(453, '', '6950a734a4cdfe52fe58190f8288b35c.png', '', '', 1),
(454, '', '82bd38c9dfee5a58f990af5b19359ec9.png', '', '', 1),
(452, '', '262e810a8bccef8e28616f55a74c9c1f.png', '', '', 1),
(451, '', '7bfbb87129f4afc5167f4c72caedbdde.png', '', '', 1),
(450, 'kitchens', 'd7a1edec54da80f507d510ccd5345122.png', '', '', 1),
(449, '', '40da0b21747b3c0b609fa2cfa96cd6ef.png', '', '', 1),
(448, '', '02a422fa57fe4d7935f34b1ca5744dd9.png', '', '', 1),
(447, 'kitchens', '74db0389edcd4d3190db8bfe17a30622.png', 'есть заголовок - это кухня', '', 1),
(446, 'hallways', 'e380f93d97d5820bdffc6fdb6d0b0450.png', '', '', 1),
(445, 'kitchens', '1bde099491a472c6c1ac887ac6759052.png', '', '', 1),
(444, 'kitchens', '7a6cf9a2ae86874fbe2b17a1dae0b09c.png', '', '', 1),
(438, '', '73edfc85b5430258af429417e774712f.png', '', '', 1),
(437, '', 'd48c075e4c4f074dcdf6a779ec7567c8.png', '', '', 1),
(436, '', 'c92fcdd65429b53e8e5762e4e8771ffa.png', '', '', 1),
(439, '', 'b8398ba3f95c3fd9984d17d67b9e8b55.png', '', '', 1),
(440, '', 'fc69cdb15ab2c46d6579c473d1627789.png', '', '', 1),
(441, '', 'fc679e2b40e430e0c361131f040dd3a8.png', '', '', 1),
(442, '', '98524218537c30620492283dfd33c9e9.png', '', '', 1),
(443, '', '4793da294f5c44d33069a7f79c6cccc1.png', '', '', 1),
(435, '', 'b851ed294a4df9440488d5ce0528b79f.png', '', '', 1),
(434, '', '3d65d93bd03f730744948df31b883ce7.png', '', '', 1),
(433, '', '5ef2626b0472475e1d2f7991a3d8ce0c.png', '', '', 1),
(432, '', '932ebd453a7d161e505f7ffe6f310d65.png', '', '', 1),
(431, '', '41e8725bd35d4ff7a36d1bfbf4c31a69.png', '', '', 1),
(430, '', '51582218042c231a1175cfe243ea11da.png', '', '', 1),
(429, '', '1d2afb2e9fe29c85d94f5f9a23cf1761.png', '', '', 1),
(428, '', 'ecdab6bb13c9bae8f1b5111749b616df.png', '', '', 1),
(427, '', 'f6f5bca8f6e1a9ccaae99732f950805d.png', '', '', 1),
(426, '', 'b0c125e568dd6ef13ae7a5343f1095d2.png', '', '', 1),
(425, '', '91edffa1041e5dfbfa188fc4bc488756.png', '', '', 1),
(424, '', '15de924ff031c81f687f494989ca6373.png', '', '', 1),
(423, '', '3f2cea76969a74c192a36e3d9bb1263a.png', '', '', 1),
(422, '', '3930dcb08964143d0cc6c6320f8e0b29.png', '', '', 1),
(421, '', 'f333c570d13f8caeca76dd54eb5ee566.png', '', '', 1),
(420, '', 'b8ef09c1495e3ec2fa023c0529acbfcb.png', '', '', 1),
(419, '', '7a5cab7ad6e69a6c462de8ee59f1c344.png', '', '', 1),
(418, '', '21cb2353280e9f322d5a19c7b55e8b31.png', '', '', 1),
(417, '', '14f437f2fc24f86a4d8db0e29bf7fc4d.png', '', '', 1),
(416, '', 'b49d772a8e6159b096f0e38c4f6e3ad4.png', '', '', 1),
(415, '', '3a73727c80792cc16a73e9d87dd6de49.png', '', '', 1),
(414, '', '5cc70b056ccc92515a50e9d641d71e34.png', '', '', 1),
(413, '', '96eadf703934f4a29fa20128e3ea2f90.png', '', '', 1),
(412, '', 'fc07577ac7134fb90ff0ab5eb4bf29e2.png', '', '', 1),
(411, '', '57df4b453b8847076352bef04f0fd4e2.png', '', '', 1),
(390, 'kitchens', '4739fa7446169e6110ca2c7dd69dbf3d.png', '', '', 1),
(397, '', 'ffedf02e1f625c7f5cfdd27bf5e7529a.png', '', '', 1),
(398, '', '8acafc5e5059a3385490ec192075c56f.png', '', '', 1),
(399, '', '7304d67ccc61697aa85356d69065b10f.png', '', '', 1),
(400, '', '0d437e41eaca7e78c41e393a0386e7e7.png', '', '', 1),
(401, '', 'e36efcc688f77dc1e301e8c55907f6eb.png', '', '', 1),
(402, '', '4e071c7aea44f10ff6fed70ae0dd7d92.png', '', '', 1),
(403, '', '4612b409187497fcf12db93637eeb5a5.png', '', '', 1),
(404, '', '364b252121ef28f86a03d7be1e8d85e4.png', '', '', 1),
(405, '', '7dc0f64f3331893e3c20f5efeabae83f.png', '', '', 1),
(406, '', '25b9cb09e6a7cccb42b2810fb8e87f04.png', '', '', 1),
(407, '', 'b0c87b83a20ae53ab707ef7253e778a9.png', '', '', 1),
(408, '', '1843eed4f19f8d3631e364baeb80831e.png', '', '', 1),
(409, '', 'c739ee13898e09e069b595af4af01c15.png', '', '', 1),
(410, '', '35548c58b3aebcd4a573a9af14259977.png', '', '', 1),
(456, 'kitchens', '17b0cba05d9a2ea19d51c4cff9f200e1.png', ';,.', '', 1),
(457, '', '419c66e60b6214d271c5bbd02f8d66cc.png', '', '', 1),
(458, 'wardrobes', '5b64efcd676ac8374b658ce594599308.png', 'tut', '', 1),
(459, '', '2f674eb4b73780758636998c5682f8b4.png', '', '', 1),
(460, '', 'a3d482ef27636a8709d22f3aecaed83f.png', '', '', 1),
(461, '', '7608417c644392f272f5380e1f2d9871.png', '', '', 1),
(462, '', '2c6058f50ab9b9f2f549dffb03db8f51.png', '', '', 1),
(463, '', 'ed6e8fac4a36797bea0f0eaef5866de9.png', '', '', 1),
(464, '', 'fe1a9eb431690cf8826352a9d7b7fa42.png', '', '', 1),
(465, '', 'cf551f6234b0273153b2a0e757296bb0.png', '', '', 1),
(466, '', 'e7104bfbf131a9b861a16f2397bc8bc9.png', '', '', 1),
(467, '', 'a0d87d6933b3dd08d3a1acfd3cd1004c.png', '', '', 1),
(468, '', 'c9fa2942042b565663361980e6a6b257.png', '', '', 1),
(469, 'kitchens', '3803b3feeb81a7ec26f60b366a859fc7.png', 'стрелки', '', 1),
(470, '', 'd482285425ec523df29f1066cf55c469.png', '', '', 1),
(471, '', '8bdecded8e9057a6b58e2afe232d379b.png', '', '', 1),
(472, '', 'e969ba4147c69a448aed71d560de51be.png', '', '', 1),
(473, '', 'b11c655303f0b6c0c3017918fbec40c6.png', '', '', 1),
(474, '', 'd937b39d2e764117fc2c19ca74129f30.png', '', '', 1),
(475, '', '239e9e76ac839170141ed6c6f2df40b7.png', '', '', 1),
(476, '', '991e3e33d298d0c0813e36f1c81a9800.png', '', '', 1),
(477, '', '3efad9f52afa9dc3afb91a2f4e64e62a.png', '', '', 1),
(478, '', '5b50a9a3b05a71ed9b091b23ab72a82a.png', '', '', 1),
(479, '', '6a7239c2310583b648e740842619b064.png', '', '', 1),
(480, '', 'fc7da38d3fd362fa23ab87ccbf17083e.png', '', '', 1),
(481, '', '3398a220f0150ad9a98731997a60e045.png', '', '', 1),
(482, '', '2ba2fd9efc30e767ccdc03f1cb7144a6.png', '', '', 1),
(483, '', '0869d50bcb9632508bc399c6cab182a0.png', '', '', 1),
(484, '', '0e914348815e2e21bbdc096f268a5bb5.png', '', '', 1),
(485, '', 'b445435368b8dcb80cc1ce29dafb56b3.png', '', '', 1),
(486, '', 'c5d90d8ac06ccc33d5cb84e29b1c7d33.png', '', '', 1),
(487, '', '0f796666448d07967c4b6bf50807c1b8.png', '', '', 1),
(488, '', '2486b675364335bae8174c51417c1281.png', '', '', 1),
(489, '', '6c91c7686f004af8115d412e09b00206.png', '', '', 1),
(490, '', '2ae490068e72eb85a7abb726cf581a8a.png', '', '', 1),
(491, '', '94b850a56c8229bd1b5c4ec03e3a0c57.png', '', '', 1),
(492, '', '45d1375ddb456f2d52546a14b807e244.png', '', '', 1),
(493, '', 'eee3ce407c9ed1df5ce5a9b9dba1be4d.png', '', '', 1),
(494, '', 'f634ffddbf8fdb4f4e278e227be5b339.png', '', '', 1),
(495, '', 'b97bcaffcf8588ea47f14617f1e36915.png', '', '', 1),
(496, '', 'aa7f1073de5bae57949c003ba093d422.png', '', '', 1),
(497, '', '92577606765be527daf449a7d98243e8.png', '', '', 1),
(498, '', 'd60ba58b6935c5b5863e865c2c5224d7.png', '', '', 1),
(499, '', '18bd4359b7f37f2473a53cf2441876ba.png', '', '', 1),
(500, '', 'c4138a90bc8acd5959cc9b158f0cf018.png', '', '', 1),
(501, '', 'c18d52fa04ab011cb102eafa098cd519.png', '', '', 1),
(502, '', '3094e5bf09cea7f3495fc283b88e8d5a.png', '', '', 1),
(503, '', '588babd77f5b5b1ee2c925ecc5c2de74.png', '', '', 1),
(504, '', 'b95ea4e97704f5a96caff457c603a860.png', '', '', 1),
(505, '', '302363648522b3e491e734c08b2392a8.png', '', '', 1),
(506, '', 'e068bd05136da4a6545a938c64103001.png', '', '', 1),
(507, '', '0c96884409814907ceb58ab1bc578597.png', '', '', 1),
(508, '', 'c2da77c72f3841572aa35b6b8415e85a.png', '', '', 1),
(509, '', 'eddc2ca830edfd7728e79fd54f4fdd74.png', '', '', 1),
(510, '', 'fd00ef45584f1d8bdd6d4969380ee6e1.png', '', '', 1),
(511, '', '2aca0a596e1f812656be2f7609ccc774.png', '', '', 1),
(512, '', '14f89e4b0664055d6745ce0bafbee4b6.png', '', '', 1),
(513, '', 'b29a7cd1679e597d35a980ba68d2b2be.png', '', '', 1),
(514, '', 'e8aa8c6d298b8c4fd54186e4e5ff4b54.png', '', '', 1),
(515, '', '577f9dd65b680691e90a8100fdec8e0b.png', '', '', 1),
(516, '', '51ee77322cb44200e736fc17a2d647fd.png', '', '', 1),
(517, '', '97db78378a398d6101da5216fd942a14.png', '', '', 1),
(518, '', '9963f07e26389446e8a64022bd2ef061.png', '', '', 1),
(519, '', 'b5be3b1ad1b677a2aeecacae244ed093.png', '', '', 1),
(520, '', '7dbc2d987cc5c7531a61aa65917e3ed6.png', '', '', 1),
(521, '', '73f209ddc3f37255ed6dad07b8f52db7.png', '', '', 1),
(522, '', '81b144712d0f0c264567aed50fb264ad.png', '', '', 1),
(523, '', 'c314302e058e7fdaab268f1a0accc680.png', '', '', 1),
(524, '', 'f425f74a29b52025ec9d02fa8d569363.png', '', '', 1),
(525, '', '609a15a2f6bb63f8917c085e6b543d6c.png', '', '', 1),
(526, '', 'd12b07a2ca6d3dcfa54b7b4d01380e21.png', '', '', 1),
(527, '', 'c88118282941ca8f545a7f61707faec5.png', '', '', 1),
(528, '', '8beafa053e3411fe316ced1d43a95ccb.png', '', '', 1),
(529, '', '9eb15a9b584ae2aebb6fb1c078382fee.png', '', '', 1),
(530, '', '269f67884280fb1873e439a512919a56.png', '', '', 1),
(531, '', '33d403eda663af2f7b765ddc3abb3cf1.png', '', '', 1),
(532, '', 'a3493283feb29b80c6f0fb295f0b45d1.png', '', '', 1),
(533, '', '03ff42e5727bffb44985321249ec0713.png', '', '', 1),
(534, '', 'b6bbb945badf9aa5dd37ed8c7111eed6.png', '', '', 1),
(535, '', '5d8f5b0129be5cc0f7545a358fb433ee.png', '', '', 1),
(536, '', '34177b50e88352a284094555e6e2fb74.png', '', '', 1),
(537, '', 'a9b50b66bf72268cdab8aaff735866d7.png', '', '', 1),
(538, '', '69a2a851a496dfa1e0c85c8f0acaec50.png', '', '', 1),
(539, '', '781ec552d0e0166235faa88124dbed9a.png', '', '', 1),
(540, '', '959897c8f81ab80b7066db619c52399b.png', '', '', 1),
(541, '', '10c1bf260e8be387bfa3b45e38cd710f.png', '', '', 1),
(542, '', 'e9efa755f80ccd9945040307ce0446bd.png', '', '', 1),
(543, '', 'ae91fd71ae57e4681edc544dfacb640d.png', '', '', 1),
(544, '', 'aef74898c600a50042562d137183a256.png', '', '', 1),
(545, '', 'a02f99401aa3e703edf2fdb36bde94dd.png', '', '', 1),
(546, '', 'c293d2a2a48102ace4cc2958f3f5d40c.png', '', '', 1),
(547, '', '9ffb19b8b84bdfe6ffc447637cfa1baf.png', '', '', 1),
(548, '', 'ba29e88600819216692293364229c76b.png', '', '', 1),
(549, '', 'f6be13aded31d35f28d9ce1979fb5698.png', '', '', 1),
(550, '', 'e0c2a1bb1166f9532b7ee5c78f8e5967.png', '', '', 1),
(551, '', '2186982b262006bcf115087bf83ac49e.png', '', '', 1),
(552, '', '4036ea66b2e4ed38635d2be71d429b8d.png', '', '', 1),
(553, '', '9f0e8979e3986ee3639a49a22ddcdec0.png', '', '', 1),
(554, '', '44221fa6e0115d3fa830c824308539e8.png', '', '', 1),
(555, '', '41c8e84f0e10dc257767ea50c1a6c270.png', '', '', 1),
(556, '', 'c614eb30070eb83456a587c8de777b35.png', '', '', 1),
(557, '', '66b98db9197e33b0452fb9a9b715ca2b.png', '', '', 1),
(558, '', 'd18504dedf4d6c14e5dfae4209ec81fe.png', '', '', 1),
(559, '', 'c62d34c6533b6bc28e34345e62d994c0.png', '', '', 1),
(560, '', '5f98b1244cc5dfc4b2cd9ba318fe71c9.png', '', '', 1),
(561, '', '306deeb1e486ac00ca462318d922bc7e.png', '', '', 1),
(562, '', '7038e8c598c961431833e21769743736.png', '', '', 1),
(563, '', 'f5279eebbf942c5436c91f6a8838d894.png', '', '', 1),
(564, '', '7930f8e476d969b32edc983917507e51.png', '', '', 1),
(565, '', 'e77f50213052a0791cb83bcf138ff2cb.png', '', '', 1),
(566, '', '19cdb13ce828e0ed116953a31aa63a82.png', '', '', 1),
(567, '', '1aad11bd6295d1b50244f4e1477d66fd.png', '', '', 1),
(568, '', '56d775de2e71cde8a48333ac0a281bb2.png', '', '', 1),
(569, '', 'aedf6039989a41de19b00c1cb000272b.png', '', '', 1),
(570, '', 'ca886661c1990b9255347a2394a58987.png', '', '', 1),
(571, '', 'ad281ac67b127063982ffcc349bee98d.png', '', '', 1),
(572, '', 'e006576a7ecab42f2fbd5263501e9d59.png', '', '', 1),
(573, '', '8388d528875c314eef396f3a399c9ae4.png', '', '', 1),
(574, '', 'a27e8a6e795641b2d4a74d1425257088.png', '', '', 1),
(575, '', 'e4bda8ed758944e6ec6486b8c6d0f2a5.png', '', '', 1),
(576, '', '84b8cdb9f24808dc5c95cb80fd2801ca.png', '', '', 1),
(577, '', '8e6dff02da42e8f1ffa05430bcca11ef.png', '', '', 1),
(578, '', 'c7db8ee07b01ca8243c8ea7250bc2421.png', '', '', 1),
(579, '', '651987d3ac522e656348b5e224c0da7c.png', '', '', 1),
(580, '', 'dcc45014df41f64cc9869032f9502adb.png', '', '', 1),
(581, '', '5feb594a5f95a9dd9e738004ccc5ca5c.png', '', '', 1),
(582, '', 'a1d777be561c90b4fecbb3a2625ead70.png', '', '', 1),
(583, '', 'e171571470204540b6847acacbdbb7a6.png', '', '', 1),
(584, '', 'e05a64979f2c0ac906dbcdc26fb7cf40.png', '', '', 1),
(585, '', '46735c575bf6b9f11787f306275fc010.png', '', '', 1),
(586, '', '619715070b3cf90bea67c3a15e282f8f.png', '', '', 1),
(587, '', '35aee4a6f61061eb48f6f2e4f8ba9f9e.png', '', '', 1),
(588, '', 'abf8e163a29129617bedba0cb2a65288.png', '', '', 1),
(589, '', 'fab2910ba4188b13a6f46782f74f80d8.png', '', '', 1),
(590, '', 'c2d876d4f484d8072754edaea7b7da87.png', '', '', 1),
(591, '', '5fb527e2940cfa19554b558178d25b47.png', '', '', 1),
(592, '', '3cd55da6f2b622e124437878bc0740cc.png', '', '', 1),
(593, '', '1cc87f76b03e06e28a8fa019e63abf47.png', '', '', 1),
(594, '', '4aacb9418d34bd81a901d04cacc23f10.png', '', '', 1),
(595, '', '9753c6333bd58f31aba21dc68af600de.png', '', '', 1),
(596, '', '953f751cee9786b63681ed917d623b77.png', '', '', 1),
(597, '', '392f0914de144c820b6649ed9b71f171.png', '', '', 1),
(598, '', 'f6e5e51937b4ea3fb742733ac627d0ce.png', '', '', 1),
(599, '', 'f35a22665863c5944188e1186fcbc1ab.png', '', '', 1),
(600, '', '8b3a7e9996710bb24bf0e77818e9acb9.png', '', '', 1),
(601, '', 'ef59992b60ccc309efaf1c5f8df5389f.png', '', '', 1),
(602, '', 'd1b619bcb65c7349471b8623a7d4cfdd.png', '', '', 1),
(603, '', '566509c53948046087b5362f65d6f493.png', '', '', 1),
(604, '', 'ecc3399a4d3df30a8f91788b81141647.png', '', '', 1),
(605, '', '21f4477d98b581727c1987664250e208.png', '', '', 1),
(606, '', '06e6f22197467f7d2af30d8dfd37e552.png', '', '', 1),
(607, '', '577e7261c48e2e116f10b44e3ee8541a.png', '', '', 1),
(608, '', 'f4a5986e2154f33522f748047f8c9cf3.png', '', '', 1),
(609, '', '5a10e0e531c94f80563a01fa2e307745.png', '', '', 1),
(610, '', '6d86db0a445ad3e0734db05651433978.png', '', '', 1),
(611, '', '526efd3efc483dcd5317cc1c993d3809.png', '', '', 1),
(612, '', 'c900f36fa5d92361dde5cc067a006311.png', '', '', 1),
(613, '', 'e5567377f5945c83119b4f711f8ec67d.png', '', '', 1),
(614, '', '27ed1d84a9bb638d85b1aa88be42cea4.png', '', '', 1),
(615, '', '2f89b5a4af493a60b6c388a948a0587f.png', '', '', 1),
(616, '', '609135da509576bf4babb4b46c8f2fe8.png', '', '', 1),
(617, '', '19da725843c5b88feee9b39aaa59ed6e.png', '', '', 1),
(618, '', 'e38222916cc5f809ca57d4eef7a684e4.png', '', '', 1),
(619, '', '2236181595d7bec4c88cc5f7fba72f65.png', '', '', 1),
(620, '', '81f33d37f3901731fa05c6dd33caefe2.png', '', '', 1),
(621, '', '96cc85a372a634c5d4823020620cd0a7.png', '', '', 1),
(622, '', 'c6f0aa66258aee3a18cab8f74ea8bf53.png', '', '', 1),
(623, '', 'bf9e6e6ec4ec658e5b68d37dfba840f5.png', '', '', 1),
(624, '', '137966022cde39d40e4ded69489a0a1b.png', '', '', 1),
(625, '', '7ef0356167298baf31861dcb260debb3.png', '', '', 1),
(626, '', '9bb4878fcc9153f1c2344600ae68c3d9.png', '', '', 1),
(627, '', '1db622c6dfc4f4588007f7e78f8d1e56.png', '', '', 1),
(628, '', '93429fbf53834786c789f77008d31776.png', '', '', 1),
(629, 'no-category', '56c40f10b370c49e6b8c9b1e8d9234ca.png', '', '', 1),
(630, 'no-category', 'a3e88ee042054d97a7d0ce141351f836.png', '', '', 1),
(631, 'no-category', 'ace231737d0aa9c8fd3eca9603fe4288.png', '', '', 1),
(632, 'no-category', '68a98be3fc15e517b514e2928d882158.png', '', '', 1),
(633, 'no-category', '8dc73a6fecc7954bd9a8934db21aa296.png', '', '', 1),
(634, 'no-category', '50a9d32173db27bbbcaf74753c651b92.png', '', '', 1),
(635, 'no-category', 'c6232582efa81421052ee450428b5f18.png', '', '', 1),
(636, 'no-category', 'ccd5022df17a9892f56bd922d0d2a749.png', '', '', 1),
(637, 'no-category', '7de2f87c0d119b31777e53dce294fbe3.png', '', '', 1),
(638, 'no-category', 'f6aaa39cfbcc55fb06bef2ceb1c00da4.png', '', '', 1),
(639, 'no-category', '6fc800b2cebc765850ddada65b8a019d.png', '', '', 1),
(640, 'no-category', '1fcbb8ea37f7347dc3cfa423b535d82b.png', '', '', 1),
(641, 'no-category', '1a99d5f0bdfa1484c81abad55bc12ee6.png', '', '', 1),
(642, 'no-category', '7e3d3bde17d6fbb5fa2e3e5d2d50db18.png', '', '', 1),
(643, 'kitchens', '8ed3bfc2b7a0b56f86af34035abbedc9.png', 'Облачко', '', 1),
(644, 'kitchens', 'd523411ef5f68cfaccac0b029b41333c.png', 'Кухня', '', 1),
(645, 'no-category', 'feda63f584c5a3edd538c7fab62b2fd1.png', '', '', 1),
(646, 'no-category', 'f7c118d08f4197371a7885797017a4d1.png', '', '', 1),
(647, 'no-category', 'fce09eb21161f9ebbedd13b4c101c2fa.png', '', '', 1),
(648, 'no-category', 'df269b04befd859ec0d3393839aafa07.png', '', '', 1),
(649, 'no-category', 'b30fecb773cddff03b1d31d68b7b80ff.png', '', '', 1),
(650, 'no-category', 'c56ea78de390b7f8f1c6e0b9e75f562c.png', '', '', 1),
(651, 'no-category', '884d78543315b4cae8b0e6acc619b3a7.jpg', '', '', 1),
(652, 'no-category', 'acb143737d2310bc3e94b7c5bbdf49f8.jpg', '', '', 1),
(653, 'no-category', '4f6a13a67e1ef67c9bb6018e17bb4052.jpg', '', '', 1),
(654, 'no-category', 'dec18a1178355218ae0611196bcc6b57.jpg', '', '', 1),
(655, 'no-category', '512351c3e59d2ccb0d6dedbe8a22f97d.png', '', '', 1),
(656, 'no-category', '8a12a273d7427da427a9a66aaad5a571.jpg', '', '', 1),
(657, 'no-category', '25db8f89684faebe2177f2ae44f03f32.jpg', '', '', 1),
(658, 'no-category', 'c12ab6b66d56efca8512e7e7aea2b084.png', '', '', 1),
(659, 'no-category', '9ddf19b24ceb70bfee8fa9dcac365a34.png', '', '', 1),
(660, 'no-category', 'dc0738b711573ca1d11ee0df832b7ec3.png', '', '', 1),
(661, 'no-category', 'ac0449331446a1be433f9b27c624b5eb.png', '', '', 1),
(662, 'no-category', '68827e186b7118560c17850894c4c81d.png', '', '', 1),
(663, 'no-category', 'b05724eb668981e613a7316ce380e222.png', '', '', 1),
(664, 'no-category', '3106464a4073c6d19f309b36fd325692.png', '', '', 1),
(665, 'no-category', '36b2ba9e42d0cc04ca82b13b15400e13.png', '', '', 1),
(666, 'no-category', '01bed56d47c8bcd9d0a7049df69ee464.png', '', '', 1),
(667, 'no-category', '7b8070db30eb87988c00104479c6b74a.png', '', '', 1),
(668, 'no-category', '50e6a564c250244ef534fac6af5a3f2d.png', '', '', 1),
(669, 'no-category', '56273a08986ec781545e6a11e57ecad4.jpg', '', '', 1),
(670, 'no-category', 'c6086672243080abc5c20fcc8756f279.png', 'Почта Gmail.com', '', 0),
(671, 'children', '8ecaa95ba69db1b6f907d070b84c3691.jpg', 'Кухня в римском стиле ошд', '', 0),
(672, 'no-category', '09f5cdfe1b86f592b1befa13f5316d6a.jpg', '', '', 1),
(673, 'no-category', '7c70b62017da0973383483c219d8f66c.png', '', '', 1),
(674, 'no-category', '8609728e2651d9e879c8c9a8fcd162a2.png', '', '', 1),
(675, 'no-category', '74470f65de4c534049ab0dddc7d016ff.png', '', '', 1),
(676, 'no-category', '6f64a5fc55eff3547d6c87b97dcc69aa.png', '', '', 1),
(677, 'no-category', 'dd67735c1ee9d350bb5b53bed8b6f5b1.png', '', '', 1),
(678, 'no-category', 'f7601c4b4061eb31e462bc40f444b95b.png', '', '', 1),
(679, 'no-category', 'c60d5444af74581dbbd1c458c9a0706f.png', '', '', 1),
(680, 'no-category', 'd9081cd0f6134debd04ae54aa7716dc7.png', '', '', 1),
(681, 'no-category', '560aeef084012cd55f1f4b9e52b7b529.png', '', '', 1),
(682, 'no-category', 'bcae658181fd6d32066aef3c26d67270.png', '', '', 1),
(683, 'no-category', 'a645ac991000843be71fb79e81fc9173.png', '', '', 1),
(684, 'no-category', '1d2d14115d0dacc5ceb40a980a8dcf36.png', '', '', 1),
(685, 'no-category', '206c8edca6f3a02c29e509df7cfca0e7.png', '', '', 1),
(686, 'no-category', '5751e9d21b18ef175a1ca6a74345169b.png', '', '', 1),
(687, 'no-category', '3820d1dbcc4686acd1225b62e90083cf.png', '', '', 1),
(688, 'no-category', 'c93445a71e43ea42078b3950c31ef362.png', '', '', 1),
(689, 'no-category', '55180adc927e23f0157325595059ece4.png', '', '', 1),
(690, 'no-category', 'fcb19b5db5d4f269fde63d1a275e763d.png', '', '', 1),
(691, 'no-category', '32b8c756d4291f1e70114b476df8faca.png', '', '', 1),
(692, 'no-category', '29c83bd58fe71b1c76468e91dc6523dd.png', '', '', 1),
(693, 'no-category', '21e4d12e19a68c2dd0ca174a14de6d03.png', '', '', 1),
(694, 'no-category', '129be51c38a96e0c4369ee59d9f31ea7.png', '', '', 1),
(695, 'no-category', '7a07f8fffd6027f893e0eb7c5785609f.png', '', '', 1),
(696, 'no-category', '11302a8d0af924407270f3a6aec48779.png', '', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `rate`
--

CREATE TABLE IF NOT EXISTS `rate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `date_time` datetime NOT NULL,
  `lot_id` int(10) NOT NULL,
  `user_rate` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Дамп данных таблицы `rate`
--

INSERT INTO `rate` (`id`, `user_id`, `date_time`, `lot_id`, `user_rate`) VALUES
(5, 10, '2014-02-24 00:58:30', 1, 15001),
(6, 10, '2014-02-24 00:58:39', 1, 15002),
(7, 10, '2014-02-24 01:14:52', 1, 15003),
(8, 10, '2014-02-24 01:15:25', 2, 300001),
(9, 10, '2014-02-24 01:17:34', 1, 15100),
(10, 10, '2014-02-24 01:17:43', 1, 16000),
(11, 10, '2014-02-24 01:17:59', 1, 17000),
(12, 10, '2014-02-24 01:31:38', 1, 17010),
(13, 10, '2014-02-24 01:31:40', 1, 17020),
(14, 10, '2014-02-24 01:31:44', 1, 17030),
(15, 10, '2014-02-24 01:31:46', 1, 17040),
(16, 10, '2014-02-24 01:31:48', 1, 17050),
(17, 10, '2014-02-24 01:31:49', 1, 17060),
(18, 10, '2014-02-24 01:31:51', 1, 17070),
(19, 10, '2014-02-24 01:31:53', 1, 17080),
(20, 10, '2014-02-24 01:31:55', 1, 18080),
(21, 10, '2014-02-24 01:31:58', 1, 20480),
(22, 10, '2014-02-24 01:32:02', 1, 21680),
(23, 10, '2014-02-24 01:32:07', 1, 27680),
(24, 10, '2014-02-24 01:32:24', 1, 30000),
(25, 10, '2014-02-24 01:32:42', 1, 31000),
(26, 10, '2014-02-24 01:32:44', 1, 32000),
(27, 10, '2014-02-24 01:32:46', 1, 33000),
(28, 10, '2014-02-24 01:32:48', 1, 34000),
(29, 10, '2014-02-24 01:32:50', 1, 35000),
(30, 10, '2014-02-24 01:32:52', 1, 36000),
(31, 10, '2014-02-24 01:32:58', 1, 37000),
(32, 10, '2014-02-24 01:33:00', 1, 38000),
(33, 10, '2014-02-24 01:33:02', 1, 39000),
(34, 10, '2014-02-24 01:33:04', 1, 40000),
(35, 10, '2014-02-24 01:33:06', 1, 41000),
(36, 10, '2014-02-24 01:33:09', 1, 42000),
(37, 10, '2014-02-24 01:33:11', 1, 43000),
(38, 10, '2014-02-24 01:33:13', 1, 44000),
(39, 10, '2014-02-24 01:33:17', 1, 45000),
(40, 10, '2014-02-24 01:33:19', 1, 46000),
(41, 10, '2014-02-24 01:34:24', 1, 46010),
(42, 10, '2014-02-24 01:34:34', 1, 46020),
(43, 10, '2014-02-24 01:34:38', 1, 46030),
(44, 10, '2014-02-24 01:34:40', 1, 46040),
(45, 10, '2014-02-24 01:34:42', 1, 46050),
(46, 10, '2014-02-24 01:34:44', 1, 46060),
(47, 10, '2014-02-24 01:34:46', 1, 46070),
(48, 10, '2014-02-24 01:34:47', 1, 46080),
(49, 10, '2014-02-24 01:34:49', 1, 46090),
(50, 10, '2014-02-24 01:34:50', 1, 46100),
(51, 10, '2014-02-24 01:34:53', 1, 46110),
(52, 10, '2014-02-24 01:34:54', 1, 46120),
(53, 10, '2014-02-24 01:34:56', 1, 46130),
(54, 10, '2014-02-24 01:34:58', 1, 46230),
(55, 10, '2014-02-24 01:35:03', 1, 47000),
(56, 10, '2014-02-24 01:35:25', 1, 48000),
(57, 10, '2014-02-24 01:35:27', 1, 49000),
(58, 10, '2014-02-24 01:35:30', 1, 50000),
(59, 10, '2014-02-24 01:36:28', 1, 55610),
(60, 10, '2014-02-24 01:37:38', 1, 56000),
(61, 10, '2014-02-24 01:38:25', 2, 302001),
(62, 10, '2014-02-24 01:39:28', 1, 60000),
(63, 10, '2014-02-24 01:39:35', 1, 61000),
(64, 10, '2014-02-24 01:39:44', 1, 80000),
(65, 10, '2014-02-24 01:40:33', 1, 90000),
(66, 10, '2014-02-24 01:40:38', 1, 100000),
(67, 10, '2014-02-24 04:49:30', 2, 303001),
(68, 10, '2014-02-24 05:41:50', 1, 100010),
(69, 10, '2014-02-24 05:43:43', 1, 100020),
(70, 10, '2014-02-24 05:44:40', 1, 100030),
(71, 10, '2014-02-24 05:44:51', 1, 100040),
(72, 10, '2014-02-24 05:47:51', 1, 100050),
(73, 10, '2014-02-24 05:58:15', 2, 303101),
(74, 10, '2014-02-24 05:58:19', 2, 304101),
(75, 10, '2014-02-24 05:58:24', 2, 304501),
(76, 10, '2014-02-24 05:58:53', 2, 304511),
(77, 10, '2014-02-24 05:59:42', 2, 304521),
(78, 10, '2014-02-24 07:06:30', 1, 100100),
(79, 10, '2014-02-24 07:08:03', 2, 309521),
(80, 10, '2014-02-24 07:20:28', 1, 120000),
(81, 10, '2014-02-24 19:08:55', 1, 120010),
(82, 10, '2014-02-24 19:11:56', 1, 120020),
(83, 10, '2014-02-24 19:35:03', 2, 310521),
(84, 10, '2014-02-24 19:40:30', 2, 311000),
(85, 10, '2014-02-24 19:52:09', 1, 130000),
(86, 10, '2014-02-24 20:02:22', 2, 315000),
(87, 10, '2014-02-24 20:06:43', 2, 320000),
(88, 10, '2014-02-24 20:44:18', 2, 450000),
(89, 10, '2014-02-24 20:45:45', 2, 4500000),
(90, 10, '2014-02-24 20:45:57', 2, 45000000),
(91, 10, '2014-02-24 20:47:53', 2, 45000010),
(92, 10, '2014-02-24 20:51:36', 2, 45000050),
(93, 10, '2014-02-24 20:52:34', 2, 45000100),
(94, 10, '2014-02-24 20:58:47', 2, 45000110),
(95, 10, '2014-02-24 20:59:18', 2, 45000120),
(96, 10, '2014-02-24 20:59:54', 2, 45000200),
(97, 10, '2014-02-24 21:00:41', 2, 450002000),
(98, 10, '2014-02-24 21:00:57', 2, 2147483647),
(99, 14, '2014-02-24 21:20:34', 1, 131000),
(100, 14, '2014-02-24 21:21:07', 1, 132000),
(101, 14, '2014-02-24 21:32:53', 1, 133000),
(102, 14, '2014-02-24 21:33:05', 1, 134000),
(103, 14, '2014-02-24 21:33:28', 1, 134100),
(104, 10, '2014-03-12 00:45:49', 1, 134130),
(105, 10, '2014-03-12 00:45:55', 1, 134140);

-- --------------------------------------------------------

--
-- Структура таблицы `store_admins`
--

CREATE TABLE IF NOT EXISTS `store_admins` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) CHARACTER SET latin1 NOT NULL,
  `hash_password` varchar(60) CHARACTER SET latin1 NOT NULL,
  `salt` varchar(40) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `store_admins`
--

INSERT INTO `store_admins` (`id`, `login`, `hash_password`, `salt`) VALUES
(1, 'arkadij', '$2a$10$ecdd9396bfb32daccb4faO9KLa/1v3wXd4ie.hXmOD2cfRzsvMg6e', '$2a$10$ecdd9396bfb32daccb4facfaf9184a4c$'),
(5, 'jeka', '$2a$10$0bccabe960b0e44162525epLDg1ab5K.XFfQRHemNV9fkqKhvjvpC', '$2a$10$0bccabe960b0e44162525f41759ca278$');

-- --------------------------------------------------------

--
-- Структура таблицы `store_page`
--

CREATE TABLE IF NOT EXISTS `store_page` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `wrap` tinyint(1) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `template` varchar(100) NOT NULL,
  `show_nav` tinyint(1) NOT NULL,
  `show_footer` tinyint(1) NOT NULL,
  `parent` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `store_page`
--

INSERT INTO `store_page` (`id`, `wrap`, `keywords`, `description`, `title`, `text`, `name`, `type`, `template`, `show_nav`, `show_footer`, `parent`) VALUES
(1, 1, 'Новый интерьер, шкафы-купе, окна, двери, кухни, прихожие, детские,интерьер, дизайн, всё для дома, идеи для дома', 'Компания ''Новый интерьер'' - предоставит всё для вашего дома', 'Главная', '', '', 'template', 'home,portfolio', 1, 1, 0),
(2, 1, 'шкафы-купе, окна, двери, кухни, прихожие, детские,интерьер, дизайн, не дорого, интерьер', 'Широкий асортимент товаров', 'Выполненные работы', '', 'portfolio', 'template', 'portfolio', 1, 1, 0),
(3, 1, '', '', 'Статьи', '', 'articles', 'template', 'articles', 1, 1, 0),
(4, 1, '', '', 'Контакты', '', 'contacts', 'template', 'contacts', 1, 1, 0),
(5, 1, '', '', 'Онлайн разработка', '<p>Вы смотрите на то как делают ваш заказ,следите за процессом.Все ваши желания будут учтены в процессе разработки.</p><p>Все это происходит в прямой трансляции в скайпе.</p>\n				<p>Все заказы делаются по индивидуальному проекту заказчика.</p>', 'online-dev', 'page', '', 0, 0, 0),
(6, 1, '', '', 'Статья', '', 'article', 'template', 'article', 0, 0, 3),
(7, 1, '', '', 'Аукцион', '', 'auctions', 'template', 'auctions', 0, 0, 0),
(8, 1, 'oatetaoeo ueoe uoe u', 'oeuoe uoeau oeu oeau aoeu aoe oueiuei', 'Лот', '', 'lot', 'template', 'lot', 0, 0, 7),
(9, 0, '', '', 'Адмн-панель', '', 'admin', 'template', 'admin/login_form', 0, 0, 0),
(10, 0, '', '', 'выход', '', 'logout', 'template', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `number` varchar(30) NOT NULL,
  `network` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `uid`, `first_name`, `last_name`, `number`, `network`) VALUES
(10, '43687107', 'Arkady', 'Kozhedub', '', 'vkontakte'),
(11, '100004755122491', 'Arkadij', 'Kozhedub', '', 'facebook'),
(14, '100621773296490374978', 'Аркадий', 'Кожедуб', '', 'google'),
(15, '7a8a6509d3bf1cef575d533ab104f8e1', 'Аркадий', 'Кожедуб', '', 'yandex'),
(16, '9802385262612575259', 'Аркодий', 'Кожедуб', '', 'mailru'),
(17, '264834891002', 'Арсений', 'Трипс', '', 'odnoklassniki');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
