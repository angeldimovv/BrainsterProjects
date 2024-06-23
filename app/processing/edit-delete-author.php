<?php
require_once("../imports.php");

use App\Classes\Author\Author;

if (!$_SESSION['loginStatus']) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['loginStatus'] && $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authorObj = new Author();
    $authorId = $_POST['authorId'];
    $firstName = ucfirst(trim($_POST['editFirstName']));
    $lastName = ucfirst(trim($_POST['editLastName']));
    $bio = ucfirst(trim($_POST['editBio']));

    $errors = [];

    if (isset($_POST['editAuthor'])) {
        if (empty($firstName)) {
            $errors['editFirstName'] = "First name cannot be empty.";
        } elseif (preg_match('/[0-9]/', $firstName)) {
            $errors['editFirstName'] = "First name cannot contain numbers.";
        }

        if (empty($lastName)) {
            $errors['editLastName'] = "Last name cannot be empty.";
        } elseif (preg_match('/[0-9]/', $lastName)) {
            $errors['editLastName'] = "Last name cannot contain numbers.";
        }

        if (empty($bio)) {
            $errors['editBio'] = "Bio cannot be empty.";
        }

        if (!empty($errors)) {
            $_SESSION['editAuthorErrors'] = $errors;
            header('Location: ../dashboard.php#manageAuthors');
            exit();
        }

        $result = $authorObj->updateAuthor($authorId, $firstName, $lastName, $bio);

        if ($result) {
            $_SESSION['editAuthorSuccess'] = 'Author edited successfully';
            header('Location: ../dashboard.php#manageAuthors');
            exit();
        } else {
            $_SESSION['editAuthorErrors'] = ['author' => "Error editing author. Please try again."];
            header('Location: ../dashboard.php#manageAuthors');
            exit();
        }
    }

    if (isset($_POST['softDeleteAuthor'])) {
        $authorId = $_POST['authorId'];
        $result = $authorObj->deleteAuthor($authorId);

        if ($result) {
            $_SESSION['softDeleteAuthorSuccess'] = 'Author removed successfully.';
            header('Location: ../dashboard.php#manageAuthors');
            exit();
        } else {
            $_SESSION['softDeleteAuthorErrors'] = "Error soft-deleting author. Please try again.";
            header('Location: ../dashboard.php#manageAuthors');
            exit();
        }
    }
}
