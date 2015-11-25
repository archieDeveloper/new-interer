controller = require 'helpers/controller'

class Articles

  $document = $ document

  constructor: () ->
    @edit()
    @cancelEdit()
    @save()
    @toggleText()
    @remove()
    @create()
    @restore()
  
  edit: ->
    $document.on 'click', '.edit-art', (e) ->
      do e.preventDefault
      $parent = $(@).parent().parent()
      $parent.find('.art-nav-1').hide()
      $parent.find('.art-nav-2').show()
      title = $parent.find('.title-art').hide().html()
      date = $parent.find('.date-art').hide().attr('data-date')
      $parent.find('.text-art').hide()
      if $parent.find('.text-art .fulltext-art').html()?
        text = $parent.find('.text-art .desc-art').html() + '<!--more-->' + $parent.find('.text-art .fulltext-art').html()
      else
        text = $parent.find('.text-art .desc-art').html()
      $parent.find('.edit-title-art').show().find('.input-edit').val title
      $parent.find('.edit-date-art').show().find('.input-edit').val date
      $parent.find('.edit-text-art').show().find('.input-edit').val text

  cancelEdit: ->
    $document.on 'click', '.no-edit-art', (e) ->
      do e.preventDefault
      $parent = $(@).parent().parent()
      $parent.find('.art-nav-1').show()
      $parent.find('.art-nav-2').hide()
      $parent.find('.title-art').show()
      $parent.find('.date-art').show()
      $parent.find('.text-art').show()
      $parent.find('.edit-title-art').hide().val ''
      $parent.find('.edit-date-art').hide().val ''
      $parent.find('.edit-text-art').hide().val ''

  save: ->
    $document.on 'click', '.save-edit-art', (e) ->
      e.preventDefault()
      $parent = $(@).parent().parent()
      data = 
        id: $(@).attr 'data-id',
        title: $parent.find('.edit-title-art .input-edit').val(),
        date: $parent.find('.edit-date-art .input-edit').val(),
        text: $parent.find('.edit-text-art .input-edit').val()
      callback = (result) ->
        $parent.find('.art-nav-1').show()
        $parent.find('.art-nav-2').hide()
        $parent.find('.title-art').show().html result.title
        $parent.find('.date-art').show().html(result.date_rus).attr 'data-date', result.date
        $parent.find('.text-art').show().find('.desc-art').html result.text
        $parent.find('.edit-title-art').hide().val ''
        $parent.find('.edit-date-art').hide().val ''
        $parent.find('.edit-text-art').hide().val ''
      controller.call 'nimyadmin/articles/save', data, callback

  toggleText: ->
    $document.on 'click', '.show-all-text', (e) ->
      do e.preventDefault
      $this = $ @
      $this.hide()
      $this.next().show()
    $document.on 'click', '.hide-all-text', (e) ->
      do e.preventDefault
      $parent = $(@).parent()
      $parent.prev().show()
      $parent.hide()

  remove: ->
    $document.on 'click', '.del-art', (e) ->
      do e.preventDefault
      $this = $ @
      $this.prop 'disabled', true
      data = 
        id: $this.attr 'data-id'
      callback = (result) ->
        $this.prop('disabled', false)
        $secondParent = $this.parent().parent()
        $secondParent.before(
          '<li class="news-trash">' +
            'Статья удалена.' +
            '<a href="#" class="no-trash" data-id="' + $id + '">Восстановить</a>' +
            '<a class="button close-no-trash" href="#"><i class="flaticon-cross5"></i></a>' +
          '</li>'
        )
        $secondParent.slideUp 200
      controller.call 'nimyadmin/articles/remove', data, callback

  restore: ->
    $document.on 'click', '.no-trash', (e) ->
      do e.preventDefault
      $this = $ @
      $this.prop 'disabled', true
      data = 
        id: $this.attr 'data-id'
      callback = ->
        $this.prop 'disabled', false
        $parent = $this.parent()
        $parent.next().slideDown 200
        $parent.remove()
      controller.call 'nimyadmin/articles/restore', data, callback
    $document.on 'click', '.close-no-trash', (e) ->
      do e.preventDefault
      $parent = $(@).parent()
      $parent.next().remove()
      $parent.remove()

  create: ->
    $document.on 'click', '.btn-publised-new', (e) ->
      do e.preventDefault
      data = 
        title: $('#title-new').val(),
        date: $('#date-new').val(),
        text: $('#text-new').val()
      callback = (result) ->
        $elem = $('.ajax-pre li').last().prependTo '.ajax-pre'
        $elem.find('.title-art').html result.title
        $elem.find('.date-art').html result.date
        $elem.find('.text-art').html result.text
        $elem.find('.edit-art').attr 'data-id', result.id
        $elem.find('.del-art').attr 'data-id', result.id
        $('#title-new').val ''
        $('#date-new').val ''
        $('#text-new').val ''
      controller.call 'nimyadmin/articles/create', data, callback

module.exports = new Articles;
