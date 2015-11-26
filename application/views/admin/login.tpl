<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Вход в админ-панель</title>
  <link rel="stylesheet" href="/styles/admin_form.css">
</head>
<body>
  <div class="wrap-login-form">
    <div class="wrap-color-line">
      {for $wclItem=1 to 7}<div class="wcl-item-{$wclItem}}"></div>{/for}
    </div>
    <div class="header-form">
      <h1>Админ-панель</h1>
    </div>
    {if isset($log_in['login_errors']) && isset($errors)}
      {foreach from=$log_in['login_errors'] item="error"}
        <div class="error">{$errors[$error]}</div>
      {/foreach}
    {/if}
    <form class="login-form" action="" method="POST">
      <input type="text" name="login" placeholder="Логин">
      <input type="password" name="password" placeholder="Пароль">
      <input type="submit" name="submit_login" value="Войти">
    </form>
  </div>
</body>
</html>