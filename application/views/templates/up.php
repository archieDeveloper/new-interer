<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/styles/style.css">
    <link rel="stylesheet" type="text/css" href="/styles/flaticon.css">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    
    <script type="text/javascript" src="/js/lib/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/js/lib/jquery-ui-1.10.4.custom.min.js"></script> 
    <script type="text/javascript" src="/js/lib/jquery.slides.min.js"></script>

    <script type="text/javascript" src="/js/lib/jquery.mousewheel-3.0.6.pack.js"></script>

    <link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css" media="screen" />
    <script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js"></script>

    <script type="text/javascript" src="/js/fun.js"></script>
    <meta content="/img/soclogo.jpg" property="og:image">
    <meta charset = "utf-8">

    <meta name="keywords" content="<?=$page_info->keywords?>" />
    <meta name="description" content="<?=$page_info->description?>" />

    <title><?=$page_info->title?> | Новый Интерьер</title>
</head>

<body>

<div id="page-up"></div>

<div id="black_fon"></div>

<div id="form_view">
    <div id="form_view_close"></div>
    <img src="">
</div>

<div id="form_obr">
    <div id="form_obr_close">x</div>
    <div id="order_form_title"><h2>Запись на замер</h2></div>
    <div id="bobo"><div style='display:none;' id='status'></div></div>
    <form id="order_form" method="post">
        <div><label>Ваше имя:</label> <input style="float:right; width: 380px;" type="text" name="name" id="name" required><div class="cleaner"></div></div>
        <div><label>Телефон:</label> <input style="float:right; width: 380px;" type="text" name="number" id="number" required><div class="cleaner"></div></div>
        <div><label>Адрес:</label> <input style="float:right; width: 380px;" type="text" name="address" id="address" required><div class="cleaner"></div></div>
        <div><label style="width: 121px;">Желаемое время:</label>
            <span class="select-prev">с</span>
            <span class="select" id="start_time">
                <a href="javascript:void(0);" class="slct"><span>10</span><i class="flaticon-chevron8"></i></a>
                <ul class="drop" data-id="1">
                    <li>10</li>
                    <li>11</li>
                    <li>12</li>
                    <li>13</li>
                    <li>14</li>
                    <li>15</li>
                    <li>16</li>
                    <li>17</li>
                    <li>18</li>
                    <li>19</li>
                    <li>20</li>
                </ul>
                <div class="cleaner"></div>
            </span>
            <span class="select-prev">до</span>
            <span class="select" id="end_time">
                <a href="javascript:void(0);" class="slct"><span>11</span><i class="flaticon-chevron8"></i></a>
                <ul class="drop" data-id="1">
                    <li>11</li>
                    <li>12</li>
                    <li>13</li>
                    <li>14</li>
                    <li>15</li>
                    <li>16</li>
                    <li>17</li>
                    <li>18</li>
                    <li>19</li>
                    <li>20</li>
                    <li>21</li>
                </ul>
                <div class="cleaner"></div>
            </span>
        </div>
        <button style="float:right;" class="buttom" name="add_feedback">Записаться</button>
    </form>
</div>

<div id="obr_sv"></div>

<div id="header_wrap">
    <header id="header">
        <h1><a href="/"><img id="logo" src="/img/logo-ni.png">Новый Интерьер</a></h1>
        <div id="info_head">
            <span><b>Часы работы:</b> с 9:00 до 18:00</span><br>
            <span><b>Телефон:</b> +7 (951) 226-25-96</span><br>
            <span><b>Адрес:</b> г.Новокузнецк пр.Запсибовцев, д. 39</span>
        </div>
        <div class="cleaner"></div>
    </header>
    <nav id="nav">
        <ul>
            <?php foreach ($page_list as $value): if($value->show_nav):?>
                <?php switch ($value->type): case "template": ?>
                    <li <?php if($value->id == 5){ echo 'class="end-list"'; } ?>><a href="/<?=$value->name;?><?php if (!empty($value->name)) : echo '.html'; endif;?>" <?php if($value->id == $page_info->id || $value->id == $page_info->parent) {echo 'id="nav_active"';} ?>><?=$value->title;?></a></li>
                <?php break; case "page": ?>   
                    <li <?php if($value->id == 5){ echo 'class="end-list"'; } ?>><a href="/<?=$value->name;?>.html" <?php if($value->id == $page_info->id || $value->id == $page_info->parent) {echo 'id="nav_active"';} ?>><?=$value->title;?></a></li>
                <?php break; endswitch; ?>
            <?php endif; endforeach; ?>
            <?php /*<a class="auction" href="/auctions.html">Аукцион<span>new</span></a>*/ ?>
        </ul>
        
        <div class="cleaner"></div>
    </nav>
    <?php if (isset($slider_boolean)) : ?>
    <div id="slides">
        <img src="/img/portfolio/big/0e2e631a.jpg" alt="Покупка в один клик">
        <img src="/img/portfolio/big/8b1303c5.jpg" alt="С нами безопасно">
        <img src="/img/portfolio/big/6d0a90bb.jpg" alt="Лучшее качество">
        <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
        <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
    </div>
    <?php endif; ?>
</div>
<div id="content_wrap">
    <div id="wrap">
        <div id="wrap_left_shadow">
            <div id="content">