'use strict';

var View = (function() {
  var View = function() {

  };

  View.prototype.render = function(view, data, callback) {
    data.view = view;
    $.ajax({
      dataType : "html",
      type     : "GET",
      data     : data,
      url      : '/view.html',
      success  : callback
    });
  };

  return View;
})();

module.exports = new View;