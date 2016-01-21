class Window

  constructor: (template, buttons)->
    html = template.fetch()
    @_$window = $window = $ html
    $window.dialog
      autoOpen: false,
      draggable: false,
      resizable: false,
      modal: true,
      minWidth: 460,
      closeText: '<i class="flaticon-cross5"></i>'
    $('body').on 'click', '.ui-widget-overlay', (e) ->
      $window.dialog "close"

  open: ->
    @_$window.dialog 'open'

  close: ->
    @_$window.dialog 'close'

  get: ->
    @_$window


module.exports = Window