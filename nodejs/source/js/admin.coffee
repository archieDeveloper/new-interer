$(document).ready ->
  requireControllerIndex = {}
  $('[data-controller]').each (index, elem)->
    requireControllerIndex[$(elem).attr('data-controller')] = true
  requireControllers = Object.keys requireControllerIndex

  requireControllers.forEach (controllerPath, index, thisList)->
    require 'controllers/'+controllerPath

#  require 'controllers/admin/portfolio/index'
#  require 'controllers/admin/portfolio/category'
#  require 'controllers/admin/portfolio/articles'