$(document).ready(function(){
  //таблица категорий
  var $catListTb = $("#cat-list-tb");

  //сортировка катигорий
  $catListTb.sortable({
    placeholder: "ui-state-highlight",
    start: function(e,elem){
      var $item = $(elem.item);
      $item.css({'display':'inline-table'});
    },
    stop: function(e,elem){
      var $item = $(elem.item);
      $item.removeAttr('style');
      var $tr = $(this).find('tr');
      var arrayMenu = [];
      var trClass = ['tg-4eph','tg-031e'],
          trKey = false;
      $tr.each(function(){
        trKey = !trKey;
        $(this).removeClass();
        $(this).addClass(trClass[trKey ? 1 : 0]);
        arrayMenu.push($(this).attr('data-id'));
      });
      console.log(arrayMenu);
      $.ajax({
        dataType : "html",
        type     : "POST",
        data     : {
          'data_id': arrayMenu
        },
        url      : '/nimyadmin/portfolio.html',
        success  : function(data){
          console.log(data);
        },
        error : function(data){
          console.log(data.responseText);
        }
      });
    }
  });

  //редактирование категорий
  $(document).on('click','.edit-category',function(e){
    e.preventDefault();

    $catListTb.find('.cancel-edit-category').click();
    $catListTb.sortable('disable');

    var $secondParent = $(this).parent().parent();

    var $id = $secondParent.attr('data-id'),
      $name = $secondParent.find('.tg-name').text(),
      $desc = $secondParent.find('.tg-desc').text(),
      $slug = $secondParent.find('.tg-slug').text();
    $secondParent.hide();
    $secondParent.after(
      '<tr class="tg-jh46" data-id="'+$id+'">'+
        '<td colspan="6" class="colspanchange">'+
          '<fieldset>'+
            '<div class="inline-edit-col">'+
              '<h4>Свойства</h4>'+
              '<label>'+
                '<span class="title">Название</span>'+
                '<span class="input-text-wrap"><input type="text" name="name" class="ptitle input-edit tg-name" value="'+$name+'"></span>'+
              '</label>'+
              '<label>'+
                '<span class="title">Описание</span>'+
                '<span class="input-text-wrap"><input type="text" name="desc" class="ptitle input-edit tg-desc" value="'+$desc+'"></span>'+
              '</label>'+
              '<label>'+
                '<span class="title">Ярлык</span>'+
                '<span class="input-text-wrap"><input type="text" name="slug" class="ptitle input-edit tg-slug" value="'+$slug+'"></span>'+
              '</label>'+
            '</div>'+
          '</fieldset>'+
          '<p class="inline-edit-save submit">'+
            '<a href="#inline-edit" class="button cancel-edit-category right green"><i class="flaticon-cross5"></i> Отменить</a>'+
            '<a href="#inline-edit" class="button save-edit-category left blue"><i class="flaticon-checkmark2"></i> Обновить категорию</a>'+
            '<span class="error" style="display:none;"></span>'+
          '</p>'+
        '</td>'+
      '</tr>');
  });

  //отмена редактирования категории
  $(document).on('click','.cancel-edit-category',function(e){
    e.preventDefault();
    $catListTb.sortable('enable');
    var $editForm = $(this).parent().parent().parent();
    $editForm.prev().show();
    $editForm.remove();
  });

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

  //удаление категории
  $(document).on('click','.delete-category',function(e){
    e.preventDefault();
    var $deleteCategoryPortfolio = $('#delete-category-portfolio');
    $deleteCategoryPortfolio.prop('disabled', true);
    var $this = $(this),
      $row = $this.parent().parent();

    var name = $row.find('td.tg-name').text();

    var $modelWindowSpan = $modelWindow.find('span.tg-name');
    $modelWindowSpan.text(name);


    var $input = $('#delete-category .input-edit');
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
                                '<a class="button" href="#"><i class="flaticon-trash3"></i></a>'+
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