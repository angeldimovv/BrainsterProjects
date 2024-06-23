<?php
require_once './imports.php';

use App\Classes\Book\Book;

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}


$bookObj = new Book();
$bookId = $_GET['id'];

$currentBook = $bookObj->getAllBookDataById($bookId);

if (!$currentBook) {
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
            </div>
        </nav>
    </header>
    <main class="bg-light d-flex flex-column align-items-center">
        <div class="container py-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-5 d-flex justify-content-center">
                    <img class="overflow-hidden rounded-3 border border-dark-subtle" src="<?= $currentBook['image_url'] ?>" alt="" style="height:450px;">
                </div>
                <div class="col-7">
                    <div class="bookInfo rounded-3 border border-dark-subtle d-flex flex-column align-items-center py-3 mb-5">
                        <h3 class="text-center fw-bold"><?= $currentBook['title'] ?></h3>
                        <hr class="w-75 mt-1 border-2">
                        <p class="fs-5 fw-semibold mb-2"><span class="fw-bold">Author: </span><?= $currentBook['authorFirstName'] ?> <?= $currentBook['authorLastName'] ?></p>
                        <p class="fs-5 fw-semibold mb-2"><span class="fw-bold">Category: </span><?= $currentBook['categoryName'] ?></p>
                        <p class="fs-5 fw-semibold mb-2"><span class="fw-bold">Published on: </span><?= $currentBook['publication_year'] ?></p>
                        <p class="fs-5 fw-semibold mb-2"><span class="fw-bold">Pages: </span><?= $currentBook['pages'] ?></p>
                    </div>
                    <div class="bg-secondary-subtle rounded-3 border border-dark-subtle p-3 d-flex flex-column">
                        <p class="fw-semibold mb-2">On <span class="fw-bold fst-italic">06.12.2024</span> you noted:</p>
                        <q>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, voluptatibus.</q>
                    </div>
                </div>
            </div>
        </div>
        <hr class="w-75 mb-0">
        <div class="container">
            <div class="row gx-5 justify-content-center">
                <div class="col-5 py-5">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Add a Comment:</label>
                            <textarea type="text" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
                <div class="col-1 text-center">
                    <hr class="vr h-100 my-0">
                </div>
                <div class="col-5 py-5">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Add a Private Note:</label>
                            <textarea type="text" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Note</button>
                    </form>
                </div>
            </div>
        </div>
        <hr class="w-75 mt-0">
        <div class="container py-5">
            <div class="row row-cols-3 g-3">
                <div class="col">
                    <div class="p-3 text-center bg-dark-subtle rounded-3 border border-dark-subtle">
                        <h4 class="fw-semibold">You commented:</h4>
                        <figure class="text-start">
                            <blockquote class="blockquote py-2">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, voluptatibus.</p>
                            </blockquote>
                            <figcaption class="blockquote-footer fw-bold mb-0">06.12.2024</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 text-center bg-secondary-subtle rounded-3 border border-dark-subtle">
                        <h4 class="fw-semibold">Someone commented:</h4>
                        <figure class="text-start">
                            <blockquote class="blockquote py-2">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, voluptatibus.</p>
                            </blockquote>
                            <figcaption class="blockquote-footer fw-bold mb-0">06.12.2024</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 text-center bg-secondary-subtle rounded-3 border border-dark-subtle">
                        <h4 class="fw-semibold">Someone commented:</h4>
                        <figure class="text-start">
                            <blockquote class="blockquote py-2">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, voluptatibus.</p>
                            </blockquote>
                            <figcaption class="blockquote-footer fw-bold mb-0">06.12.2024</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 text-center bg-secondary-subtle rounded-3 border border-dark-subtle">
                        <h4 class="fw-semibold">Someone commented:</h4>
                        <figure class="text-start">
                            <blockquote class="blockquote py-2">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, voluptatibus.</p>
                            </blockquote>
                            <figcaption class="blockquote-footer fw-bold mb-0">06.12.2024</figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>