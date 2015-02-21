$(document).ready(function(){
	$('#slides').slidesjs({
        width: 940,
        height: 380,
        navigation: false,
        play: {
            active: false,
            effect: "slide",
            interval: 10000,
            auto: true,
            swap: true,
            pauseOnHover: true,
            restartDelay: 2500
        }
    });

	$(document).scroll(function(){
		if($(document).scrollTop() <= 320) {
			$('#page-up').fadeOut();
		} else {
			$('#page-up').fadeIn();
		}
	});

	$('#page-up').on('click', function(){
		$('body, html').animate({scrollTop: 0}, 300);
	});

	$('.plus-rate').on('click', function(e){
		e.preventDefault();
		$plus = $(this).find('span').text();
		$('#rate').val(parseFloat($('#rate').val()) + parseFloat($plus));
	});

	$('#open_history_rate').on('click', function(e){
		e.preventDefault();
		$('.tabs-lot').find('a[href="#tabs-2"]').click();
		$('html, body').animate({scrollTop: $('.tabs-lot').offset().top}, 300);
	});

	$('.close-status-rate').on('click', function(e){
		$('#status-rate').fadeOut();
	});

	$('#obr_sv').click(function(){

		$he = $(document).height();
		$wi = $(document).width();

		$top = $(document).scrollTop()+100;
		$left = ($(document).width()/2)-($('#form_obr').width()/2);

		$('#form_obr').css({'top': $top, 'left': $left});	

		$('#black_fon').css({'height':$he,'width':$wi});
		$('#black_fon').fadeIn('fast');
		$('#form_obr').fadeIn('fast');
	});

	$('#form_obr_close').click(function(){
		$('#black_fon').fadeOut('fast');
		$('#form_obr').fadeOut('fast');
	});

	$('#black_fon').click(function(){
		$('#black_fon').fadeOut('fast');
		$('#form_obr').fadeOut('fast');
		$('#form_view').fadeOut('fast');
		$('#form_view img').attr('src', '');
	});

	$width = $('.mini_post').outerWidth(true);

	$('.post .post_ober').each(function(){
		$(this).attr('pos',0);
		$widthall = ($(this).children('.mini_image').length) * $width;
		$(this).width($widthall);
		
	});

	$('.right_post').click(function(){
		$elem = $(this).prev();
		$pos = parseInt($($elem).attr('pos'));
		$max = $($elem).children('.mini_image').length-4;
		
		if ($pos<=$max) {
			$($elem).stop();
			$pos += 1;
			$($elem).attr('pos',$pos);
			$sdvig = $width*$pos*(-1);
			$($elem).animate({marginLeft: $sdvig});
		};
	});

	$('.left_post').click(function(){
		$elem = $(this).next();
		$pos = parseInt($($elem).attr('pos'));

		if ($pos>=1) {
			$($elem).stop();
			$pos -= 1;
			$($elem).attr('pos',$pos);

			$sdvig = $width*$pos*(-1);
			$($elem).animate({marginLeft: $sdvig});
		};
	});
	
	$('#form_view_close').click(function(){
		$(this).next().attr('src', '');
		$('#black_fon').fadeOut('fast');
		$('#form_view').fadeOut('fast');
	});

	$('#form_obr .buttom').click(function(){
		button = this;
		$name = $('#form_obr #name').val();
		$number = $('#form_obr #number').val();
		$address = $('#form_obr #address').val();
		$start_time = $('#form_obr #start_time .slct span').eq(0).text();
		$end_time = $('#form_obr #end_time .slct span').eq(0).text();
		console.log($(button));

		if ($name != '' && $number != '' && $address != '' && $start_time != '' && $end_time != '') {
			text_button = $(button).text();
			h_button = $(button).height();
			w_button = $(button).width();
			$(button).prop( "disabled", true );
			$(button).html("<div id='outer-barG'><img src='/img/btn_load.gif' alt='Отправка' title='Отправка'></div>");
			$(button).height(h_button);
			$(button).width(w_button);
			$(button).css({'background':'#CC1558'});
			$.ajax({
				dataType : "html",
				type     : "POST",
				data     : 'name='+$name+'&number='+$number+'&address='+$address+'&start_time='+$start_time+'&end_time='+$end_time+'&add_feedback=1',
				url      : '/contacts.html',
				success  : function(data){
					$(button).prop( "disabled", false );
					$(button).text(text_button);
					$(button).attr('style','float:right;');
					$('#bobo').fadeIn('fast');
					$('#bobo').html("<div id='status'>Сообщение отправленно.</div>");
					$('#form_obr #name').val('');
					$('#form_obr #number').val('');
					$('#form_obr #address').val('');
					$('#form_obr #start_time .slct span').eq(0).text('10');
					$('#form_obr #end_time .slct span').eq(0).text('11');
				}
			});
		} else {
			$(button).prop( "disabled", false );
			$('#bobo').fadeIn('fast');
			$('#bobo').html("<div style='background:rgb(240, 161, 161);' id='status'>Заполните все поля.</div>");
			setTimeout(function(){
				$('#bobo').fadeOut('fast');
			},2000);
		};
	});




	// Select

	$(document).on('click', '.slct',function(e){
	    e.preventDefault();

	    var dropBlock = $(this).parent().find('.drop');

	    if( dropBlock.is(':hidden') ) {
	    	$('.drop').slideUp(200);
	    	$('.slct').removeClass('active');
	        dropBlock.slideDown(200);
	        $(this).addClass('active');
	    } else {
	        $(this).removeClass('active');
	        dropBlock.slideUp(200);
	    }
	});

	/* Работаем с событием клика по элементам выпадающего списка */
	$(document).on('click','.drop li',function(){
	    $('.drop').find('li').removeClass('active');
	    $(this).addClass('active');
	    var selectResult = $(this).html();
	    $(this).parent().parent().find('.slct').removeClass('active').html('<span>'+selectResult+'</span>'+'<i class="flaticon-chevron8"></i>');
	    $('.drop').slideUp(200);
	});

});

