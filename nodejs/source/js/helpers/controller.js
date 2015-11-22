'use strict';

var Controller = (function() {
  var Controller = function() {

  };

  Controller.prototype.call = function(contoller, data, callback) {
    $.ajax({
      dataType : "json",
      type     : "POST",
      data     : data,
      url      : '/' + contoller + '.html',
      success  : callback
    });
  };

  return Controller;
})();

module.exports = new Controller;