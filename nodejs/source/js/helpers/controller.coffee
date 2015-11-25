class Controller
  constructor: ->

  call: (contoller, data, callback) ->
    $.ajax
      dataType : "json",
      type     : "POST",
      data     : data,
      url      : '/' + contoller + '.html',
      success  : callback

module.exports = new Controller;