controller = require 'helpers/controller'

class Add

  $document = $ document

  constructor: ()->
    @$categoryAddForm = $ '.js-category-add-form'
    @initEvent()

  initEvent: ->
    @$categoryAddForm.on 'click', '.js-button-add', @addCategory

  addCategory: (e) ->
    do e.preventDefault
    $buttonAdd = $ @
    $buttonAdd.prop 'disabled', true
    $form = $buttonAdd.parents('.js-category-add-form')
    $inputName = $form.find '.js-name'
    $inputDesc = $form.find '.js-description'
    $inputSlug = $form.find '.js-slug'
    data =
      name: $inputName.val(),
      desc: $inputDesc.val(),
      slug: $inputSlug.val()
    callback = (result) ->
      resultData = result.data
      $buttonAdd.prop 'disabled', false
      switch resultData.error
        when 0
          $inputName.val ''
          $inputDesc.val ''
          $inputSlug.val ''
          $form.trigger('portfolioCategoryAdd', {
            id: resultData.result,
            name: data.name,
            desc: data.desc,
            slug: data.slug
          })
        when 1 then break
        when 2
          $form.find('.js-name-error').text 'Название «' + data.name + '» уже используется другой категорией'
        when 3
          $form.find('.js-slug-error').text 'Ярлык «' + data.slug + '» уже используется другой категорией'
    controller.call 'nimyadmin/portfolio/add_category', data, callback

module.exports = new Add