$(document).ready(function () {
  $.ajax({
    url: "https://api.quotable.io/random?maxLength=70",
    method: "GET",
    dataType: "json",
    success: function (data) {
      $("#quote").html(`<q>${data.content}</q> -  ${data.author}`);
    },
    error: function (errorThrown) {
      $("#quote").html(
        "Copyright <span>&copy;</span> Angel Dimov - Brainster Library"
      );
      console.error("Error fetching quote:", errorThrown);
    },
  });
});
