<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?=$page_title?></title>
  <link rel="stylesheet" href="/styles/admin.css">
  <link rel="stylesheet" href="/styles/flaticon.css">

  <script type="text/javascript" src="/js/lib/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="/js/lib/jquery-ui-1.10.4.custom.min.js"></script>
  <script type="text/javascript" src="/js/admin.js"></script>
  <?php foreach ($include_js as $js_path) :?>
    <script type="text/javascript" src="/js/<?=$js_path?>.js"></script>
  <?php endforeach; ?>
  <?php foreach ($include_css as $css_path) :?>
    <link rel="stylesheet" href="/styles/<?=$css_path?>.css">
  <?php endforeach; ?>
</head>
<body>
  <div class="wrap-container">
    <div class="wrap-color-line">
      <div class="wcl-item-1"></div>
      <div class="wcl-item-2"></div>
      <div class="wcl-item-3"></div>
      <div class="wcl-item-4"></div>
      <div class="wcl-item-5"></div>
      <div class="wcl-item-6"></div>
      <div class="wcl-item-7"></div>
    </div>
    <div class="header">
      <h1>Админ панель</h1>
    </div>
    <div class="wrap-content">
      <div class="left-aside">
        <span><i class="flaticon-menu10"></i> Меню</span>
        <ul>
          <li><a href="/nimyadmin/pages.html">Страницы</a></li>
          <li <?php echo !empty($page_controller) && $page_controller == 'portfolio' ? 'class="active"' : ''; ?>>
            <a href="/nimyadmin/portfolio.html">Выполненные работы</a>
            <ul>
              <li <?php echo !empty($page_controller) && empty($page_action) && $page_controller == 'portfolio' ? 'class="active"' : ''; ?>><a href="/nimyadmin/portfolio.html">Все работы</a></li>
              <li <?php echo !empty($page_controller) && $page_controller == 'portfolio' && !empty($page_action) && $page_action == 'add' ? 'class="active"' : ''; ?>><a href="/nimyadmin/portfolio/add.html">Добавить новую</a></li>
              <li <?php echo !empty($page_controller) && $page_controller == 'portfolio' && !empty($page_action) && $page_action == 'categories' ? 'class="active"' : ''; ?>><a href="/nimyadmin/portfolio/categories.html">Категории</a></li>
            </ul>
          </li>
          <li <?php echo !empty($page_controller) && $page_controller == 'articles' ? 'class="active"' : ''; ?>>
            <a href="/nimyadmin/articles.html">Статьи</a>
            <ul>
              <li <?php echo !empty($page_controller) && empty($page_action) && $page_controller == 'articles' ? 'class="active"' : ''; ?>><a href="/nimyadmin/articles.html">Все статьи</a></li>
              <li <?php echo !empty($page_controller) && $page_controller == 'articles' && !empty($page_action) && $page_action == 'add' ? 'class="active"' : ''; ?>><a href="/nimyadmin/articles/add.html">Добавить новую</a></li>
            </ul>
          </li>
          <li><a href="/nimyadmin/contacts.html">Контакты</a></li>
          <li><a href="/nimyadmin/feedback.html">Обратная связь</a></li>
        </ul>
      </div>
      <div class="content">