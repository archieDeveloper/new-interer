var controller = require('helpers/controller');

var Portfolio = (function() {

  var Portfolio, $document, text, inputBlur;
  $document = $(document);
  inputBlur = function($this_i) {
    var $next, callback, data;
    if (text !== $this_i.val()) {
      $this_i.prop('disabled', true);
      $next = $this_i.next();
      $next.find('.status-field-edit').hide();
      $next.find('.status-field-save').show();
      data = {
        id: $this_i.attr('data-id'),
        title: $this_i.val()
      };
      callback = function () {
        $this_i.next().find('.status-field-save').hide();
        $this_i.prop('disabled', false);
      };
      controller.call('nimyadmin/portfolio/title', data, callback);
    }
    $this_i.next().find('.status-field-edit').hide();
  };

  Portfolio = function() {
    this.trash();
    this.title();
    this.category();
  };

  Portfolio.prototype.trash = function() {
    $document.on('click', '.trash', function(e) {
      e.preventDefault();
      var $this, id, callback, data;
      $this = $(this);
      id = $this.attr('data-id');
      $this.prop('disabled', true);
      data = {
        id: id
      };
      callback = function(result) {
        $this.prop('disabled', false);
        var $secondParent = $this.parent().parent();
        $secondParent.before(result.html);
        $secondParent.slideUp(200);
      };
      controller.call('nimyadmin/portfolio/trash', data, callback);
    });
  };

  Portfolio.prototype.title = function() {
    $document.on('keypress', '.input-edit', function(e) {
      if(e.keyCode == 13) $(this).blur();
    });
    $document.on('focus', '.input-edit', function() {
      var $this;
      $this = $(this);
      text = $this.val();
      $this.next().find('.status-field-edit').show();
    });
    $document.on('blur', '.input-edit', function() {
      inputBlur($(this));
    });
  };

  Portfolio.prototype.category = function() {
    $document.on('click', '.slct', function(e) {
      var dropBlock, $this;
      e.preventDefault();
      $this = $(this);
      dropBlock = $this.parent().find('.drop');
      if( dropBlock.is(':hidden') ) {
        dropBlock.slideDown(200);
        $this.addClass('active');
        $this.next().find('.status-field-edit').show();
      } else {
        dropBlock.slideUp(200);
        $this.removeClass('active');
        $this.next().find('.status-field-edit').hide();
      }
    });
    $document.on('click', '.drop li', function() {
      var $this, $parent, $parentPrev, $save, $drop, selectResult, $dropLi, data, callback;
      $this = $(this);
      $parent = $this.parent();
      $parentPrev = $parent.prev();
      $parentPrev.find('.status-field-edit').hide();
      $save = $parentPrev.find('.status-field-save');
      $save.show();
      $drop = $('.drop');
      $drop.find('li').removeClass('active');
      $this.addClass('active');
      selectResult = $this.html();
      $parent.parent().find('.slct').removeClass('active').html(selectResult+'<i class="flaticon-chevron8"></i>');
      $drop.slideUp(200);
      $dropLi = $('.drop li');
      $dropLi.prop('disabled', true);
      data = {
        id: $parent.attr('data-id'),
        category_link: $this.text()
      };
      callback = function() {
        $save.hide();
        $dropLi.prop('disabled', false);
      };
      controller.call('nimyadmin/portfolio/category', data, callback);
    });
  };

  return Portfolio;
})();

module.exports = new Portfolio;