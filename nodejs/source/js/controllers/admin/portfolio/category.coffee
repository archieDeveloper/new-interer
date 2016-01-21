controller = require 'helpers/controller'
Window = require 'helpers/window'

class Category

  constructor: ()->
    @$catListTb = $ '#cat-list-tb'
    templateWindowDeleteCategory = require 'admin/templates/window/portfolio/category/remove.tpl'
    @$helperWindowDeleteCategory = new Window({
      template: templateWindowDeleteCategory,
      buttons: {
        remove: ->
          console.log('remove category')
      },
      data: {

      }
    })
    @sortable @$catListTb
    do @initEvent

  initEvent: ->
    @$catListTb.on 'portfolioCategoryEdit', @disableSortable
    @$catListTb.on 'portfolioCategoryCancelEdit', @enableSortable

    @$catListTb.on 'click', '.js-button-edit', @editCategory
    @$catListTb.on 'click', '.js-button-cancel-edit', @cancelEditCategory
    @$catListTb.on 'click', '.js-button-save', @saveEditCategory
    @$catListTb.on 'click', '.js-button-remove', @openWindowRemoveCategory

    $windowDeleteCategory = do @$helperWindowDeleteCategory.get
    $windowDeleteCategory.on 'click', '#delete-category-portfolio', @removeCategory

    $form = $ '.js-category-add-form'
    $form.on 'portfolioCategoryAdd', @addCategory

  # Включить сортировку списка
  enableSortable: ->
    $(@).sortable 'enable'

  # Выключить сортировку списка
  disableSortable: ->
    $catListTb = $(@)
    $buttonCancelEdit = $catListTb.find('.js-button-cancel-edit')
    do $buttonCancelEdit.click
    $catListTb.sortable 'disable'

  # Сортировка списка категорий
  sortable: (sortableElement)->
    sortableElement.sortable(
      placeholder: "ui-state-highlight",
      start: (e, elem) ->
        $item = $ elem.item
        $item.css display:'inline-table'
      stop: (e, elem) ->
        $item = $ elem.item
        $item.removeAttr 'style'
        $tr = $(@).find 'tr'
        arrayMenu = []
        trClass = ['tg-4eph', 'tg-031e']
        trKey = false
        $tr.each(->
          $this = $(@)
          trKey = !trKey
          $this.removeClass('tg-4eph')
          $this.removeClass('tg-031e')
          $this.addClass trClass[if trKey then 1 else 0]
          arrayMenu.push $this.attr 'data-id'
        )
        data = 
          data_id: arrayMenu
        controller.call 'nimyadmin/portfolio/sortable_category', data, ->
    )

  # Редактировать категорию
  editCategory: (e)->
    do e.preventDefault
    $buttonCategoryEdit = $ @
    $categoryItem = $buttonCategoryEdit.parents('.js-category-item')
    $categoryItem.trigger('portfolioCategoryEdit')
    data =
      id: $categoryItem.attr('data-id'),
      name: $categoryItem.find('.js-name').text(),
      desc: $categoryItem.find('.js-description').text(),
      slug: $categoryItem.find('.js-slug').text()
    template = require 'admin/templates/portfolio/category/edit.tpl'
    html = template.fetch data
    $categoryItem.hide()
    $categoryItem.after html

  # Отменить редактирование категории
  cancelEditCategory: (e)->
    do e.preventDefault
    $buttonCancelEdit = $ @
    $buttonCancelEdit.trigger('portfolioCategoryCancelEdit')
    $editForm = $buttonCancelEdit.parents('.js-edit-form')
    $categoryItem = $buttonCancelEdit
      .parents('#cat-list-tb')
      .find('.js-category-item[data-id=' + $editForm.attr('data-id') + ']')
    $categoryItem.show()
    $editForm.remove()

  # Сохранить редактируемую категорию
  saveEditCategory: (e)->
    do e.preventDefault
    $buttonSave = $ @
    $tools = $buttonSave.parents('.js-tools')
    $editForm = $tools.parents('.js-edit-form')
    $categoryItem = $buttonSave.parents('#cat-list-tb').find('.js-category-item[data-id=' + $editForm.attr('data-id') + ']')
    $fieldSet = $editForm.find('.js-fieldset')
    data =
      id: $editForm.attr('data-id'),
      name: $fieldSet.find('.js-name').val(),
      desc: $fieldSet.find('.js-description').val(),
      slug: $fieldSet.find('.js-slug').val()
    callback = (result) ->
      error = result.data
      $error = $editForm.find('.js-error')
      switch error
        when 0
          $categoryItem.trigger('portfolioCategoryCancelEdit')
          $categoryItem.find('.js-name').text data.name
          $categoryItem.find('.js-description').text data.desc
          $categoryItem.find('.js-slug').text data.slug
          $categoryItem.fadeIn 300
          $editForm.remove()
        when 1
          $error.show().text 'Неизвестная ошибка, попробуйте повторить попытку позже!'
        when 2
          $error.show().text 'Название «' + data.name + '» уже используется другой категорией'
        when 3
          $error.show().text 'Ярлык «' + data.slug + '» уже используется другой категорией'
    controller.call 'nimyadmin/portfolio/save_category', data, callback

  # Добавление категории в список
  addCategory: (e, data)->
    dataTemplate =
      current_field: data
    template = require 'admin/portfolio/categories/table/list/item.tpl'
    html = template.fetch dataTemplate
    $catListTb = $ '#cat-list-tb'
    $catListTb.prepend html
    $tr = $catListTb.find 'tr'
    trClass = ['tg-4eph','tg-031e']
    trKey = false
    $tr.each ->
      trKey = !trKey
      $this = $ @
      $this.removeClass('tg-4eph')
      $this.removeClass('tg-031e')
      $this.addClass trClass[if trKey then 1 else 0]

  # Удаление категории
  openWindowRemoveCategory: (e)=>
    do e.preventDefault
    $deleteCategoryPortfolio = $ '#delete-category-portfolio'
    $deleteCategoryPortfolio.prop 'disabled', true
    $inputName = $ e.currentTarget
    $categoryItem = $inputName.parents('.js-category-item')
    data =
      name: $categoryItem.find('td.tg-name').text(),
      id: $categoryItem.attr('data-id')
    $windowDeleteCategory = @$helperWindowDeleteCategory.get()
    $modelWindowSpan = $windowDeleteCategory.find 'span.tg-name'
    $modelWindowInput = $windowDeleteCategory.find '#tag-id'
    $modelWindowSpan.text data.name
    $modelWindowInput.val data.id
    $modelWindowInput.attr 'placeholder', data.name
    $input = $windowDeleteCategory.find '#delete-category #tag-name'
    $input.focus().val ''
    @$helperWindowDeleteCategory.open()
    $windowDeleteCategory.off('keyup', '#delete-category .input-edit')
      .on 'keyup', '#delete-category .input-edit', () ->
        $inputName = $ @
        $deleteCategoryPortfolio.prop 'disabled', true
        if $inputName.val() == data.name
          $deleteCategoryPortfolio.prop 'disabled', false

  removeCategory: (e)=>
    do e.preventDefault
    $this = $ e.currentTarget
    $form = $this.parent().parent()
    $inputId = $form.find '#tag-id'
    $this.prop 'disabled', true
    data =
      id: $inputId.val()
    callback = () ->
      $this.prop 'disabled', false
      $trDelete = @$catListTb.find 'tr[data-id='+data.id+']'
      $trDelete.remove()
      $tr = @$catListTb.find 'tr'
      trClass = ['tg-4eph','tg-031e']
      trKey = false;
      $tr.each ->
        trKey = !trKey
        $this = $ @
        $this.removeClass()
        $this.addClass trClass[trKey ? 1 : 0]
      @$helperWindowDeleteCategory.close()
    controller.call 'nimyadmin/portfolio/remove_category', data, callback

module.exports = new Category