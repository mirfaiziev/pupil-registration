PupilRegisterPage = function (pupilNameSuggestUrl, citiesSearchUrl, schoolsSearchUrl) {

  var initPupilNameSelection = function (pupilNameSuggestUrl) {
    $('#pupil-register-form-first-name').autocomplete({
      minLength: 2,
      delay: 2,
      source: function(request, response) {
        $.getJSON(pupilNameSuggestUrl, { q: request.term }, response);
      }
    });
  };

  var initSchoolSelection = function (schoolSearchUrl) {
    $('#pupil-register-form-school').autocomplete({
        minLength: 1,
        delay: 2,
        source: function(request, response) {
          var city = $('#pupil-register-form-city').val();
          $.getJSON(schoolSearchUrl, { q: request.term, city:city }, response);
        }
    });
  };

  var initCitySelection = function (citiesSearchUrl) {
    $('#pupil-register-form-city').autocomplete({
      minLength: 2,
      delay: 1,
      source: function(request, response) {
        $.getJSON(citiesSearchUrl, { q: request.term }, response);
      }
    });
  };

  var initNamesCapitalization = function () {
    $('#pupil-register-form-first-name').blur(function () {
      $(this).val(ucFirst($(this).val()));
    });
    $('#pupil-register-form-family-name').blur(function () {
      $(this).val(ucFirst($(this).val()));
    });

    $('#pupil-register-form-city').blur(function () {
      $(this).val(ucFirst($(this).val()));
    });
  };

  var ucFirst = function (string) {
    return string[0].toUpperCase() + string.substring(1);
  };

  initPupilNameSelection(pupilNameSuggestUrl);
  initSchoolSelection(schoolsSearchUrl);
  initCitySelection(citiesSearchUrl);
  initNamesCapitalization();
};


