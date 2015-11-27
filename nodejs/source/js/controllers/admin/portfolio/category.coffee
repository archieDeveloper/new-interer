controller = require 'helpers/controller'

class Category

  $document = $ document

  constructor: ()->
    @$catListTb = $ '#cat-list-tb'
    @sortable(@$catListTb)
    @initEvent()
    # @sortable()
    # @editCategory()
    # @cancelEditCategory()
    # @saveEditCategory()
    # @removeCategory()

  initEvent: ->
    @$catListTb.on 'portfolioCategoryEdit', ->
      $(@).sortable 'disable'
    @$catListTb.on 'portfolioCategoryCancelEdit', ->
      $(@).sortable 'enable'

    @$catListTb.on 'click', '.js-button-edit', @editCategory
    @$catListTb.on 'click', '.js-button-cancel-edit', @cancelEditCategory
    @$catListTb.on 'click', '.js-button-save', @saveEditCategory

  sortable: (sortableElement)->
    sortableElement.sortable(
      placeholder: "ui-state-highlight",
      start: (e, elem) ->
        $item = $ elem.item
        $item.css display:'inline-table'
      stop: (e,elem) ->
        $item = $ elem.item
        $item.removeAttr 'style'
        $tr = $(this).find 'tr'
        arrayMenu = []
        trClass = ['tg-4eph','tg-031e']
        trKey = false
        $tr.each(->
          $this = $(@)
          trKey = !trKey
          $this.removeClass()
          $this.addClass trClass[trKey ? 1 : 0]
          arrayMenu.push $this.attr 'data-id'
        )
        data = 
          data_id: arrayMenu
        callback = ->
        controller.call 'nimyadmin/portfolio/sortable_category', data, callback
    )

  editCategory: (e)->
    do e.preventDefault
    $buttonCategoryEdit = $ @
    $categoryItem = $buttonCategoryEdit.parents('.js-category-item')
    $categoryItem.trigger('portfolioCategoryEdit')
    data = 
      id: $categoryItem.attr 'data-id',
      name: $categoryItem.find('.js-name').text(),
      desc: $categoryItem.find('.js-description').text(),
      slug: $categoryItem.find('.js-slug').text()
    template = require 'admin/templates/portfolio/category/edit.tpl'
    html = template.fetch data
    $categoryItem.hide()
    $categoryItem.after html

  cancelEditCategory: ->
    do e.preventDefault
    $buttonCancelEdit = $ @
    $buttonCancelEdit.trigger('portfolioCategoryCancelEdit')
    $editForm = $buttonCancelEdit.parent().parent().parent()
    $editForm.prev().show()
    $editForm.remove()

  saveEditCategory: ->
    do e.preventDefault
    $this = $ @
    $parent = $this.parent()
    $editForm = $parent.parent().parent()
    $secondParent = $parent.prev()
    data = 
      id: $editForm.attr 'data-id',
      name: $secondParent.find('.tg-name').val(),
      desc: $secondParent.find('.tg-desc').val(),
      slug: $secondParent.find('.tg-slug').val()
    callback = (result) ->
      resultData = result.data
      switch resultData.error
        when 0
          $row = $editForm.prev()
          $row.find('.tg-name').text data.name
          $row.find('.tg-desc').text data.desc
          $row.find('.tg-slug').text data.slug
          $row.fadeIn 300
          $editForm.remove()
        when 1
          $editForm.find('.error').show().text 'Неизвестная ошибка, попробуйте повторить попытку позже!'
        when 2
          $editForm.find('.error').show().text 'Название «' + data.name + '» уже используется другой категорией'
        when 3
          $editForm.find('.error').show().text 'Ярлык «' + data.slug + '» уже используется другой категорией'
    controller.call 'nimyadmin/portfolio/save_category', data, callback

  addCategory: (e, data)->
    template = require 'admin/templates/portfolio/category/item.tpl'
    html = template.fetch data
    $categoryItem = $ '.js-category-item[data-id='+data.id+']'
    self.$catListTb.prepend html
    $tr = self.$catListTb.find 'tr'
    trClass = ['tg-4eph','tg-031e']
    trKey = false
    $tr.each ->
      trKey = !trKey
      $this = $ @
      $this.removeClass()
      $this.addClass trClass[trKey ? 1 : 0]

  removeCategory: ->
    self = @
    $modelWindow = $ '.model-delete-category'
    $modelWindow.dialog
      autoOpen: false,
      draggable: false,
      resizable: false,
      modal: true,
      minWidth: 460,
      closeText: '<i class="flaticon-cross5"></i>'
    $document.on 'click', '.ui-widget-overlay', (e) ->
      $modelWindow.dialog "close"
    $document.on 'click', '.delete-category', (e) ->
      do e.preventDefault
      $deleteCategoryPortfolio = $ '#delete-category-portfolio'
      $deleteCategoryPortfolio.prop 'disabled', true
      $this = $ @
      $row = $this.parent().parent()
      name = $row.find('td.tg-name').text()
      id = $this.attr 'data-id'
      $modelWindowSpan = $modelWindow.find 'span.tg-name'
      $modelWindowInput = $modelWindow.find '#tag-id'
      $modelWindowSpan.text name
      $modelWindowInput.val id
      $input = $ '#delete-category #tag-name'
      $input.focus().val ''
      $modelWindow.dialog "open"
      $document.off('keyup', '#delete-category .input-edit').on 'keyup', '#delete-category .input-edit', (e) ->
        $this = $ @
        $deleteCategoryPortfolio.prop 'disabled', true
        if $this.val() == name
          $deleteCategoryPortfolio.prop 'disabled', false
    $document.on 'click', '#delete-category-portfolio', (e) ->
      do e.preventDefault
      $this = $ @
      $form = $this.parent().parent()
      $inputId = $form.find '#tag-id'
      $this.prop 'disabled', true
      data = 
        id: $inputId.val()
      callback = () ->
        $this.prop 'disabled', false
        $trDelete = self.$catListTb.find 'tr[data-id='+data.id+']'
        $trDelete.remove()
        $tr = self.$catListTb.find 'tr'
        trClass = ['tg-4eph','tg-031e']
        trKey = false;
        $tr.each ->
          trKey = !trKey
          $this = $ @
          $this.removeClass()
          $this.addClass trClass[trKey ? 1 : 0]
        $modelWindow.dialog "close"
      controller.call 'nimyadmin/portfolio/remove_category', data, callback

module.exports = new Category