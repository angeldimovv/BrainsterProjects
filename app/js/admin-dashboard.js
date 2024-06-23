$(document).ready(function () {
  window.location.hash = "#manageBooks"; //"#manageAuthors";

  $("#manageAuthorsBtn").click(function () {
    showSection("manageAuthors", "manageAuthorsBtn");
  });

  $("#manageCategoriesBtn").click(function () {
    showSection("manageCategories", "manageCategoriesBtn");
  });

  $("#manageBooksBtn").click(function () {
    showSection("manageBooks", "manageBooksBtn");
  });

  $("#manageCommentsBtn").click(function () {
    showSection("manageComments", "manageCommentsBtn");
  });

  if (window.location.hash === "#manageAuthors") {
    $("#manageAuthorsBtn").trigger("click");
  }
  if (window.location.hash === "#manageCategories") {
    $("#manageCategoriesBtn").trigger("click");
  }
  if (window.location.hash === "#manageBooks") {
    $("#manageBooksBtn").trigger("click");
  }
  if (window.location.hash === "#manageComments") {
    $("#manageCommentsBtn").trigger("click");
  }

  function showSection(sectionId, buttonId) {
    $(".admin-section").removeClass("d-flex");
    $("#" + sectionId).addClass("d-flex");
    $(".admin-btn").removeClass(["on-click", "text-primary"]);
    $("#" + buttonId).addClass(["on-click", "text-primary"]);
  }

  $("select#selectAuthor").change(function () {
    var selectedAuthorId = $(this).val();

    $.get(
      `../app/processing/api/get-authors.php?authorId=${selectedAuthorId}`,
      function (data) {
        $(this).empty();
        $("#authorId").val(data.id);
        $("#editFirstName").val(data.first_name);
        $("#editLastName").val(data.last_name);
        $("#editBio").val(data.bio);
      }
    );
  });
});
