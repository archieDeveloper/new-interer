$(document).ready(function(){

  $(document).on('click', '.edit-art', function(e){
    e.preventDefault();
    var $parent = $(this).parent().parent();
    $parent.find('.art-nav-1').hide();
    $parent.find('.art-nav-2').show();
    var title = $parent.find('.title-art').hide().html();
    var date = $parent.find('.date-art').hide().attr('data-date');
    $parent.find('.text-art').hide();

    var text;
    $parent.find('.text-art .fulltext-art').html() == null ? text = $parent.find('.text-art .desc-art').html() : text = $parent.find('.text-art .desc-art').html()+'<!--more-->'+$parent.find('.text-art .fulltext-art').html();

    $parent.find('.edit-title-art').show().find('.input-edit').val(title);
    $parent.find('.edit-date-art').show().find('.input-edit').val(date);
    $parent.find('.edit-text-art').show().find('.input-edit').val(text);
  });

  $(document).on('click', '.no-edit-art', function(e){
    e.preventDefault();
    var $parent = $(this).parent().parent();
    $parent.find('.art-nav-1').show();
    $parent.find('.art-nav-2').hide();

    $parent.find('.title-art').show();
    $parent.find('.date-art').show();
    $parent.find('.text-art').show();

    $parent.find('.edit-title-art').hide().val('');
    $parent.find('.edit-date-art').hide().val('');
    $parent.find('.edit-text-art').hide().val('');
  });

  $(document).on('click', '.save-edit-art', function(e){
    e.preventDefault();
    var $parent = $(this).parent().parent();
    var id = $(this).attr('data-id');
    var title = $parent.find('.edit-title-art .input-edit').val();
    var date = $parent.find('.edit-date-art .input-edit').val();
    var text = $parent.find('.edit-text-art .input-edit').val();

    $.ajax({
      dataType : "json",
      type     : "POST",
      data     : 'id='+id+'&title='+title+'&date='+date+'&text='+text+'&action=edit',
      url      : '/nimyadmin/articles.html',
      success  : function(data){
        console.log(data);

        $parent.find('.art-nav-1').show();
        $parent.find('.art-nav-2').hide();

        $parent.find('.title-art').show().html(data.title);
        $parent.find('.date-art').show().html(data.date_rus).attr('data-date', data.date);
        $parent.find('.text-art').show().find('.desc-art').html(data.text);

        $parent.find('.edit-title-art').hide().val('');
        $parent.find('.edit-date-art').hide().val('');
        $parent.find('.edit-text-art').hide().val('');
      }
    });
  });

  $(document).on('click', '.show-all-text', function(e){
    e.preventDefault();
    var $this = $(this);
    $this.hide();
    $this.next().show();
  });

  $(document).on('click', '.hide-all-text', function(e){
    e.preventDefault();
    var $parent = $(this).parent();
    $parent.prev().show();
    $parent.hide();
  });

  $(document).on('click', '.btn-publised-new', function(e){
    e.preventDefault();
    var title = $('#title-new').val();
    var date = $('#date-new').val();
    var text = $('#text-new').val();
    $.ajax({
      dataType : "json",
      type     : "POST",
      data     : 'title='+title+'&date='+date+'&text='+text+'&action=add',
      url      : '/nimyadmin/articles.html',
      success  : function(data){
        console.log(data);
        var $elem = $('.ajax-pre li').last().prependTo('.ajax-pre');
        $elem.find('.title-art').html(data.title);
        $elem.find('.date-art').html(data.date);
        $elem.find('.text-art').html(data.text);
        $elem.find('.edit-art').attr('data-id',data.id);
        $elem.find('.del-art').attr('data-id',data.id);
        $btnAddP.show();
        $newArtBox.slideUp(200);

        $('#title-new').val('');
        $('#date-new').val('');
        $('#text-new').val('');
      }
    });
  });

  $(document).on('click','.del-art', function(e){
    e.preventDefault();
    var $_this = $(this);
    var $id = $_this.attr('data-id');
    $_this.prop('disabled', true);
    $.ajax({
      dataType : "html",
      type     : "POST",
      data     : 'id='+$id+'&trash=1',
      url      : '/nimyadmin/articles.html',
      success  : function(data){
        $_this.prop('disabled', false);
        var $secondParent = $_this.parent().parent();
        $secondParent.before('<li class="news-trash">Статья удалена. <a href="#" class="no-trash" data-id="'+$id+'">Восстановить</a><a class="button close-no-trash" href="javascript:void(0);"><i class="flaticon-cross5"></i></a></li>');
        $secondParent.slideUp(200);
      }
    });
  });

  $(document).on('click','.no-trash',function(e){
    e.preventDefault();
    var $_this = $(this);
    $_this.prop('disabled', true);
    var $id = $_this.attr('data-id');
    $.ajax({
      dataType : "html",
      type     : "POST",
      data     : 'id='+$id+'&no_trash=1',
      url      : '/nimyadmin/articles.html',
      success  : function(data){
        $_this.prop('disabled', false);
        var $parent = $_this.parent();
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