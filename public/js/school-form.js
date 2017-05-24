SchoolForm = function (citiesSearchUrl) {
  var initCitySelection = function (citiesSearchUrl) {
    $('#school-form-city').autocomplete({
      minLength: 2,
      delay: 1,
      source: function(request, response) {
        $.getJSON(citiesSearchUrl, { q: request.term }, response);
      }
    });
  };

  initCitySelection(citiesSearchUrl);
};
