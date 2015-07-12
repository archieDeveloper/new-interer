$(document).ready(function () {
  "use strict";

  var slides = document.getElementsByClassName('desc-slide');
  var $document = $(document);

  window.onscroll = function () {
    /*var scrolled = window.pageYOffset || document.documentElement.scrollTop;
     if (scrolled <= 800) {
     for(var index in slides) {
     if(typeof slides[index] === 'object'){
     slides[index].style.marginTop = (scrolled/1.9+100) + 'px';
     }
     }
     }*/
  };

  $('input[name="number"]').inputmask("+7 (999) 999 99-99");

  $document.scroll(function () {
    if ($(document).scrollTop() <= 320) $('#page-up').fadeOut(); else $('#page-up').fadeIn();
  });

  $document.on('click', '#page-up', function () {
    $('body, html').animate({scrollTop: 0}, 300);
  });

  var $form_obr = $('#form_obr'),
    $black_fon = $('#black_fon'),
    $form_sing_up_froze = $('#sing_up_froze');

  $document.on('click', '.obr_sv', function (e) {
    e.preventDefault();
    var $he = $document.height();
    var $wi = $document.width();

    var $top = $document.scrollTop() + 100;
    var $left = ($wi / 2) - ($form_obr.width() / 2);

    $black_fon.css({'height': $he, 'width': $wi});
    $black_fon.fadeIn('fast');

    $form_obr.css({'top': $top, 'left': $left});
    $form_obr.fadeIn('fast');
  });

  $document.on('click', '#form_obr_close', function () {
    $black_fon.fadeOut('fast');
    $form_obr.fadeOut('fast');
  });

  $document.on('click', '#black_fon', function () {
    $black_fon.fadeOut('fast');
    $form_obr.fadeOut('fast');
    $form_sing_up_froze.fadeOut('fast');
  });

  $document.on('click', '.open_sing_up_froze', function (e) {
    e.preventDefault();
    var $he = $document.height();
    var $wi = $document.width();

    var $top = $document.scrollTop() + 100;
    var $left = ($wi / 2) - ($form_obr.width() / 2);

    $black_fon.css({'height': $he, 'width': $wi});
    $black_fon.fadeIn('fast');

    $form_sing_up_froze.css({'top': $top, 'left': $left});
    $form_sing_up_froze.fadeIn('fast');
  });

  $document.on('click', '#sing_up_froze_close', function () {
    $black_fon.fadeOut('fast');
    $form_obr.fadeOut('fast');
    $form_sing_up_froze.fadeOut('fast');
  });



  $document.on('click', '#form_obr button.button', function () {
    var $button = $(this);
    var $form_callback = $('#form_obr');
    var $name = $form_callback.find('#name').val();
    var $number = $form_callback.find('#number').val();
    var $start_time = $form_callback.find('#start_time .slct span').eq(0).text();
    var $end_time = $form_callback.find('#end_time .slct span').eq(0).text();

    var $bobo = $('#bobo');
    if ($name != '' && $number != '' && $start_time != '' && $end_time != '') {
      var text_button = $button.text();
      var h_button = $button.height();
      var w_button = $button.width();
      $button.prop("disabled", true);
      $button.html("<div id='outer-barG'><img src='/img/btn_load.gif' alt='Отправка' title='Отправка'></div>");
      $button.height(h_button);
      $button.width(w_button);
      $button.css({'background': '#CC1558'});
      $.ajax({
        dataType: "html",
        type: "POST",
        data: {
          name: $name,
          number: $number,
          start_time: $start_time,
          end_time: $end_time,
          add_callback: true
        },
        url: '/contacts.html',
        success: function () {
          $button.prop("disabled", false);
          $button.text(text_button);
          $button.attr('style', 'float:right;');

          $bobo.fadeIn('fast');
          $bobo.html("<div id='status'>Сообщение отправленно.</div>");

          $form_callback.find('#name').val('');
          $form_callback.find('#number').val('');
          $form_callback.find('#start_time .slct span').eq(0).text('10');
          $form_callback.find('#end_time .slct span').eq(0).text('11');
        },
        error: function (d) {
          console.log(d.responseText);
        }
      });
    } else {
      $button.prop("disabled", false);
      $bobo.fadeIn('fast');
      $bobo.html("<div style='background:rgb(240, 161, 161);' id='status'>Заполните все поля.</div>");
      setTimeout(function () {
        $bobo.fadeOut('fast');
      }, 2000);
    }
  });

  $document.on('click', '#sing_up_froze button.button', function () {
    var $button = $(this);
    var $form_callback = $('#sing_up_froze');
    var $name = $form_callback.find('#name').val();
    var $number = $form_callback.find('#number').val();
    var $start_time = $form_callback.find('#start_time .slct span').eq(0).text();
    var $end_time = $form_callback.find('#end_time .slct span').eq(0).text();

    var $bobo = $('#froze_status');
    if ($name != '' && $number != '' && $start_time != '' && $end_time != '') {
      var text_button = $button.text();
      var h_button = $button.height();
      var w_button = $button.width();
      $button.prop("disabled", true);
      $button.html("<div id='outer-barG'><img src='/img/btn_load.gif' alt='Отправка' title='Отправка'></div>");
      $button.height(h_button);
      $button.width(w_button);
      $button.css({'background': '#CC1558'});
      $.ajax({
        dataType: "html",
        type: "POST",
        data: {
          name: $name,
          number: $number,
          start_time: $start_time,
          end_time: $end_time,
          add_callback: true
        },
        url: '/contacts.html',
        success: function () {
          $button.prop("disabled", false);
          $button.text(text_button);
          $button.attr('style', 'float:right;');

          $bobo.fadeIn('fast');
          $bobo.html("<div id='status'>Заявка отправлена, ожидайте звонка.</div>");

          $form_callback.find('#name').val('');
          $form_callback.find('#number').val('');
          $form_callback.find('#start_time .slct span').eq(0).text('10');
          $form_callback.find('#end_time .slct span').eq(0).text('11');
        },
        error: function (d) {
          console.log(d.responseText);
        }
      });
    } else {
      $button.prop("disabled", false);
      $bobo.fadeIn('fast');
      $bobo.html("<div style='background:rgb(240, 161, 161);' id='status'>Заполните все поля.</div>");
      setTimeout(function () {
        $bobo.fadeOut('fast');
      }, 2000);
    }
  });

  $document.on('click', 'form button.button.froze', function (e) {
    e.preventDefault();
    var $button = $(this);
    var $form_callback = $button.parents('form');

    var $name = $form_callback.find('[name=name]').val();
    var $number = $form_callback.find('[name=number]').val();
    var $start_time = $form_callback.find('[name=start_time] .slct span').eq(0).text();
    var $end_time = $form_callback.find('[name=end_time] .slct span').eq(0).text();

    var $bobo = $('#bobo');
    if ($name != '' && $number != '' && $start_time != '' && $end_time != '') {
      var text_button = $button.text();
      var h_button = $button.height();
      var w_button = $button.width();
      $button.prop("disabled", true);
      $button.html("Отправка!");
      $button.height(h_button);
      $button.width(w_button);
      $button.css({background: '#5F5F5F'});
      $.ajax({
        dataType: "html",
        type: "POST",
        data: {
          name: $name,
          number: $number,
          start_time: $start_time,
          end_time: $end_time,
          froze: 1,
          add_callback: true
        },
        url: '/contacts.html',
        success: function () {
          $button.prop("disabled", false);
          $button.text(text_button);
          $button.attr('style', 'float:right;');

          $bobo.fadeIn('fast');
          $bobo.html("<div id='status'>Сообщение отправленно.</div>");

          $form_callback.find('[name=name]').val('');
          $form_callback.find('[name=number]').val('');
          $form_callback.find('[name=start_time] .slct span').eq(0).text('10');
          $form_callback.find('[name=end_time] .slct span').eq(0).text('11');
        },
        error: function (d) {
          console.log(d.responseText);
        }
      });
    } else {
      $button.prop("disabled", false);
      $bobo.fadeIn('fast');
      $bobo.html("<div style='background:rgb(240, 161, 161);' id='status'>Заполните все поля.</div>");
      setTimeout(function () {
        $bobo.fadeOut('fast');
      }, 2000);
    }
  });


  // Select

  $document.on('click', '.slct', function (e) {
    e.preventDefault();
    var $this = $(this);
    var $dropBlock = $this.parent().find('.drop');

    if ($dropBlock.is(':hidden')) {
      $('.drop').slideUp(200);
      $('.slct').removeClass('active');
      $dropBlock.slideDown(200);
      $this.addClass('active');
    } else {
      $this.removeClass('active');
      $dropBlock.slideUp(200);
    }
  });

  /* Работаем с событием клика по элементам выпадающего списка */
  $document.on('click', '.drop li', function () {
    var $drop = $('.drop'),
      $this = $(this);
    $drop.find('li').removeClass('active');
    $this.addClass('active');
    var selectResult = $this.html();
    var $slct = $this.parents().eq(1).find('.slct');
    $slct.removeClass('active').html('<span>' + selectResult + '</span>' + '<i class="flaticon-chevron8"></i>');
    $drop.slideUp(200);
  });

  var options = {
    animateThreshold: 200,
    scrollPollInterval: 0
  };
  $('.aniview').AniView(options);

});

