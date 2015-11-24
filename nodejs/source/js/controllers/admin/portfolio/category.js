var controller, view, Category;

controller = require('helpers/controller');
view = require('helpers/view');

Category = (function() {

  var Category, $document;
  $document = $(document);

  Category = function() {
    this.sortable();
    this.editCategory();
    this.cancelEditCategory();
  };

  Category.prototype.$catListTb = $('#cat-list-tb');

  Category.prototype.sortable = function() {
    this.$catListTb.sortable({
      placeholder: "ui-state-highlight",
      start: function(e,elem) {
        var $item;
        $item = $(elem.item);
        $item.css({display:'inline-table'});
      },
      stop: function(e,elem) {
        var $item, $tr, arrayMenu, trClass, trKey, data, callback;
        $item = $(elem.item);
        $item.removeAttr('style');
        $tr = $(this).find('tr');
        arrayMenu = [];
        trClass = ['tg-4eph','tg-031e'];
        trKey = false;
        $tr.each(function(){
          var $this;
          $this = $(this);
          trKey = !trKey;
          $this.removeClass();
          $this.addClass(trClass[trKey ? 1 : 0]);
          arrayMenu.push($this.attr('data-id'));
        });
        data = {
          data_id: arrayMenu
        };
        callback = function() {

        };
        controller.call('nimyadmin/portfolio/sortable', data, callback);
      }
    });
  };

  Category.prototype.editCategory = function() {
    var self;
    self = this;
    $document.on('click', '.edit-category', function(e) {
      var $secondParent, $this, data, template, html;
      e.preventDefault();
      $this = $(this);
      self.$catListTb.sortable('disable');
      $secondParent = $this.parent().parent();
      data = {
        id: $secondParent.attr('data-id'),
        name: $secondParent.find('.tg-name').text(),
        desc: $secondParent.find('.tg-desc').text(),
        slug: $secondParent.find('.tg-slug').text()
      };
      template = require('admin/templates/portfolio/category/edit.tpl');
      html = template.fetch(data);
      self.$catListTb.find('.cancel-edit-category').click();
      $secondParent.hide();
      $secondParent.after(html);
      //view.render('admin/templates/portfolio/category/edit', data, callback);
    });
  };

  Category.prototype.cancelEditCategory = function() {
    var self;
    self = this;
    $document.on('click', '.cancel-edit-category', function(e){
      var $editForm;
      e.preventDefault();
      self.$catListTb.sortable('enable');
      $editForm = $(this).parent().parent().parent();
      $editForm.prev().show();
      $editForm.remove();
    });
  };

  return Category;
})();

module.exports = new Category;


