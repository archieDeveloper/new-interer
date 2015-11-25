controller = require 'helpers/controller'

class Portfolio

  $document = $ document
  text = ''

  constructor: ->
    @items = '.js-portfolio-item'
    @field =
      title: '.js-portfolio-title'
    @trash()
    @title()
    @category()
    @restore()

  trash: ->
    $document.on 'click', '.trash', (e) ->
      do e.preventDefault
      $this = $ @
      $this.prop 'disabled', true
      data = 
        id: $this.attr('data-id')
      callback = (result) ->
        $this.prop 'disabled', false
        $secondParent = $this.parent().parent()
        $secondParent.before result.html
        $secondParent.slideUp 200
      controller.call 'nimyadmin/portfolio/trash', data, callback

  restore: ->
    $document.on 'click', '.no-trash', (e) ->
      do e.preventDefault
      $this = $ @
      $this.prop 'disabled', true
      data = 
        id: $this.attr('data-id')
      callback = ->
        $this.prop 'disabled', false
        $parent = $this.parent()
        $parent.next().slideDown 200
        $parent.remove()
      controller.call 'nimyadmin/portfolio/restore', data, callback
    $document.on 'click', '.close-no-trash', (e) ->
      do e.preventDefault
      $parent = $(@).parent()
      $parent.next().remove()
      $parent.remove()

  title: ()->
    $(@items).on 'keypress', @field.title, (e) ->
      if e.keyCode == 13 then $(@).blur()
    $(@items).on 'focus', @field.title, ->
      $this = $ @
      text = $this.val()
      $this.next().find('.status-field-edit').show()
    $(@items).on 'blur', @field.title, ->
      $this_i = $ @
      $this_i.next().find('.status-field-edit').hide()
      return if text == $this_i.val()
      $this_i.prop 'disabled', true
      $next = $this_i.next()
      $next.find('.status-field-edit').hide()
      $next.find('.status-field-save').show()
      data =
        id: $this_i.attr('data-id'),
        title: $this_i.val()
      callback = () ->
        $this_i.next().find('.status-field-save').hide()
        $this_i.prop 'disabled', false
      controller.call 'nimyadmin/portfolio/title', data, callback

  category: ->
    $document.on 'click', '.slct', (e) ->
      do e.preventDefault
      $this = $ @
      dropBlock = $this.parent().find '.drop'
      if dropBlock.is ':hidden'
        dropBlock.slideDown 200
        $this.addClass 'active'
        $this.next().find('.status-field-edit').show()
      else
        dropBlock.slideUp 200
        $this.removeClass 'active'
        $this.next().find('.status-field-edit').hide()
    $document.on 'click', '.drop li', () ->
      $this = $ @
      $parent = $this.parent()
      $parentPrev = $parent.prev()
      $parentPrev.find('.status-field-edit').hide()
      $save = $parentPrev.find '.status-field-save'
      $save.show()
      $drop = $ '.drop'
      $drop.find('li').removeClass 'active'
      $this.addClass 'active'
      selectResult = do $this.html
      $parent.parent().find('.slct').removeClass('active').html selectResult+'<i class="flaticon-chevron8"></i>'
      $drop.slideUp 200
      $dropLi = $ '.drop li'
      $dropLi.prop 'disabled', true
      data = 
        id: $parent.attr('data-id'),
        category_link: $this.text()
      callback = ->
        $save.hide()
        $dropLi.prop 'disabled', false
      controller.call 'nimyadmin/portfolio/category', data, callback

module.exports = new Portfolio