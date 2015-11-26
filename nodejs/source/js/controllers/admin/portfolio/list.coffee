controller = require 'helpers/controller'

class List

  text = ''

  constructor: ->
    @portfolioList = $ '.js-portfolio-list'
    @initEvent()

  # Инициализация событий
  initEvent: ->
    @portfolioList.on 'click', '.js-trash', @trash
    @portfolioList.on 'click', '.js-restore', @restore
    @portfolioList.on 'click', '.js-close-restore', @closeRestore

    @portfolioList.on 'keypress', '.js-title', @titleBlur
    @portfolioList.on 'focus',    '.js-title', @titleEdit
    @portfolioList.on 'blur',     '.js-title', @titleSave

    @portfolioList.on 'click', '.js-select', @toggleCategoryList
    @portfolioList.on 'click', '.js-select-list li', @categorySave

  # Удаление выполненной работы
  trash: (e) ->
    do e.preventDefault
    $buttonTrash = $ @
    $portfolioItem = $buttonTrash.parents('.js-item');
    $buttonTrash.prop 'disabled', true
    data =
      id: $portfolioItem.attr('data-id')
    callback = (result) ->
      $buttonTrash.prop 'disabled', false
      $portfolioItem.before result.html
      $portfolioItem.slideUp 200
    controller.call 'nimyadmin/portfolio/trash', data, callback

  # Восстановление выполненной работы
  restore: (e) ->
    do e.preventDefault
    $buttonRestore = $ @
    $buttonRestore.prop 'disabled', true
    $restoreNotification = $buttonRestore.parents('.js-restore-notification')
    data =
      id: $restoreNotification.attr('data-id')
    callback = ->
      $buttonRestore.prop 'disabled', false
      $restoreNotification.remove()
      $portfolioItem = $('.js-item[data-id='+data.id+']')
      $portfolioItem.slideDown 200
    controller.call 'nimyadmin/portfolio/restore', data, callback

  # Закрытие блока восстановления выполненной работы
  closeRestore: (e) ->
    do e.preventDefault
    $buttonCloseRestore = $ @
    $restoreNotification = $buttonCloseRestore.parents('.js-restore-notification')
    $portfolioItem = $('.js-item[data-id='+$restoreNotification.attr('data-id')+']')
    $portfolioItem.remove()
    $restoreNotification.remove()

  # Расфокусировать поле для ввода у заголовка
  titleBlur: (e)->
    if e.keyCode == 13 then $(@).blur()

  # Редактирование заголовка
  titleEdit: ->
    $title = $ @
    $portfolioItem = $title.parents('.js-item')
    text = $title.val()
    $portfolioItem.find('.js-title-status-edit').show()

  # Сохранение заголовка
  titleSave: ->
    $title = $ @
    return if text == $title.val()
    $portfolioItem = $title.parents('.js-item')
    $titleStatusEdit = $portfolioItem.find('.js-title-status-edit')
    $titleStatusSave = $portfolioItem.find('.js-title-status-save')
    $titleStatusEdit.hide()
    $titleStatusSave.show()
    $title.prop 'disabled', true
    data =
      id: $portfolioItem.attr('data-id'),
      title: $title.val()
    callback = () ->
      $titleStatusSave.hide()
      $title.prop 'disabled', false
    controller.call 'nimyadmin/portfolio/title', data, callback

  # Сворачивание/разворачивание списка категорий
  toggleCategoryList: (e) ->
    do e.preventDefault
    $select = $ @
    $portfolioItem = $select.parents('.js-item')
    $selectList = $portfolioItem.find('.js-select-list')
    $selectStatusEdit = $portfolioItem.find('.js-select-status-edit')
    if $selectList.is ':hidden'
      $selectList.slideDown 200
      $select.addClass 'active'
      $selectStatusEdit.show()
    else
      $selectList.slideUp 200
      $select.removeClass 'active'
      $selectStatusEdit.hide()

  # Сохранить категорию
  categorySave: ->
    $selectListElement = $ @
    $portfolioItem = $selectListElement.parents('.js-item')
    $selectList = $portfolioItem.find('.js-select-list')
    $select = $portfolioItem.find('.js-select')
    $selectStatusEdit = $portfolioItem.find('.js-select-status-edit')
    $selectStatusEdit.hide()
    $selectStatusSave = $portfolioItem.find('.js-select-status-save')
    $selectStatusSave.show()
    $selectListElements = $selectList.find('li')
    $selectListElements.removeClass 'active'
    $selectListElement.addClass 'active'
    selectResult = do $selectListElement.html
    $select.removeClass('active').html selectResult+'<i class="flaticon-chevron8"></i>'
    $selectList.slideUp 200
    $selectListElements.prop 'disabled', true
    data =
      id: $portfolioItem.attr('data-id'),
      category_link: $selectListElement.text()
    callback = ->
      $selectStatusSave.hide()
      $selectListElements.prop 'disabled', false
    controller.call 'nimyadmin/portfolio/category', data, callback

module.exports = new List