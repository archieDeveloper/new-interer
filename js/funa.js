$(document).ready(function(){

	$top = ($(document).height()/2)-($('#login').height()/2);
	$left = ($(document).width()/2)-($('#login').width()/2);

	$('#login').css({'top': $top, 'left': $left});	
	
	$(window).bind('resize', function(){
		$top = ($(document).height()/2)-($('#login').height()/2);
		$left = ($(document).width()/2)-($('#login').width()/2);

		$('#login').css({'top': $top, 'left': $left});		
	});

	$width = $('.mini_post').outerWidth(true);

	$('.post .post_ober').each(function(){
		$(this).attr('pos',0);
		$widthall = ($(this).children().children('.mini_post').length) * $width;
		$(this).width($widthall);
		
	});

	$('.right_post').click(function(){
		$elem = $(this).prev();
		$pos = parseInt($($elem).attr('pos'));
		$max = $($elem).children().children('.mini_post').length-3;
		
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

	$('.mini_post').mouseout(function(){
		$(this).next().hide();
	});

	$('.mini_post').mouseover(function(){
		$(this).next().show();
	});

	$('.delete').mouseout(function(){
		$(this).hide();
	});

	$('.delete').mouseover(function(){
		$(this).show();
	});

	$('.delete').click(function(){
		$elem = $(this).prev();
		$src = $($elem).attr('src');

		$.ajax({
			dataType : "html",
			type     : "POST",
			data     : 'delete='+$src,
			url      : '/admin/portfolio',
			success  : function(data){
				$($elem).parent().fadeOut('fast', function(){
					$col_miot = $elem.parent().parent().children('.miot').length;
					if ($col_miot <= 1) {$($elem).parent().parent().parent().parent().slideUp(700);};
					$($elem).parent().remove();
				});
				
			}

		});
	});

	$('.deletes').click(function(){
		$id = $(this).parent().attr('id');
		$elem = $(this).parent();

		console.log($elem);

		$.ajax({
			dataType : "html",
			type     : "POST",
			data     : 'id='+$id,
			url      : '/admin/message',
			success  : function(data){
				$($elem).fadeOut('fast');
			}

		});
	});



});

