EventIndex = function (_token) {

  var initDeleteEvent = function (_token) {
    $('.remove-button').on('click', function () {
      if (confirm('Вы уверены?')) {
        deleteEvent($(this).data('delete-url'), _token);
      }
    });
  };

  var deleteEvent = function (deleteUrl, _token) {
    $.ajax({
      url       : deleteUrl,
      type      : 'DELETE',
      data      : {
        '_token': _token
      },
      statusCode: {
        404: function () {
          alert('Не могу найти данное событие в базе');
        }
      },
      success   : function (result) {
        alert('Событие было успешно удалено');
        location.reload();
      }
    });
  };

  initDeleteEvent();
};
