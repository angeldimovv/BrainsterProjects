<?php
require_once './imports.php';

use App\Classes\Book\Book;

$bookObj = new Book();

$allBooks = $bookObj->getAllBooks();

echo '<pre>' . var_export($allBooks, true) . '</pre>';

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
</head>

<body>
    <header>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-book pe-2 fs-3"></i>
                    <a class="navbar-brand fs-4" href="#">Brainster Library</a>
                </div>
                <?php if (!isset($_SESSION['loginStatus'])) : ?>
                    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav mt-2 mt-lg-0 ms-sm-auto">
                            <li class="nav-item">
                                <a class="btn btn-primary me-sm-3 my-2 my-lg-0" href="./login.php">Sign in</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-warning" href="./register.php">Sign up</a>
                            </li>
                        </ul>
                    </div>
                <?php else : ?>
                    <div class="d-flex align-items-center">
                        <?php if ($_SESSION['user']['role'] === 'admin') : ?>
                            <a href="./dashboard.php" class="d-flex align-items-center text-dark fw-semibold link-underline link-underline-opacity-0 me-5">
                                <i class="fa-solid fa-circle-user fs-3 text-dark me-2"></i>
                                Dashboard</a>
                        <?php endif; ?>
                        <a href="./processing/logout-user.php" class="fw-bold text-dark link-underline link-underline-opacity-0">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
        <!-- Hero Section -->
        <section class="px-4 pt-5 d-flex flex-column justify-content-start justify-content-lg-center" style="background-image:url(https://i.ibb.co/61kjqqd/bgg.webp);background-size:cover;background-position:center bottom;height:75vh">
            <h1 class="display-3 fw-bold">Welcome to Brainster Library.</h1>
            <h3>An interactive web platform for finding, searching and commenting on
                <br />books you like or find a liking for.
            </h3>
        </section>
    </header>
    <main class="container-fluid">
        <div class="container d-flex justify-content-between flex-column flex-sm-row my-3">
            <button class="btn btn-primary mb-3 mb-sm-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#categories" aria-controls="categories">
                Filters
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="categories" aria-labelledby="categories">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="categories">Filter by Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="" />
                            <label class="form-check-label" for=""> Category 1 </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="" />
                            <label class="form-check-label" for=""> Category 2 </label>
                        </div>
                    </form>
                </div>
            </div>
            <form class="d-flex align-items-center justify-content-center" role="search">
                <input class="form-control me-2" type="search" placeholder="Search a book" aria-label="Search" name="bookSearch">
            </form>
        </div>
        <hr class="m-0">
        <div class="container my-5">
            <div class="row row-cols-1 row-cols-lg-4 g-4">
                <?php foreach ($allBooks as $book) {
                    $currentBook = $bookObj->getAllBookDataById($book['id']);
                ?>
                    <div class="col">
                        <div class="card rounded-3 shadow-lg">
                            <div class="content w-100 h-100">
                                <div class="front">
                                    <img src="<?= $currentBook['image_url'] ?>" alt="" style="height:400px;">
                                </div>
                                <div class="back rounded-3 py-4 text-start d-flex flex-column align-items-center text-dark">
                                    <h2 class="fs-3 fw-bold text-center"><?= $currentBook['title'] ?></h2>
                                    <hr class="w-75 border-2">
                                    <p class="fs-5 fw-semibold mb-2"><span class="text-dark fw-bold">Author: </span><?= $currentBook['authorFirstName'] ?> <?= $currentBook['authorLastName'] ?></p>
                                    <p class="fs-5 fw-semibold mb-2"><span class="text-dark fw-bold">Category: </span><?= $currentBook['categoryName'] ?></p>
                                    <p class="fs-5 fw-semibold mb-2"><span class="text-dark fw-bold">Published on: </span><?= $currentBook['publication_year'] ?></p>
                                    <p class="fs-5 fw-semibold mb-2"><span class="text-dark fw-bold">Pages: </span><?= $currentBook['pages'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <footer class="position-sticky bottom-0 start-50 v-100 bg-dark text-center">
        <p class="py-2 mb-0 text-light fs-5" id="quote"></p>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="./js/index.js"></script>
</body>

</html>