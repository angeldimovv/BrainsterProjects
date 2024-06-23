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
    $firstName = ucfirst(trim($_POST['firstName']));
    $lastName = ucfirst(trim($_POST['lastName']));
    $bio = ucfirst(trim($_POST['bio']));

    $errors = [];

    if (empty($firstName)) {
        $errors['firstName'] = "First name cannot be empty.";
    } elseif (preg_match('/[0-9]/', $firstName)) {
        $errors['firstName'] = "First name cannot contain numbers.";
    }

    if (empty($lastName)) {
        $errors['lastName'] = "Last name cannot be empty.";
    } elseif (preg_match('/[0-9]/', $lastName)) {
        $errors['lastName'] = "Last name cannot contain numbers.";
    }

    if (empty($bio)) {
        $errors['bio'] = "Bio cannot be empty.";
    }

    $existingAuthor = $authorObj->getAuthorByName($firstName, $lastName);
    if ($existingAuthor) {
        $errors['authorExists'] = 'This author already exists.';
    }

    if (!empty($errors)) {
        $_SESSION['createAuthorErrors'] = $errors;
        header('Location: ../dashboard.php#manageAuthors');
        exit();
    }

    $result = $authorObj->addAuthor($firstName, $lastName, $bio);

    if ($result) {
        $_SESSION['createAuthorSuccess'] = 'Author added successfully';
        header('Location: ../dashboard.php#manageAuthors');
        exit();
    } else {
        $_SESSION['createAuthorErrors'] = ['author' => "Error creating author. Please try again."];
        header('Location: ../dashboard.php#manageAuthors');
        exit();
    }
} else {
    header('Location: ../dashboard.php');
    exit();
}