$(window).load(function () {
  "use strict";

  /* Расстановка элементов в портфолио */
  var $portfolioContainer = $('#portfolio-container');

  $portfolioContainer.isotope({
    itemSelector: '.wrap-product',
    layoutMode: 'masonry'
  });

  /**
   *
   * парсер GET параметров
   *
   * @returns {{}}
   */
  var parseGetParams = function () {
    var $_GET = {};
    var __GET = window.location.search.substring(1).split("&");
    for (var i = 0; i < __GET.length; i++) {
      var getVar = __GET[i].split("=");
      $_GET[getVar[0]] = typeof(getVar[1]) == "undefined" ? "" : getVar[1];
    }
    return $_GET;
  };

  var getParams = parseGetParams();

  var getHtmlFancy = function (title) {
    return '<div class="float-left">' +
      '<b class="title-product">' + (title ? title : '') + ' / </b>' +
      '<span class="pos-product">Кутузова д.48 кв.39</span>' +
      '<br>' +
      'Поделись с друзьями в социальных сетях' +
      '<br>' +
      '<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>' +
      '<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div>' +
      '</div>' +
      '<div class="float-right">' +
      '<button class="button think open_sing_up_froze">Записаться на бесплатный замер</button>' +
      '</div>';
  };

  /**
   *
   * Функция работает с гет параметрами в адресной строке, удаляет или добавляет переменную id_poroduct
   * Можно модифицировать функцию так чтобы можно было кастомно задавать переменные
   *
   * @param id_product int
   * @returns string
   */
  var getSearchString = function (id_product) {
    var searchStr = '',
      $_GET = parseGetParams(),
      first = true;

    if (id_product) {
      $_GET['id_product'] = id_product;
    } else {
      delete $_GET['id_product'];
    }

    for (var param in $_GET) {
      var currentParam = $_GET[param];
      searchStr +=
        (first === true ? '?' : '&') +
        param +
        (currentParam ? '=' + currentParam : '');
      first = false;
    }

    return searchStr;
  };

  $('.wrap-product a').fancybox({
    titleShow: true,
    afterClose: function () {
      var searchStr = getSearchString();
      history.pushState({foo: 'bar'}, 'Title', window.location.pathname + searchStr);
    },
    afterLoad: function () {
      var id_product = $(this.element).attr('data-id');
      var searchStr;
      if (window.location.search !== '') {
        searchStr = getSearchString(id_product);
      } else {
        searchStr = '?id_product=' + id_product;
      }
      history.pushState({foo: 'bar'}, 'Title', window.location.pathname + searchStr);
      this.title = getHtmlFancy(this.title);
    },
    helpers: {
      title: {
        type: 'inside'
      }
    },
    mouseWheel: false
  });

  if (typeof getParams['id_product'] !== 'undefined') {
    var $current_product = $('#current_product');
    var $curImg = $current_product.attr('data-img');
    var $curTitle = $current_product.attr('data-title');
    $.fancybox.open([{
      titleShow: true,
      href: '/img/portfolio/big/' + $curImg,
      title: getHtmlFancy($curTitle),
      afterClose: function () {
        var searchStr = getSearchString();
        history.pushState({foo: 'bar'}, 'Title', window.location.pathname + searchStr);
      },
      helpers: {
        title: {
          type: 'inside'
        }
      },
      mouseWheel: false
    }]);
  }

  window.addEventListener('popstate', function (e) {
    window.location.href = window.location.href;
  }, false);
});