$(window).load(function() {
	$(".tabs-lot").tabs();

	var parseGetParams = function() {
		var $_GET = {};
		var __GET = window.location.search.substring(1).split("&");
		for(var i=0; i<__GET.length; i++) {
			var getVar = __GET[i].split("=");
			$_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1];
		}
		return $_GET;
	}

	getParams = parseGetParams();
	console.log(getParams);

	/*$arr_group = new Array('shkafi_group','kuhni_group','prihozie_group','detskie_group','okna_group','dveri_group');
	jQuery.each($arr_group, function(){
		console.log($("a[rel="+this+"]"));
		$("a[rel="+this+"]").fancybox({
			prevEffect	: 'none',
			nextEffect	: 'none',
			afterLoad	: function() {
				this.title = 'Изображение ' + (this.index + 1) + ' из ' + this.group.length + (this.title ? '<br>' + this.title : ''); },
			helpers		: {
				title	: { type : 'inside' }
			}
		});
	});*/

	$('.wrap-product a').fancybox({
		titleShow	: true,
		afterClose	: function() {
			id_product = $(this.element).attr('data-id');

			arrGet = window.location.search.split('&');
			arrGet[0] = arrGet[0].substring(1);

			arrGetLength = arrGet.length;
			for (var i = 0; i < arrGetLength; i++) {
			    arrGet[i] = arrGet[i].split('=');
			}

			newArrGet = [];
			arrGetLength = arrGet.length;
			for (var i = 0; i < arrGetLength; i++) {
				if (arrGet[i][0] !== 'id_product') {
					newArrGet.push(arrGet[i]);
				};
			}

			searchStr = '';
			newArrGetLength = newArrGet.length;
			for (var i = 0; i < newArrGetLength; i++) {
				searchStr += (i === 0 ? '?' : '&') + newArrGet[i][0] + '=' + newArrGet[i][1];
			}
			history.pushState({foo: 'bar'}, 'Title', window.location.pathname+searchStr);
		},
		afterLoad	: function() {
			id_product = $(this.element).attr('data-id');

			searchStr = '';
			if (window.location.search !== '') {
				arrGet = window.location.search.split('&');
				arrGet[0] = arrGet[0].substring(1);

				arrGetLength = arrGet.length;
				for (var i = 0; i < arrGetLength; i++) {
				    arrGet[i] = arrGet[i].split('=');
				}

				newArrGet = [];
				arrGetLength = arrGet.length;
				for (var i = 0; i < arrGetLength; i++) {
					if (arrGet[i][0] !== 'id_product') {
						newArrGet.push(arrGet[i]);
					};
				}

				newIdProduct = ['id_product',id_product];
				newArrGet.push(newIdProduct);

				newArrGetLength = newArrGet.length;
				for (var i = 0; i < newArrGetLength; i++) {
					searchStr += (i === 0 ? '?' : '&') + newArrGet[i][0] + '=' + newArrGet[i][1];
				}
			} else {
				searchStr += '?id_product='+id_product;
			}
			history.pushState({foo: 'bar'}, 'Title', window.location.pathname+searchStr);
			this.title = '<b class="title-product">' + (this.title ? this.title : '') + ' / </b><span class="pos-product">Кутузова д.48 кв.39</span><br>Поделись с друзьями в социальных сетях<br><script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div><button class="buttom think">Записаться на бесплатный замер</button>';
		},
		helpers		: {
			title	: { type : 'inside' }
		}
	});

	if (typeof getParams['id_product'] !== 'undefined') {
		//$('.wrap-product a[data-id = '+getParams['id_product']+']').click();
		$current_product = $('#current_product');
		$curId = $current_product.attr('data-id');
		$curImg = $current_product.attr('data-img');
		$curTitle = $current_product.attr('data-title');
		console.log($curImg);
		$.fancybox.open([{
			titleShow	: true,
			href:'/img/portfolio/big/'+$curImg,
			title: '<b class="title-product">' + ($curTitle ? $curTitle : '') + ' / </b><span class="pos-product">Кутузова д.48 кв.39</span><br>Поделись с друзьями в социальных сетях<br><script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div><button class="buttom think">Записаться на бесплатный замер</button>',
			afterClose	: function() {
				id_product = $(this.element).attr('data-id');

				arrGet = window.location.search.split('&');
				arrGet[0] = arrGet[0].substring(1);

				arrGetLength = arrGet.length;
				for (var i = 0; i < arrGetLength; i++) {
				    arrGet[i] = arrGet[i].split('=');
				}

				newArrGet = [];
				arrGetLength = arrGet.length;
				for (var i = 0; i < arrGetLength; i++) {
					if (arrGet[i][0] !== 'id_product') {
						newArrGet.push(arrGet[i]);
					};
				}

				searchStr = '';
				newArrGetLength = newArrGet.length;
				for (var i = 0; i < newArrGetLength; i++) {
					searchStr += (i === 0 ? '?' : '&') + newArrGet[i][0] + '=' + newArrGet[i][1];
				}
				history.pushState({foo: 'bar'}, 'Title', window.location.pathname+searchStr);
			},
			helpers		: {
				title	: { type : 'inside' }
			}
		}]);
	};

	/*$(document).on('click','.fancybox-close, .fancybox-overlay',function(){
		console.log('load');
	});*/

	window.addEventListener('popstate', function(e){
		window.location.href = window.location.href;
	}, false);
});