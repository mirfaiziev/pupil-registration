SchoolList = function (_token) {
  var initDeleteSchools = function (_token) {
    $(function () {
      $('.remove-button').on('click', function () {
        var deleteUrl = $(this).data('delete-url');
        if (confirm('Вы уверены?')) {
          deleteSchool(deleteUrl, _token);
        }
      });
    });
  };

  var deleteSchool = function (deleteUrl, _token) {
    $.ajax({
      url       : deleteUrl,
      type      : 'DELETE',
      data      : {
        '_token': _token
      },
      statusCode: {
        404: function () {
          alert('Не могу найти данную школу в базе');
        }
      },
      success   : function (result) {
        alert('Школа была успешно удалена');
        location.reload();
      }
    });
  };
  initDeleteSchools(_token);
};

