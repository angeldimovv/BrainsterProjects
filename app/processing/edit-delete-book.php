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
    $bookModel = new Book();
    $bookId = $_POST['bookId'];
    $title = ucfirst(trim($_POST['editTitle']));
    $authorId = trim($_POST['editAuthorName']);
    $categoryId = trim($_POST['editCategoryName']);
    $publicationYear = trim($_POST['editPublicationYear']);
    $numPages = trim($_POST['editNumPages']);
    $imageUrl = trim($_POST['editImageUrl']);

    $errors = [];

    if (empty($title)) {
        $errors['editTitle'] = "Title cannot be empty.";
    }

    if (empty($authorId)) {
        $errors['editAuthorName'] = "Author must be chosen.";
    }

    if (empty($categoryId)) {
        $errors['editCategoryName'] = "Category must be chosen.";
    }

    if (empty($publicationYear) || !preg_match('/^\d{4}$/', $publicationYear) || $publicationYear > date('Y')) {
        $errors['editPublicationYear'] = "Invalid publication year. Try again";
    }

    if (empty($numPages) || !is_numeric($numPages)) {
        $errors['editNumPages'] = "Number of pages must be a valid number.";
    }

    if (empty($imageUrl) || !filter_var($imageUrl, FILTER_VALIDATE_URL)) {
        $errors['editImageUrl'] = "Invalid image URL.";
    }

    if (!empty($errors)) {
        $_SESSION['editBookErrors'] = $errors;
        header('Location: admin-panel.php#manageBooks');
        exit();
    }


    if (isset($_POST['editBook'])) {
        $result = $bookModel->updateBook($bookId, $title, $authorId, $categoryId, $publicationYear, $numPages, $imageUrl);

        if ($result) {
            $_SESSION['editBookSuccess'] = 'Book edited successfully';
            header('Location: admin-panel.php#manageBooks');
            exit();
        } else {
            $_SESSION['editBookErrors'] = ['book' => "Error editing book. Please try again."];
            header('Location: admin-panel.php#manageBooks');
            exit();
        }
    }

    if (isset($_POST['softDeleteBook'])) {
        $result = $bookModel->deleteBook($bookId);

        if ($result) {
            $_SESSION['softDeleteBookSuccess'] = 'Book removed successfully';
            header('Location: admin-panel.php#manageBooks');
            exit();
        } else {
            $_SESSION['softDeleteBookErrors'] = ['book' => "Error soft-deleting book. Please try again."];
            header('Location: admin-panel.php#manageBooks');
            exit();
        }
    }
}
