$(document).ready(function(){
  'use strict';
  var $listPageLi = $('#js-list-page');
  var $listPageLi2 = $('#js-list-page2');

  window.arrSelections = null;

  window.listData1 = null;
  window.listData2 = null;

  window.crop = {
    one: {
      elem: $listPageLi,
      data: null,
      img: $listPageLi.find('.img img'),
      imgSrc: null,
      imgPreview: $listPageLi.find('.preview-img img'),
      imgPreviewScr: null,
      selection: null
    },
    two: {
      elem: $listPageLi2,
      data: null,
      img: $listPageLi2.find('.img img'),
      imgSrc: null,
      imgPreview: $listPageLi2.find('.preview-img img'),
      imgPreviewScr: null,
      selection: null
    }
  };

  var reviewPreview = function(img, selection) {
    var heightWrap = selection.height * (220 / selection.width);

    window.crop.one.elem.find('.preview-img').css({
      height: Math.round(heightWrap) + 'px'
    });

    window.crop.two.elem.find('.preview-img').css({
      height: Math.round(heightWrap) + 'px'
    });

    var scaleX = 220 / (selection.width || 1);
    var scaleY = heightWrap / (selection.height || 1);

    window.crop.one.imgPreview.css({
      width: Math.round(220 / (selection.width / img.width)) + 'px',
      marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
      marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
    });
    window.crop.two.imgPreview.find('.preview-img img').css({
      width: Math.round(220 / (selection.width / img.width)) + 'px',
      marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
      marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
    });
  };

  var imgSelect = function($page, data, folder, callback){
    var $img = $page.find('.img img'),
      $img_preview = $page.find('.preview-img img');
    if(window.arrSelections != null){
      window.arrSelections.cancelSelection();
    }
    console.log($img);

    $img.load(function() {
      $img_preview.load(function(){
        $modelWindow.dialog( "close" );
        $modelWindow.dialog( "open" );

        var kWidth = $img.width() / data.image_width;
        var kHeight = $img.height() / data.image_height;

        window.arrSelections = $img.imgAreaSelect({
          instance: true,
          handles: true,
          minWidth: 217*kWidth,
          minHeight: 217*kHeight,
          x1: 0, y1: 0,
          x2: 217*kWidth, y2: 217*kHeight,
          zIndex: 101,
          onInit: reviewPreview,
          onSelectChange: reviewPreview,
          onSelectStart: reviewPreview,
          onSelectEnd: function(img, selection){
            /*window.selectionCrop = {
              x1: selection.x1 / img.width,
              y1: selection.y1 / img.height,
              x2: selection.x2 / img.width,
              y2: selection.y2 / img.height
            };*/
          }
        });
        if (typeof callback === 'function') {
          callback();
        }
        $img_preview.unbind('load');
      }).attr('src','/img/portfolio/'+folder+'/'+data.file_name+'?'+Math.random());

      $img.unbind('load');
    }).attr('src','/img/portfolio/'+folder+'/'+data.file_name+'?'+Math.random());

  };

  $('#fileupload').fileupload({
    dataType: 'json',
    formData: {type: 'portfolio'},
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $('.progress .bar').css('width', progress + '%');
    },
    error: function(e, data){
      if (data === 'parsererror') {
        var $error = $('#error');
        $error.html('<b class="float">Ошибка: </b>'+data);
        $error.fadeIn('slow');
      }
    },
    done: function (e, data) {
      var $error = $('#error');
      if(data.result.error != undefined){
        $error.html('<b class="float">Ошибка: </b>'+data.result.error);
        $error.fadeIn('slow');
      } else {

        $listPageLi.show();
        $listPageLi2.hide();

        $error.hide();

        window.listData1 = data.result;
        imgSelect($listPageLi, data.result, 'big');

        $listPageLi.find('.buttons .save-first').attr('data-id',data.result.current_row_id);

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

  $(document).on('click', '.edit-img', function(){
    $listPageLi.show();

    window.listData1 = data.result;
    imgSelect($listPageLi, data.result, 'big');

    $listPageLi.find('.buttons .save-first').attr('data-id',data.result.current_row_id);

    $('#success').fadeIn('slow');
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

  $(document).on('click','.save', function(e){
    var $this = $(this);
    var $id = $this.attr('data-id');
    $this.prop('disabled', true);

    var selectionCrop = window.arrSelections.getSelection();
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

  //добавление работы, работа с миниатюрками

  var $modelWindow = $('.model-delete-category');

  $modelWindow.dialog({
    autoOpen: false,
    draggable: false,
    resizable: false,
    modal: true,
    width: 'auto',
    closeText: '<i class="flaticon-cross5"></i>',
    close: function(){
        if(window.arrSelections != null){
            window.arrSelections.cancelSelection();
        }
    }
  });

  //сохранить и продолжить
  $(document).on('click','.save-first', function(e){
    var $this = $(this);
    var $id = $this.attr('data-id');
    $this.prop('disabled', true);
    var selectionCrop = window.arrSelections.getSelection();
    var width = $listPageLi.find('.img img').width();
    var height = $listPageLi.find('.img img').height();
    $.ajax({
      dataType : "json",
      type     : "POST",
      data     : {
        id: $id,
        x: selectionCrop.x1 / width,
        y: selectionCrop.y1 / height,
        width: (selectionCrop.x2-selectionCrop.x1) / width,
        height: (selectionCrop.y2-selectionCrop.y1) / height,
        crop_image: true
      },
      url      : '/nimyadmin/portfolio.html',
      success  : function(data){
        $this.prop('disabled', false);
        window.oneSelect = window.arrSelections.getSelection();

        console.log($id);

        $listPageLi.hide();
        $listPageLi2.show();

        $listPageLi2.find('#title-portfolio').attr('data-id',$id);
        $listPageLi2.find('#category-portfolio').attr('data-id',$id);
        $listPageLi2.find('#trash-portfolio').attr('data-id',$id);

        $modelWindow.dialog('option', 'title', 'Настройки');

        imgSelect($listPageLi2, data, 'small');
      },
      error : function(data){
        console.log(data);
      }
    });
  });

  //вернуться назад
  $(document).on('click','.back2', function(e){

    $listPageLi.show();
    $listPageLi2.hide();
    imgSelect($listPageLi, window.listData1, 'big', function(){
      window.arrSelections.setSelection(window.oneSelect.x1,window.oneSelect.y1,window.oneSelect.x2,window.oneSelect.y2);
      window.arrSelections.update();
    });

    $modelWindow.dialog('option', 'title', 'Выбор фотографии');
    //$imgAreaSelect.cancelSelection();
  });

  //сохранить
  $(document).on('click','.close', function(e){
    $modelWindow.dialog( "close" );
  });
});