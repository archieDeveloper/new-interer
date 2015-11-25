var controller, Articles;

controller = require('helpers/controller');

Articles = (function() {

  var Articles, $document;
  $document = $(document);

  Articles = function() {
    this.edit();
    this.cancelEdit();
    this.save();
    this.toggleText();
  };

  Articles.prototype.edit = function() {
    $document.on('click', '.edit-art', function(e) {
      var $parent, title, date, text;
      e.preventDefault();
      $parent = $(this).parent().parent();
      $parent.find('.art-nav-1').hide();
      $parent.find('.art-nav-2').show();
      title = $parent.find('.title-art').hide().html();
      date = $parent.find('.date-art').hide().attr('data-date');
      $parent.find('.text-art').hide();
      $parent.find('.text-art .fulltext-art').html() == null 
        ? text = $parent.find('.text-art .desc-art').html()
        : text = $parent.find('.text-art .desc-art').html() + '<!--more-->' + $parent.find('.text-art .fulltext-art').html();
      $parent.find('.edit-title-art').show().find('.input-edit').val(title);
      $parent.find('.edit-date-art').show().find('.input-edit').val(date);
      $parent.find('.edit-text-art').show().find('.input-edit').val(text);
    });
  };

  Articles.prototype.cancelEdit = function() {
    $document.on('click', '.no-edit-art', function(e) {
      var $parent;
      e.preventDefault();
      $parent = $(this).parent().parent();
      $parent.find('.art-nav-1').show();
      $parent.find('.art-nav-2').hide();
      $parent.find('.title-art').show();
      $parent.find('.date-art').show();
      $parent.find('.text-art').show();
      $parent.find('.edit-title-art').hide().val('');
      $parent.find('.edit-date-art').hide().val('');
      $parent.find('.edit-text-art').hide().val('');
    });
  };

  Articles.prototype.save = function() {
    $document.on('click', '.save-edit-art', function(e) {
      var $parent, data, callback;
      e.preventDefault();
      $parent = $(this).parent().parent();
      data = {
        id: $(this).attr('data-id'),
        title: $parent.find('.edit-title-art .input-edit').val(),
        date: $parent.find('.edit-date-art .input-edit').val(),
        text: $parent.find('.edit-text-art .input-edit').val()
      };
      callback = function(result) {
        $parent.find('.art-nav-1').show();
        $parent.find('.art-nav-2').hide();
        $parent.find('.title-art').show().html(result.title);
        $parent.find('.date-art').show().html(result.date_rus).attr('data-date', result.date);
        $parent.find('.text-art').show().find('.desc-art').html(result.text);
        $parent.find('.edit-title-art').hide().val('');
        $parent.find('.edit-date-art').hide().val('');
        $parent.find('.edit-text-art').hide().val('');
      };
      controller.call('nimyadmin/articles/save', data, callback);
    });
  };

  Articles.prototype.toggleText = function() {
    $document.on('click', '.show-all-text', function(e) {
      var $this;
      e.preventDefault();
      $this = $(this);
      $this.hide();
      $this.next().show();
    });
    $document.on('click', '.hide-all-text', function(e) {
      var $parent;
      e.preventDefault();
      $parent = $(this).parent();
      $parent.prev().show();
      $parent.hide();
    });
  };

  Articles.prototype.remove = function() {
    $document.on('click', '.del-art', function(e) {
      var $this, data, callback;
      e.preventDefault();
      $this = $(this);
      $this.prop('disabled', true);
      data = {
        id: $this.attr('data-id')
      };
      callback = function(result) {
        var $secondParent;
        $this.prop('disabled', false);
        $secondParent = $this.parent().parent();
        $secondParent.before(
          '<li class="news-trash">' +
            'Статья удалена.' +
            '<a href="#" class="no-trash" data-id="'+$id+'">Восстановить</a>' +
            '<a class="button close-no-trash" href="#"><i class="flaticon-cross5"></i></a>' +
          '</li>'
        );
        $secondParent.slideUp(200);
      };
      controller.call('nimyadmin/articles/remove', data, callback);
    });
  };

  Articles.prototype.restore = function() {
    $document.on('click', '.no-trash',function(e) {
      var $this, data, callback;
      e.preventDefault();
      $this = $(this);
      $this.prop('disabled', true);
      data = {
        id: $this.attr('data-id')
      };
      callback = function() {
        var $parent;
        $this.prop('disabled', false);
        $parent = $this.parent();
        $parent.next().slideDown(200);
        $parent.remove();
      }
      controller.call('nimyadmin/articles/restore', data, callback);
    });
    $document.on('click', '.close-no-trash',function(e) {
      var $parent;
      e.preventDefault();
      $parent = $(this).parent();
      $parent.next().remove();
      $parent.remove();
    });
  };

  Articles.prototype.create = function() {
    $document.on('click', '.btn-publised-new', function(e) {
      var data, callback;
      e.preventDefault();
      data = {
        title: $('#title-new').val(),
        date: $('#date-new').val(),
        text: $('#text-new').val()
      };
      callback = function(result) {
        var $elem;
        $elem = $('.ajax-pre li').last().prependTo('.ajax-pre');
        $elem.find('.title-art').html(result.title);
        $elem.find('.date-art').html(result.date);
        $elem.find('.text-art').html(result.text);
        $elem.find('.edit-art').attr('data-id',result.id);
        $elem.find('.del-art').attr('data-id',result.id);
        $('#title-new').val('');
        $('#date-new').val('');
        $('#text-new').val('');
      };
      controller.call('nimyadmin/articles/create', data, callback);
    });
  }

  return Articles;
})();

module.exports = new Articles;
