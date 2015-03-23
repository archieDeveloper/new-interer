$(document).ready(function(){
  "use strict";

  $(document).scroll(function(){
    if($(document).scrollTop() <= 320) $('#page-up').fadeOut(); else $('#page-up').fadeIn();
  });

  $(document).on('click', '#page-up', function(){
    $('body, html').animate({scrollTop: 0}, 300);
  });

  var $form_obr = $('#form_obr'),
    $black_fon = $('#black_fon');

  $(document).on('click','#obr_sv',function() {
    var $he = $(document).height();
    var $wi = $(document).width();

    var $top = $(document).scrollTop()+100;
    var $left = ($wi/2)-($form_obr.width()/2);

    $black_fon.css({'height':$he,'width':$wi});
    $black_fon.fadeIn('fast');

    $form_obr.css({'top': $top, 'left': $left});
    $form_obr.fadeIn('fast');
  });

  $(document).on('click','#form_obr_close',function(){
    $black_fon.fadeOut('fast');
    $form_obr.fadeOut('fast');
  });

  $(document).on('click','#black_fon',function(){
    $black_fon.fadeOut('fast');
    $form_obr.fadeOut('fast');
  });

  $(document).on('click','#form_obr button.button',function(){
    var $button = $(this);
    var $name = $('#form_obr #name').val();
    var $number = $('#form_obr #number').val();
    var $address = $('#form_obr #address').val();
    var $start_time = $('#form_obr #start_time .slct span').eq(0).text();
    var $end_time = $('#form_obr #end_time .slct span').eq(0).text();
    console.log($button);

    var $bobo = $('#bobo');
    if ($name != '' && $number != '' && $address != '' && $start_time != '' && $end_time != '') {
      var text_button = $button.text();
      var h_button = $button.height();
      var w_button = $button.width();
      $button.prop( "disabled", true );
      $button.html("<div id='outer-barG'><img src='/img/btn_load.gif' alt='Отправка' title='Отправка'></div>");
      $button.height(h_button);
      $button.width(w_button);
      $button.css({'background':'#CC1558'});
      $.ajax({
        dataType : "html",
        type     : "POST",
        data     : 'name='+$name+'&number='+$number+'&address='+$address+'&start_time='+$start_time+'&end_time='+$end_time+'&add_feedback=1',
        url      : '/contacts.html',
        success  : function(data){
          $button.prop( "disabled", false );
          $button.text(text_button);
          $button.attr('style','float:right;');

          $bobo.fadeIn('fast');
          $bobo.html("<div id='status'>Сообщение отправленно.</div>");
          $('#form_obr #name').val('');
          $('#form_obr #number').val('');
          $('#form_obr #address').val('');
          $('#form_obr #start_time .slct span').eq(0).text('10');
          $('#form_obr #end_time .slct span').eq(0).text('11');
        }
      });
    } else {
      $button.prop( "disabled", false );
      $bobo.fadeIn('fast');
      $bobo.html("<div style='background:rgb(240, 161, 161);' id='status'>Заполните все поля.</div>");
      setTimeout(function(){
        $bobo.fadeOut('fast');
      },2000);
    }
  });

  // Select

  $(document).on('click', '.slct',function(e){
    e.preventDefault();
    var $this = $(this);
    var $dropBlock = $this.parent().find('.drop');

    if( $dropBlock.is(':hidden') ) {
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
  $(document).on('click','.drop li',function(){
    var $drop = $('.drop'),
      $this = $(this);
    $drop.find('li').removeClass('active');
    $this.addClass('active');
    var selectResult = $this.html();
    $this.parent().parent().find('.slct').removeClass('active').html('<span>'+selectResult+'</span>'+'<i class="flaticon-chevron8"></i>');
    $drop.slideUp(200);
  });


});

$(window).load(function() {
  "use strict";

  /* Расстановка элементов в портфолио */
  var $portfolioContainer = $('#portfolio-container');

  $portfolioContainer.isotope({
    itemSelector: '.wrap-product',
    layoutMode: 'masonry'
  });


  /* парсер GET параметров */
  var parseGetParams = function() {
    var $_GET = {};
    var __GET = window.location.search.substring(1).split("&");
    for(var i=0; i<__GET.length; i++) {
      var getVar = __GET[i].split("=");
      $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1];
    }
    return $_GET;
  };

  var getParams = parseGetParams();

  $('.wrap-product a').fancybox({
    titleShow	: true,
    afterClose	: function() {
      var id_product = $(this.element).attr('data-id');

      var arrGet = window.location.search.split('&');
      arrGet[0] = arrGet[0].substring(1);

      var arrGetLength = arrGet.length;
      for (var i = 0; i < arrGetLength; i++) {
        arrGet[i] = arrGet[i].split('=');
      }

      var newArrGet = [];
      arrGetLength = arrGet.length;
      for (var i = 0; i < arrGetLength; i++) {
        if (arrGet[i][0] !== 'id_product') {
          newArrGet.push(arrGet[i]);
        }
      }

      var searchStr = '';
      var newArrGetLength = newArrGet.length;
      for (var i = 0; i < newArrGetLength; i++) {
        searchStr += (i === 0 ? '?' : '&') + newArrGet[i][0] + '=' + newArrGet[i][1];
      }
      history.pushState({foo: 'bar'}, 'Title', window.location.pathname+searchStr);
    },
    afterLoad	: function() {
      var id_product = $(this.element).attr('data-id');

      var searchStr = '';
      if (window.location.search !== '') {
        var arrGet = window.location.search.split('&');
        arrGet[0] = arrGet[0].substring(1);

        var arrGetLength = arrGet.length;
        for (var i = 0; i < arrGetLength; i++) {
          arrGet[i] = arrGet[i].split('=');
        }

        var newArrGet = [];
        arrGetLength = arrGet.length;
        for (var i = 0; i < arrGetLength; i++) {
          if (arrGet[i][0] !== 'id_product') {
            newArrGet.push(arrGet[i]);
          }
        }

        var newIdProduct = ['id_product',id_product];
        newArrGet.push(newIdProduct);

        var newArrGetLength = newArrGet.length;
        for (var i = 0; i < newArrGetLength; i++) {
          searchStr += (i === 0 ? '?' : '&') + newArrGet[i][0] + '=' + newArrGet[i][1];
        }
      } else {
        searchStr += '?id_product='+id_product;
      }
      history.pushState({foo: 'bar'}, 'Title', window.location.pathname+searchStr);
      this.title = '<b class="title-product">' + (this.title ? this.title : '') + ' / </b><span class="pos-product">Кутузова д.48 кв.39</span><br>Поделись с друзьями в социальных сетях<br><script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div><button class="button think">Записаться на бесплатный замер</button>';
    },
    helpers		: {
      title	: { type : 'inside' }
    }
  });

  if (typeof getParams['id_product'] !== 'undefined') {
    //$('.wrap-product a[data-id = '+getParams['id_product']+']').click();
    var $current_product = $('#current_product');
    var $curId = $current_product.attr('data-id');
    var $curImg = $current_product.attr('data-img');
    var $curTitle = $current_product.attr('data-title');
    console.log($curImg);
    $.fancybox.open([{
      titleShow	: true,
      href:'/img/portfolio/big/'+$curImg,
      title: '<b class="title-product">' + ($curTitle ? $curTitle : '') + ' / </b><span class="pos-product">Кутузова д.48 кв.39</span><br>Поделись с друзьями в социальных сетях<br><script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div><button class="button think">Записаться на бесплатный замер</button>',
      afterClose	: function() {
        var id_product = $(this.element).attr('data-id');

        var arrGet = window.location.search.split('&');
        arrGet[0] = arrGet[0].substring(1);

        var arrGetLength = arrGet.length;
        for (var i = 0; i < arrGetLength; i++) {
          arrGet[i] = arrGet[i].split('=');
        }

        var newArrGet = [];
        arrGetLength = arrGet.length;
        for (var i = 0; i < arrGetLength; i++) {
          if (arrGet[i][0] !== 'id_product') {
            newArrGet.push(arrGet[i]);
          }
        }

        var searchStr = '';
        var newArrGetLength = newArrGet.length;
        for (var i = 0; i < newArrGetLength; i++) {
          searchStr += (i === 0 ? '?' : '&') + newArrGet[i][0] + '=' + newArrGet[i][1];
        }
        history.pushState({foo: 'bar'}, 'Title', window.location.pathname+searchStr);
      },
      helpers		: {
        title	: { type : 'inside' }
      }
    }]);
  }

  window.addEventListener('popstate', function(e){
    window.location.href = window.location.href;
  }, false);
});