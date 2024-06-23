<?php
require_once("../imports.php");

use App\Classes\Book\Book;

if (!$_SESSION['loginStatus']) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['loginStatus'] && $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookObj = new Book();

    $title = ucfirst(trim($_POST['title']));
    $authorId = trim($_POST['selectAuthor']);
    $categoryId = trim($_POST['selectCategory']);
    $publicationYear = trim($_POST['publicationYear']);
    $numPages = trim($_POST['numPages']);
    $imageUrl = trim($_POST['imageUrl']);

    $errors = [];

    if (empty($title)) {
        $errors['title'] = "Title cannot be empty.";
    }

    if (empty($authorId)) {
        $errors['authorName'] = "Author must be chosen.";
    }

    if (empty($categoryId)) {
        $errors['categoryName'] = "Category must be chosen.";
    }

    if (empty($publicationYear) || !preg_match('/^\d{4}$/', $publicationYear) || $publicationYear > date('Y')) {
        $errors['publicationYear'] = "Invalid publication year. Try again";
    }

    if (empty($numPages) || !is_numeric($numPages)) {
        $errors['numPages'] = "Number of pages must be a valid number.";
    }

    if (empty($imageUrl) || !filter_var($imageUrl, FILTER_VALIDATE_URL)) {
        $errors['imageUrl'] = "Invalid image URL.";
    }

    $existingTitle = $bookObj->getBookByTitle($title);
    if ($existingTitle) {
        $errors['bookExists'] = 'This Book already exists, please check and try again';
    }

    if (!empty($errors)) {
        $_SESSION['createBookErrors'] = $errors;
        header('Location: ../dashboard.php#manageBooks');
        exit();
    }

    $result = $bookObj->addBook($title, $authorId, $categoryId, $publicationYear, $numPages, $imageUrl);

    if ($result) {
        $_SESSION['createBookSuccess'] = 'Book added successfully';
        header('Location: ../dashboard.php#manageBooks');
        exit();
    } else {
        $_SESSION['createBookErrors'] = ['book' => "Error creating book. Please try again."];
        header('Location: ../dashboard.php#manageBooks');
        exit();
    }
} else {
    header('Location: ../dashboard.php');
    exit();
}
