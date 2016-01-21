class Model

  # Id модели
  _modelId: 0

  # Поля модели
  _$fields: {}

  _actions: {}

  constructor: (options)->
    {
      model,
      actions
    } = options
    $model = $ model
    self = @
    self._actions = actions
    modelId = $model.attr('data-id')
    if modelId?
      self._modelId = modelId
    $fields = $model.find('[data-field]')
    $fields.each (index, field)->
      $field = $ field
      fieldName = $field.attr 'data-field'
      self._$fields[fieldName] = $field
    $actions = $model.find('[data-action]')
    $actions.each (index, element)->
      $element = $ element
      event = $element.attr('data-event') or 'click'
      action = $element.attr('data-action')
      $element.on event, self._actions[action]

  # Установить значение поля
  set: (fieldName, fieldValue)->
    self = @
    $field = self._$fields[fieldName]
    if $field?
      $field.val(fieldValue)

  # Получить значение поля
  get: (fieldName)->
    self = @
    $field = self._$fields[fieldName]
    $field.val() if $field?

  # Получить данные из модели в виде объекта
  raw: ()->
    self = @
    result = id: self._modelId
    for name, $field of self._$fields
      result[name] = $field.val()
    result

  # Очистить значения модели
  clear: ()->
    self = @
    for name, $field of self._$fields
      $field.val('')

module.exports = Model