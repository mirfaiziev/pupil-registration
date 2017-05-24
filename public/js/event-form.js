EventForm = function () {

  // todo - translate in russian
  var initRegistrationStart = function () {
    $('#event-form-registration-start').datepicker({
      "dateFormat": "yy-mm-dd"
    });
  };

  var initRegistrationStop = function () {
    $('#event-form-registration-stop').datepicker({
      "dateFormat": "yy-mm-dd"
    });
  };


  initRegistrationStart();
  initRegistrationStop();
};

$(function () {
  var eventForm = new EventForm();
});