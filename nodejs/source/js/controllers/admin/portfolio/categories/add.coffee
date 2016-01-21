controller = require 'helpers/controller'
Model = require 'class/model'

class Add

  constructor: ()->
    @$categoryAddForm = $ '.js-category-add-form'
    @categoryModel = new Model {
      model: @$categoryAddForm,
      actions: {
        insert: @addCategory
      }
    }

  addCategory: (e) =>
    do e.preventDefault
    categoryModel = @categoryModel
    $form = @$categoryAddForm
    $buttonAdd = $ e.currentTarget
    $buttonAdd.prop 'disabled', true
    data = categoryModel.raw()
    callback = (result) ->
      resultData = result.data
      $buttonAdd.prop 'disabled', false
      switch resultData.error
        when 0
          categoryModel.clear()
          $form.trigger('portfolioCategoryAdd', {
            id: resultData.result,
            name: data.name,
            description: data.desc,
            link: data.slug
            amount: 0
          })
        when 1 then break
        when 2
          $form.find('.js-name-error').text 'Название «' + data.name + '» уже используется другой категорией'
        when 3
          $form.find('.js-slug-error').text 'Ярлык «' + data.slug + '» уже используется другой категорией'
    controller.call 'nimyadmin/portfolio/add_category', data, callback

module.exports = new Add