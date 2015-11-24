var controller, Category;

controller = require('helpers/controller');

Category = (function() {

  var Category, $document;
  $document = $(document);

  Category = function() {
    this.sortable();
    this.editCategory();
    this.cancelEditCategory();
    this.saveEditCategory();
    this.addCategory();
    this.removeCategory();
  };

  Category.prototype.$catListTb = $('#cat-list-tb');

  Category.prototype.sortable = function() {
    this.$catListTb.sortable({
      placeholder: "ui-state-highlight",
      start: function(e, elem) {
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
        controller.call('nimyadmin/portfolio/sortable_category', data, callback);
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

  Category.prototype.saveEditCategory = function() {
    $document.on('click', '.save-edit-category', function(e) {
      var $this, $parent, $editForm, $secondParent, data, callback;
      e.preventDefault();
      $this = $(this);
      $parent = $this.parent();
      $editForm = $parent.parent().parent();
      $secondParent = $parent.prev();
      data = {
        id: $editForm.attr('data-id'),
        name: $secondParent.find('.tg-name').val(),
        desc: $secondParent.find('.tg-desc').val(),
        slug: $secondParent.find('.tg-slug').val()
      };
      callback = function(result) {
        var resultData;
        resultData = result.data;
        switch (resultData.error) {
          case 0:
            var $row = $editForm.prev();
            $row.find('.tg-name').text(data.name);
            $row.find('.tg-desc').text(data.desc);
            $row.find('.tg-slug').text(data.slug);
            $row.fadeIn(300);
            $editForm.remove();
            break;
          case 1:
            $editForm.find('.error').show().text('Неизвестная ошибка, попробуйте повторить попытку позже!');
            break;
          case 2:
            $editForm.find('.error').show().text('Название «' + data.name + '» уже используется другой категорией');
            break;
          case 3:
            $editForm.find('.error').show().text('Ярлык «' + data.slug + '» уже используется другой категорией');
            break;
        }
      };
      controller.call('nimyadmin/portfolio/save_category', data, callback);
    });
  };

  Category.prototype.addCategory = function() {
    var self;
    self = this;
    $document.on('click', '#add-category-portfolio', function(e) {
      var $this, $form, $inputName, $inputDesc, $inputSlug, data, callback;
      e.preventDefault();
      $this = $(this);
      $this.prop('disabled', true);
      $form = $('#addcat');
      $inputName = $form.find('#tag-name');
      $inputDesc = $form.find('#tag-description');
      $inputSlug = $form.find('#tag-slug');
      data = {
        name: $inputName.val(),
        desc: $inputDesc.val(),
        slug: $inputSlug.val()
      };
      callback = function(result) {
        var resultData, template, html, dataTemplate, $tr, trClass, trKey;
        resultData = result.data;
        $this.prop('disabled', false);
        switch (resultData.error) {
          case 0:
            $inputName.val('');
            $inputDesc.val('');
            $inputSlug.val('');
            dataTemplate = {
              id: resultData.result,
              name: data.name,
              desc: data.desc,
              slug: data.slug
            };
            template = require('admin/templates/portfolio/category/item.tpl');
            html = template.fetch(dataTemplate);
            self.$catListTb.prepend(html);
            $tr = self.$catListTb.find('tr');
            trClass = ['tg-4eph','tg-031e'];
            trKey = false;
            $tr.each(function() {
              var $this;
              trKey = !trKey;
              $this = $(this);
              $this.removeClass();
              $this.addClass(trClass[trKey ? 1 : 0]);
            });
            break;
          case 1:
            break;
          case 2:
            $form.find('.addcat-name .error').text('Название «' + data.name + '» уже используется другой категорией');
            break;
          case 3:
            $form.find('.addcat-slug .error').text('Ярлык «' + data.slug + '» уже используется другой категорией');
            break;
        }
      };
      controller.call('nimyadmin/portfolio/add_category', data, callback);
    });
  };

  Category.prototype.removeCategory = function() {
    var self, $modelWindow;
    self = this;
    $modelWindow = $('.model-delete-category');
    $modelWindow.dialog({
      autoOpen: false,
      draggable: false,
      resizable: false,
      modal: true,
      minWidth: 460,
      closeText: '<i class="flaticon-cross5"></i>'
    });
    $document.on('click', '.ui-widget-overlay', function(e) {
      $modelWindow.dialog("close");
    });
    //открытие модального окна удаления категории
    $document.on('click', '.delete-category', function(e) {
      var $deleteCategoryPortfolio, $this, $row, name, id, $modelWindowSpan,
        $modelWindowInput, $input;
      e.preventDefault();
      $deleteCategoryPortfolio = $('#delete-category-portfolio');
      $deleteCategoryPortfolio.prop('disabled', true);
      $this = $(this);
      $row = $this.parent().parent();
      name = $row.find('td.tg-name').text();
      id = $this.attr('data-id');
      $modelWindowSpan = $modelWindow.find('span.tg-name');
      $modelWindowInput = $modelWindow.find('#tag-id');
      $modelWindowSpan.text(name);
      $modelWindowInput.val(id);
      $input = $('#delete-category #tag-name');
      $input.focus().val('');
      $modelWindow.dialog("open");
      $document.off('keyup', '#delete-category .input-edit').on('keyup', '#delete-category .input-edit', function(e) {
        var $this;
        $this = $(this);
        $deleteCategoryPortfolio.prop('disabled', true);
        if ($this.val() === name) {
          $deleteCategoryPortfolio.prop('disabled', false);
        }
      });
    });
    $document.on('click', '#delete-category-portfolio', function(e) {
      var $this, $form, $inputId, id, data, callback;
      e.preventDefault();
      $this = $(this);
      $form = $this.parent().parent();
      $inputId = $form.find('#tag-id');
      $this.prop('disabled', true);
      data = {
        id: $inputId.val()
      };
      callback = function() {
        var $trDelete, $tr, trClass, trKey;
        $this.prop('disabled', false);
        $trDelete = self.$catListTb.find('tr[data-id='+data.id+']');
        $trDelete.remove();
        $tr = self.$catListTb.find('tr');
        trClass = ['tg-4eph','tg-031e'];
        trKey = false;
        $tr.each(function() {
          var $this;
          trKey = !trKey;
          $this = $(this);
          $this.removeClass();
          $this.addClass(trClass[trKey ? 1 : 0]);
        });
        $modelWindow.dialog( "close" );
      };
      controller.call('nimyadmin/portfolio/remove_category', data, callback);
    });
  };

  return Category;
})();

module.exports = new Category;