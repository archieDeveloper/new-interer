<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Welcome</title>

        <!--[if IE]-->
        <link rel="stylesheet" type="text/css" href="/css/ie.css" />
        <!--[endif]-->

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <script type="text/javascript" src="/js/lib/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="/js/admin/main.js"></script>
    </head>
    <body>
        <div class="all-wrap">
            <a class="logo-login-form" href="/">New-interer.ru</a>
            <form action="" method="post" class="form-login">
                <h1>-= Admin tools =-</h1>
                <?php if(!empty($log_in['login_errors'])): foreach ($log_in['login_errors'] as $value):?>
                <span class="error"><?=$errors[$value];?></span> 
                <?php endforeach; endif; ?>
                <input id="jq-focus-input" type="text" placeholder="Name" name="login" value="arkadij">
                <input type="password" placeholder="Password" name="password" value="123456s">
                <input type="submit" name="log_in" value="Log in">
            </form>
        </div>
    </body>
</html>