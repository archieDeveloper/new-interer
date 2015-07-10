<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('date_rus')) {
  function date_rus($d)
  {
    $date = explode('-', $d);
    $rus_name = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
    $date[1] = $rus_name[$date[1] - 1];
    return $date[2] . ' ' . $date[1] . ' ' . $date[0];
  }
}

if (!function_exists('pagination')) {
  function pagination($get_page, $num_pages, $text_prev = 'Предыдущая', $text_next = 'Следующая')
  {
    $prev = $get_page - 1;
    $next = $get_page + 1;

    if ($num_pages <= 1) {
      return;
    }

    if ($num_pages <= 10) {
      if ($prev) {
        echo '<li><a href="?page=' . $prev . '">' . $text_prev . '</a></li>';
      }
      for ($i = 0; $i < $num_pages; $i++) {
        echo '<li><a ' . ($get_page == $i + 1 ? 'class="active"' : '') . ' href="?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
      }
      if ($next <= $i) {
        echo '<li><a href="?page=' . $next . '">' . $text_next . '</a></li>';
      }
    } else {
      if ($get_page <= 4) {
        if ($prev) {
          echo '<li><a href="?page=' . $prev . '">' . $text_prev . '</a></li>';
        }
        for ($i = 0; $i < 5; $i++) {
          echo '<li><a ' . ($get_page == $i + 1 ? 'class="active"' : '') . ' href="?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
        }
        echo '<li>... </li> <li><a href="?page=' . $num_pages . '">' . $num_pages . '</a></li>';
        echo '<li><a href="?page=' . $next . '">' . $text_next . '</a></li>';
      } elseif ($get_page > 4 && $get_page <= $num_pages - 4) {
        echo '<li><a href="?page=' . $prev . '">' . $text_prev . '</a></li>';
        echo '<li><a href="?page=1">1</a></li><li>... </li>';
        for ($i = $get_page - 3; $i < $get_page + 2; $i++) {
          echo '<li><a ' . ($get_page == $i + 1 ? 'class="active"' : '') . ' href="?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
        }
        echo '<li>... </li> <li><a href="?page=' . $num_pages . '">' . $num_pages . '</a></li>';
        echo '<li><a href="?page=' . $next . '">' . $text_next . '</a></li>';
      } elseif ($get_page > $num_pages - 4) {
        echo '<li><a href="?page=' . $prev . '">' . $text_prev . '</a></li>';
        echo '<li><a href="?page=1">1</a></li><li>... </li>';
        for ($i = $num_pages - 5; $i < $num_pages; $i++) {
          echo '<li><a ' . ($get_page == $i + 1 ? 'class="active"' : '') . ' href="?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
        }
        if ($next <= $i) {
          echo '<li><a href="?page=' . $next . '">' . $text_next . '</a></li>';
        }
      }
    }
  }
}

if (!function_exists('breadcrumb')) {
  function breadcrumb($breadcrumb)
  {
    echo '<li><a href="/"><i class="flaticon-home11"></i></a></li>';
    $link = '';
    foreach ($breadcrumb as $item) {
      $link .= '/' . $item['link'];
      echo '<li><a href="' . $link . '.html">' . $item['name'] . '</a></li>';
    }
  }
}

if (!function_exists('time_before')) {
  function time_before($start_date, $hours)
  {
    date_default_timezone_set('MST');
    $time_passed = (abs(strtotime($start_date) - strtotime(date("Y-m-d H:i:s")))) / 3600;
    $remaining_time = ceil($hours - $time_passed);
    $end_char = substr($remaining_time, -1, 1);
    switch ($end_char) {
      case 0:
        $hours_before = 'часов';
        break;
      case 1:
        $hours_before = 'час';
        break;
      case 2:
      case 3:
      case 4:
        $hours_before = 'часа';
        break;
      case 5:
      case 6:
      case 7:
      case 8:
      case 9:
        $hours_before = 'часов';
        break;
    }
    echo $remaining_time . ' ' . $hours_before;
  }
}

if (!function_exists('installer')) {
  function installer($cur_auction, $only_name = false)
  {
    if ($cur_auction->id_user_rate) {
      if ($only_name) {
        echo $cur_auction->first_name . ' ' . $cur_auction->last_name;
      } else {
        echo $cur_auction->first_name . ' ' . $cur_auction->last_name . ' - <b>' . number_format($cur_auction->rate, 0, '', ' ') . ' руб.</b>';
      }
      return false;
    }
    echo '<b>Нет ставок</b>, Вы будите первыми!';
    return false;
  }
}

if (!function_exists('show_tf')) {
  function show_tf(&$boolean, $true = '', $false = '')
  {
    if (isset($boolean)) {
      if ($boolean) {
        echo $true;
      } else {
        echo $false;
      }
    }
    return false;
  }
}

if (!function_exists('explode_article')) {
  function explode_article($text)
  {
    $result = explode('<!--more-->', $text, 2);
    if (!isset($result[1])) {
      $result[1] = '';
    }
    return $result;
  }
}