<?php

require_once './imports.php';

use App\Classes\Author\Author;
use App\Classes\Book\Book;
use App\Classes\Category\Category;
use App\Classes\Comment\Comment;

$authorObj = new Author();
$bookObj = new Book();
$categoryObj = new Category();
$commentObj = new Comment();

$allAuthors = $authorObj->getAllAuthors();


if (!$_SESSION['loginStatus']) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['loginStatus'] && $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Brainster Library</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSS Styles -->
    <link rel="stylesheet" href="./css/styles.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f7a6638fb1.js" crossorigin="anonymous"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <header>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-sm navbar-light bg-light shadow-sm">
            <div class="container">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-book pe-2 fs-3"></i>
                    <a class="navbar-brand fs-4" href="./index.php">Brainster Library</a>
                </div>
                <div class="d-flex align-items-center">
                    <a href="./dashboard.php" class="d-flex align-items-center text-dark fw-semibold link-underline link-underline-opacity-0 me-5">
                        <i class="fa-solid fa-circle-user fs-3 text-dark me-2"></i>
                        Dashboard</a>
                    <a href="./processing/logout-user.php" class="fw-bold text-dark link-underline link-underline-opacity-0">Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <main class="d-flex">
        <section class="w-25 ps-5 pt-5 bg-light">
            <div class="d-flex flex-column align-items-start flex-grow-1 vh-100">
                <a class="btn fs-5 mb-3 fw-semibold text-primary admin-btn" id="manageAuthorsBtn" href="#manageAuthors"><i class="fa-solid fa-user-pen fs-4 pe-2"></i>Manage Authors</a>
                <a class="btn fs-5 mb-3 fw-semibold admin-btn" id="manageBooksBtn" href="#manageBooks"><i class="fa-solid fa-book fs-4 pe-2"></i>Manage Books</a>
                <a class="btn fs-5 mb-3 fw-semibold admin-btn" id="manageCategoriesBtn" href="#manageCategories"><i class="fa-solid fa-list fs-4 pe-2"></i>Manage Categories</a>
                <a class="btn fs-5 mb-3 fw-semibold admin-btn" id="manageCommentsBtn" href="#manageComments"><i class="fa-solid fa-comment fs-4 pe-2"></i>Manage User Comments</a>
            </div>
        </section>
        <div class="d-flex flex-column h-100 w-75 admin-panel">
            <div id="manageAuthors" class="flex-column align-items-center admin-section mb-5">
                <?php if (isset($_SESSION['createAuthorSuccess'])) : ?>
                    <div class="alert bg-success alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                        <p class="m-0 ms-4"><?= $_SESSION['createAuthorSuccess'] ?></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['createAuthorErrors'])) : ?>
                    <?php if (!empty($_SESSION['createAuthorErrors']['authorExists'])) : ?>
                        <div class="alert bg-danger alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                            <p class="m-0 ms-4"><?= $_SESSION['createAuthorErrors']['authorExists'] ?></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif (!empty($_SESSION['createAuthorErrors']['firstName'])) : ?>
                        <div class="alert bg-danger alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                            <p class="m-0 ms-4"><?= $_SESSION['createAuthorErrors']['firstName'] ?></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif (!empty($_SESSION['createAuthorErrors']['lastName'])) : ?>
                        <div class="alert bg-danger alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                            <p class="m-0 ms-4"><?= $_SESSION['createAuthorErrors']['lastName'] ?></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif (!empty($_SESSION['createAuthorErrors']['bio'])) : ?>
                        <div class="alert bg-danger alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                            <p class="m-0 ms-4"><?= $_SESSION['createAuthorErrors']['bio'] ?></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <form class="border rounded-3 border-1 w-50 p-4 bg-light mt-5" action="./processing/add-author.php" method="POST">
                    <h4>Add a new Author:</h4>
                    <div class="row g-2 align-items-center flex-column my-4">
                        <div class="col-auto">
                            <label for="firstName" class="form-label">First Name: </label>
                            <input type="text" class="form-control" name="firstName" id="firstName" required />
                        </div>
                        <div class="col-auto">
                            <label for="lastName" class="form-label">Last Name: </label>
                            <input type="text" class="form-control" name="lastName" id="lastName" required />
                        </div>
                        <div class="col-auto">
                            <label for="bio" class="form-label">Short Bio: </label>
                            <textarea class="form-control" name="bio" id="bio" required rows="3" aria-required="true"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end px-4">Add Author</button>
                </form>
                <?php if (isset($_SESSION['editAuthorSuccess'])) : ?>
                    <div class="alert bg-success alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                        <p class="m-0 ms-4"><?= $_SESSION['editAuthorSuccess'] ?></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['editAuthorErrors'])) : ?>
                    <?php if (!empty($_SESSION['editAuthorErrors']['editFirstName'])) : ?>
                        <div class="alert bg-danger alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                            <p class="m-0 ms-4"><?= $_SESSION['editAuthorErrors']['editFirstName'] ?></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif (!empty($_SESSION['editAuthorErrors']['editLastName'])) : ?>
                        <div class="alert bg-danger alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                            <p class="m-0 ms-4"><?= $_SESSION['editAuthorErrors']['editLastName'] ?></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif (!empty($_SESSION['editAuthorErrors']['author'])) : ?>
                        <div class="alert bg-danger alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                            <p class="m-0 ms-4"><?= $_SESSION['editAuthorErrors']['author'] ?></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif (!empty($_SESSION['editAuthorErrors']['editBio'])) : ?>
                        <div class="alert bg-danger alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                            <p class="m-0 ms-4"><?= $_SESSION['editAuthorErrors']['editBio'] ?></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['softDeleteAuthorSuccess'])) : ?>
                    <div class="alert bg-success alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                        <p class="m-0 ms-4"><?= $_SESSION['softDeleteAuthorSuccess'] ?></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (isset($_SESSION['softDeleteAuthorErrors'])) : ?>
                    <div class="alert bg-danger alert-dismissible fade show rounded-2 mt-5 text-light fw-semibold w-25 text-center" id="">
                        <p class="m-0 ms-4"><?= $_SESSION['softDeleteAuthorErrors'] ?></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form class="border rounded-3 border-1 w-50 p-4 bg-light mt-5" action="./processing/edit-delete-author.php" method="POST">
                    <h4>Edit or Remove Author:</h4>
                    <div class="row flex-column g-2 align-items-center my-4">
                        <div class="mb-4 col-4">
                            <label id="selectAuthor" class="form-label">Select Author:</label>
                            <select class="form-select" name="selectAuthor" id="selectAuthor" required>
                                <option selected disabled>Select an Author</option>
                                <?php foreach ($allAuthors as $author) {
                                    echo '<option value="' . $author['id'] . '">' . $author['first_name'] . ' ' . $author['last_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <input type="number" id="authorId" name="authorId" hidden>
                        <div class="col-auto">
                            <label for="editFirstName" class="form-label">First Name: </label>
                            <input type="text" class="form-control" name="editFirstName" id="editFirstName" required />
                        </div>
                        <div class="col-auto">
                            <label for="editLastName" class="form-label">Last Name: </label>
                            <input type="text" class="form-control" name="editLastName" id="editLastName" required />
                        </div>
                        <div class="col-auto">
                            <label for="editBio" class="form-label">Short Bio: </label>
                            <textarea class="form-control" name="editBio" id="editBio" required rows="3" aria-required="true"></textarea>
                        </div>
                    </div>
                    <button type="submit" name="softDeleteAuthor" class="btn btn-primary float-end px-4">Remove Author</button>
                    <button type="submit" name="editAuthor" id="editAuthorBtn" class="btn btn-primary float-end px-4 me-3">Edit Author</button>
                </form>
            </div>
            <div id="manageBooks" class="flex-column align-items-center admin-section mb-5">
                <form class="border rounded-3 border-1 w-50 p-4 bg-light mt-5">
                    <h4>Add a new Book:</h4>
                    <div class="row g-2 align-items-center flex-column my-4">
                        <div class="col-auto">
                            <label for="title" class="form-label">Title: </label>
                            <input type="text" class="form-control" name="title" id="title" required />
                        </div>
                        <div class="col-4">
                            <label id="selectAuthor" class="form-label">Select Author:</label>
                            <select class="form-select" name="selectAuthor" id="selectAuthor" required>
                                <option selected disabled>Select an Author</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label id="selectCategory" class="form-label">Select Category:</label>
                            <select class="form-select" name="selectCategory" id="selectCategory" required>
                                <option selected disabled>Select a Category</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="publicationYear" class="form-label">Publication Year: </label>
                            <input type="number" class="form-control" name="publicationYear" id="publicationYear" required />
                        </div>
                        <div class="col-auto">
                            <label for="numOfPages" class="form-label">Number of Pages: </label>
                            <input type="number" class="form-control" name="numOfPages" id="numOfPages" required />
                        </div>
                        <div class="col-auto">
                            <label for="imageUrl" class="form-label">Image URL: </label>
                            <input type="url" class="form-control" name="imageUrl" id="imageUrl" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end px-4">Add Book</button>
                </form>
                <form class="border rounded-3 border-1 w-50 p-4 bg-light mt-5">
                    <h4>Edit or Remove a Book:</h4>
                    <div class="row g-2 align-items-center flex-column my-4">
                        <div class="col-4">
                            <label id="selectBook" class="form-label">Select Book:</label>
                            <select class="form-select" name="selectBook" id="selectBook" required>
                                <option selected disabled>Select a Book</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="title" class="form-label">Title: </label>
                            <input type="text" class="form-control" name="title" id="title" required />
                        </div>
                        <div class="col-4">
                            <label id="selectAuthor" class="form-label">Select Author:</label>
                            <select class="form-select" name="selectAuthor" id="selectAuthor" required>
                                <option selected disabled>Select an Author</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label id="selectCategory" class="form-label">Select Category:</label>
                            <select class="form-select" name="selectCategory" id="selectCategory" required>
                                <option selected disabled>Select a Category</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="publicationYear" class="form-label">Publication Year: </label>
                            <input type="number" class="form-control" name="publicationYear" id="publicationYear" required />
                        </div>
                        <div class="col-auto">
                            <label for="numOfPages" class="form-label">Number of Pages: </label>
                            <input type="number" class="form-control" name="numOfPages" id="numOfPages" required />
                        </div>
                        <div class="col-auto">
                            <label for="imageUrl" class="form-label">Image URL: </label>
                            <input type="url" class="form-control" name="imageUrl" id="imageUrl" required />
                        </div>
                    </div>
                    <button type="submit" name="softDeleteBook" class="btn btn-primary float-end px-4">Remove Book</button>
                    <button type="submit" name="editBook" id="editBookBtn" class="btn btn-primary float-end px-4 me-3">Edit Book</button>
                </form>
            </div>
            <div id="manageCategories" class="flex-column align-items-center admin-section mb-5">
                <form class="border rounded-3 border-1 w-50 p-4 bg-light mt-5">
                    <h4>Add a new Category:</h4>
                    <div class="row g-2 align-items-center flex-column my-4">
                        <div class="col-auto">
                            <label for="category" class="form-label">Category Name: </label>
                            <input type="text" class="form-control" name="category" id="category" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end px-4">Add Category</button>
                </form>
                <form class="border rounded-3 border-1 w-50 p-4 bg-light mt-5">
                    <h4>Edit or Remove Category:</h4>
                    <div class="row g-2 flex-column align-items-center my-4">
                        <div class="col-4 mb-4">
                            <label id="selectCategory" class="form-label">Select Category:</label>
                            <select class="form-select" name="selectCategory" id="selectCategory" required>
                                <option selected disabled>Select a Category</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="category" class="form-label">Category Name: </label>
                            <input type="text" class="form-control" name="category" id="category" required />
                        </div>
                    </div>
                    <button type="submit" name="softDeleteCategory" class="btn btn-primary float-end px-4">Remove Category</button>
                    <button type="submit" name="editCategory" id="editCategoryBtn" class="btn btn-primary float-end px-4 me-3">Edit Category</button>
                </form>
            </div>
            <div id="manageComments" class="flex-row align-items-center justify-content-center admin-section mb-5 mx-5">
                <div class="border rounded-3 border-1 p-4 bg-light mt-5 w-75">
                    <div class="row flex-row align-items-center justify-content-around my-3">
                        <div class="col-auto flex-column text-info">
                            <h5>Pending Comments</h5>
                            <hr class="text-primary mt-1">
                        </div>
                        <div class="col-auto flex-column text-success">
                            <h5>Approved Comments</h5>
                            <hr class="text-success-emphasis mt-1">
                        </div>
                        <div class="col-auto flex-column text-danger">
                            <h5>Denied Comments</h5>
                            <hr class="text-danger-emphasis mt-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- JavaScript import -->
    <script src="./js/admin-dashboard.js"></script>
</body>

</html>

<?php
unset($_SESSION['createAuthorSuccess']);
unset($_SESSION['createAuthorErrors']);

unset($_SESSION['editAuthorSuccess']);
unset($_SESSION['editAuthorErrors']);

unset($_SESSION['softDeleteAuthorSuccess']);
unset($_SESSION['softDeleteAuthorErrors']);

?>