$(document).ready(function(){
  "use strict";

  //отмена редактирования категории

  //сохранение редактирования категории
  $(document).on('click','.save-edit-category',function(e){
    e.preventDefault();
    var $this = $(this);
    var $parent = $this.parent();
    var $editForm = $parent.parent().parent();

    var $secondParent = $parent.prev();

    var $id = $editForm.attr('data-id'),
      $nameElem = $secondParent.find('.tg-name'),
      $descElem = $secondParent.find('.tg-desc'),
      $slugElem = $secondParent.find('.tg-slug');

    var $name = $nameElem.val(),
      $desc = $descElem.val(),
      $slug = $slugElem.val();
    $.ajax({
      dataType : "json",
      type     : "POST",
      data     : {
        id: $id,
        name: $name,
        desc: $desc,
        slug: $slug,
        update_category_portfolio: true
      },
      url      : '/nimyadmin/portfolio.html',
      success  : function(data){
        switch (data.error) {
          case 0:
            var $row = $editForm.prev();
            $row.find('.tg-name').text($name);
            $row.find('.tg-desc').text($desc);
            $row.find('.tg-slug').text($slug);

            $row.fadeIn(300);
            $editForm.remove();
            break;
          case 1:
            $editForm.find('.error').show().text('Неизвестная ошибка, попробуйте повторить попытку позже!');
            break;
          case 2:
            $editForm.find('.error').show().text('Название «'+$name+'» уже используется другой категорией');
            break;
          case 3:
            $editForm.find('.error').show().text('Ярлык «'+$slug+'» уже используется другой категорией');
            break;
        }
        console.log(data);
      },
      error    : function(data) {
        console.log(data);
      }
    });
  });

  var $modelWindow = $('.model-delete-category');

  $modelWindow.dialog({
    autoOpen: false,
    draggable: false,
    resizable: false,
    modal: true,
    minWidth: 460,
    closeText: '<i class="flaticon-cross5"></i>'
  });

  $(document).on('click','.ui-widget-overlay',function(e){
    $modelWindow.dialog( "close" );
  });

  //открытие модального окна удаления категории
  $(document).on('click','.delete-category',function(e){
    e.preventDefault();
    var $deleteCategoryPortfolio = $('#delete-category-portfolio');
    $deleteCategoryPortfolio.prop('disabled', true);
    var $this = $(this),
      $row = $this.parent().parent();

    var name = $row.find('td.tg-name').text(),
      id = $this.attr('data-id');

    var $modelWindowSpan = $modelWindow.find('span.tg-name'),
      $modelWindowInput = $modelWindow.find('#tag-id');
    $modelWindowSpan.text(name);
    $modelWindowInput.val(id);

    var $input = $('#delete-category #tag-name');
    $input.focus().val('');
    $modelWindow.dialog( "open" );

    $(document).off('keyup', '#delete-category .input-edit').on('keyup','#delete-category .input-edit',function(e){
      var $this = $(this);
      $deleteCategoryPortfolio.prop('disabled', true);
      if ($this.val() === name) {
        $deleteCategoryPortfolio.prop('disabled', false);
      }
    });
  });

  //удаление категории
  $(document).on('click','#delete-category-portfolio',function(e){
    e.preventDefault();

    var $this = $(this),
      $form = $this.parent().parent(),
      $inputId = $form.find('#tag-id');

    $this.prop('disabled', true);

    var id = $inputId.val();

    $.ajax({
      dataType : "json",
      type     : "POST",
      data     : {
        id: id,
        delete_category_portfolio: true
      },
      url      : '/nimyadmin/portfolio.html',
      success  : function(data){
        $this.prop('disabled', false);

        var $table = $('#cat-list-tb');

        var $trDelete = $table.find('tr[data-id='+id+']');
        $trDelete.remove();

        var $tr = $table.find('tr');
        var trClass = ['tg-4eph','tg-031e'],
          trKey = false;
        $tr.each(function(){
          trKey = !trKey;
          var $this = $(this);
          $this.removeClass();
          $this.addClass(trClass[trKey ? 1 : 0]);
        });
        $modelWindow.dialog( "close" );
      },
      error: function(data) {
        console.log(data);
      }
    });
  });

  //добавление категории
  $(document).on('click','#add-category-portfolio',function(e){
    e.preventDefault();
    var $this = $(this);
    $this.prop('disabled', true);

    var $form = $('#addcat');

    var $inputName = $form.find('#tag-name'),
      $inputDesc = $form.find('#tag-description'),
      $inputSlug = $form.find('#tag-slug');

    var $name = $inputName.val(),
      $desc = $inputDesc.val(),
      $slug = $inputSlug.val();

    $.ajax({
      dataType : "json",
      type     : "POST",
      data     : {
        name: $name,
        desc: $desc,
        slug: $slug,
        add_category_portfolio: true
      },
      url      : '/nimyadmin/portfolio.html',
      success  : function(data){
        $this.prop('disabled', false);
        switch (data.error) {
          case 0:
            $inputName.val('');
            $inputDesc.val('');
            $inputSlug.val('');

            var $catListTb = $('#cat-list-tb');

            $catListTb.prepend('<tr class="tg-031e" data-id="'+data.result+'">'+
                                '<td class="tg-checkbox"><input type="checkbox" name="selected[]" value="'+data.result+'"></td>'+
                                '<td class="tg-name">'+$name+'</td>'+
                                '<td class="tg-desc">'+$desc+'</td>'+
                                '<td class="tg-slug">'+$slug+'</td>'+
                                '<td class="tg-num">0</td>'+
                                '<td class="tg-tools">'+
                                '<a class="button blue edit-category" href="#" data-id="'+data.result+'"><i class="flaticon-edit4"></i></a>'+
                                '<a class="button delete-category" href="#" data-id="'+data.result+'"><i class="flaticon-trash3"></i></a>'+
                                '</td>'+
                              '</tr>');

            var $tr = $catListTb.find('tr');
            var trClass = ['tg-4eph','tg-031e'],
              trKey = false;
            $tr.each(function(){
              trKey = !trKey;
              var $this = $(this);
              $this.removeClass();
              $this.addClass(trClass[trKey ? 1 : 0]);
            });
            break;
          case 1:
            break;
          case 2:
            var $errorField = $('#addcat .addcat-name .error');
            $errorField.text('Название «'+$name+'» уже используется другой категорией');
            break;
          case 3:
            var $errorField = $('#addcat .addcat-slug .error');
            $errorField.text('Ярлык «'+$slug+'» уже используется другой категорией');
            break;
        }
        console.log(data);
      },
      error: function(data) {
        console.log(data);
      }
    });
  });
});