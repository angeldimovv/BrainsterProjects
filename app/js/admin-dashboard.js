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

  $("select#selectBook").change(function () {
    var selectedBookId = $(this).val();

    $.get(
      `../app/processing/api/get-books.php?bookId=${selectedBookId}`,
      function (data) {
        $(this).empty();
        $("#bookId").val(data.id);
        $("#editTitle").val(data.first_name);
        $("#editAuthorId").val(data.first_name);
        $("#editCategoryId").val(data.first_name);
        $("#editPublicationYear").val(data.last_name);
        $("#editImageURL").val(data.bio);
      }
    );
  });

  $("select#selectBook").change(function () {
    var selectedBookId = $(this).val();

    $.get(
      `../app/processing/api/get-books.php?bookId=${selectedBookId}`,
      function (data) {
        $("#bookId").val(data.id);
        $("#editTitle").val(data.title);
        $("select#editAuthorName").val(data.author_id);
        $("select#editCategoryName").val(data.category_id);
        $("#editPublicationYear").val(data.publication_year);
        $("#editNumPages").val(data.pages);
        $("#editImageUrl").val(data.image_url);
      }
    );
  });

  $("select#selectCategory").change(function () {
    var selectedCategoryId = $(this).val();

    $.get(
      `../app/processing/api/get-categories.php?categoryId=${selectedCategoryId}`,
      function (data) {
        $("#categoryId").val(data.id);
        $("input#editCategoryName").val(data.name);
      }
    );
  });
});
