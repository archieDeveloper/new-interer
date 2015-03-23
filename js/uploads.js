$(document).ready(function(){

  var $listPageLi = $('#js-list-page');

  $('#fileupload').fileupload({
    dataType: 'json',
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $('.progress .bar').css('width', progress + '%');
    },
    done: function (e, data) {
      var $error = $('#error');
      if(data.result.error != undefined){
        $error.html('<b class="float">Ошибка: </b>'+data.result.error);
        $error.fadeIn('slow');
      } else {
        console.log(data);
        $error.hide();
        var $newFileListPage = $($listPageLi).clone().prependTo('#files').removeAttr('id');
        var $img = $newFileListPage.find('span.img img');
        $img.attr('src','/img/portfolio/big/'+data.result.file_name);
        $newFileListPage.find('.preview-img img').attr('src','/img/portfolio/big/'+data.result.file_name);
        $img.imgAreaSelect({
          handles: true,
          minWidth: 220,
          minHeight: 220,
          x1: 0, y1: 0,
          x2: 220, y2: 220,
          onSelectChange: function(img, selection) {
            var heightWrap = selection.height * (220 / selection.width);

            $('.preview-img').css({
              height: Math.round(heightWrap) + 'px'
            });

            var scaleX = 220 / (selection.width || 1);
            var scaleY = heightWrap / (selection.height || 1);

            $('.preview-img img').css({
              width: Math.round(220 / (selection.width / img.width)) + 'px',
              marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
              marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
            });
          },
          onSelectEnd: function(img, selection){
            window.selectionCrop = {
              x1: selection.x1 / img.width,
              y1: selection.y1 / img.height,
              x2: selection.x2 / img.width,
              y2: selection.y2 / img.height
            };
          }
        });
        $newFileListPage.find('span.img .trash').attr('data-id',data.result.current_row_id);
        $newFileListPage.find('span.img .save').attr('data-id',data.result.current_row_id);
        $newFileListPage.find('.input-edit').attr('data-id',data.result.current_row_id);
        $newFileListPage.find('.select .drop').attr('data-id',data.result.current_row_id);

        $('#success').fadeIn('slow');
      }
    }
  });

  $(document).on('click', 'html', function(e){
    if ($(e.target).closest(".select").length) return;
    $('.drop').slideUp(200);
    $('.select .status-field-edit').hide();
    $('.slct').removeClass('active');
  });
  // Select

  $(document).on('click', '.slct',function(e){
    e.preventDefault();

    var dropBlock = $(this).parent().find('.drop');
    var $this = $(this);
    if( dropBlock.is(':hidden') ) {
      dropBlock.slideDown(200);
      $this.addClass('active');
      $this.next().find('.status-field-edit').show();
    } else {
      $this.removeClass('active');
      dropBlock.slideUp(200);
      $this.next().find('.status-field-edit').hide();
    }
  });

  /* Работаем с событием клика по элементам выпадающего списка */
  $(document).on('click','.drop li',function(){
    var $this = $(this),
      $parent = $this.parent(),
      $parentPrev = $parent.prev();

    $parentPrev.find('.status-field-edit').hide();
    var $save = $parentPrev.find('.status-field-save');
    $save.show();
    var $drop = $('.drop');
    $drop.find('li').removeClass('active');
    $this.addClass('active');
    var selectResult = $this.html();
    $parent.parent().find('.slct').removeClass('active').html(selectResult+'<i class="flaticon-chevron8"></i>');
    $drop.slideUp(200);

    var $id = $parent.attr('data-id');
    var $categoryLink = $this.text();
    var $dropLi = $('.drop li');
    $dropLi.prop('disabled', true);
    $.ajax({
      dataType : "html",
      type     : "POST",
      data     : 'id='+$id+'&category_link='+$categoryLink,
      url      : '/nimyadmin/portfolio.html',
      success  : function(data){
        $save.hide();
        $dropLi.prop('disabled', false);
      }
    });
  });

  var text;
  $(document).on('keypress','.input-edit',function(e){
    if(e.keyCode == 13) $(this).blur();
  });
  $(document).on('focus','.input-edit', function(){
    var $this = $(this);
    text = $this.val();
    $this.next().find('.status-field-edit').show();
  });
  $(document).on('blur','.input-edit', function(){
    $inputBlur($(this));
  });

  var $inputBlur = function($this_i){
    if (text !== $this_i.val()) {
      $this_i.prop('disabled', true);
      var $next = $this_i.next();
      $next.find('.status-field-edit').hide();
      $next.find('.status-field-save').show();
      var $id = $this_i.attr('data-id');
      var $title = $this_i.val();
      $.ajax({
        dataType : "html",
        type     : "POST",
        data     : 'id='+$id+'&title='+$title,
        url      : '/nimyadmin/portfolio.html',
        success  : function(data){
          $this_i.next().find('.status-field-save').hide();
          $this_i.prop('disabled', false);
        }
      });
    }
    $this_i.next().find('.status-field-edit').hide();
  };

  $(document).on('click','.trash', function(e){
    var $this = $(this);
    var $id = $this.attr('data-id');
    $this.prop('disabled', true);
    $.ajax({
      dataType : "html",
      type     : "POST",
      data     : 'id='+$id+'&trash=1',
      url      : '/nimyadmin/portfolio.html',
      success  : function(data){
        $this.prop('disabled', false);
        var $secondParent = $this.parent().parent();
        $secondParent.before('<li class="portfolio-trash">Работа удалена. <a href="#" class="no-trash" data-id="'+$id+'">Восстановить</a><a class="button close-no-trash" href="javascript:void(0);"><i class="flaticon-cross5"></i></a></li>');
        $secondParent.slideUp(200);
      }
    });
  });

  $(document).on('click','.save', function(e){
    var $this = $(this);
    var $id = $this.attr('data-id');
    $this.prop('disabled', true);

    console.log(selectionCrop);
    $.ajax({
      dataType : "html",
      type     : "POST",
      data     : {
        id: $id,
        x: selectionCrop.x1,
        y: selectionCrop.y1,
        width: selectionCrop.x2-selectionCrop.x1,
        height: selectionCrop.y2-selectionCrop.y1,
        crop_image: true
      },
      url      : '/nimyadmin/portfolio.html',
      success  : function(data){
        $this.prop('disabled', false);
        var $secondParent = $this.parent().parent();
        $secondParent.before('<li class="portfolio-trash">Работа удалена. <a href="#" class="no-trash" data-id="'+$id+'">Восстановить</a><a class="button close-no-trash" href="javascript:void(0);"><i class="flaticon-cross5"></i></a></li>');
        $secondParent.slideUp(200);
      },
      error : function(data){
        console.log(data);
      }
    });
  });

  $(document).on('click','.no-trash',function(e){
    e.preventDefault();
    var $this = $(this);
    $this.prop('disabled', true);
    var $id = $this.attr('data-id');
    $.ajax({
      dataType : "html",
      type     : "POST",
      data     : 'id='+$id+'&no_trash=1',
      url      : '/nimyadmin/portfolio.html',
      success  : function(data){
        $this.prop('disabled', false);
        var $parent = $this.parent();
        $parent.next().slideDown(200);
        $parent.remove();
      }
    });
  });

  $(document).on('click','.close-no-trash',function(e){
    e.preventDefault();
    var $parent = $(this).parent();
    $parent.next().remove();
    $parent.remove();
  });
});