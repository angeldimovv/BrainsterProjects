<?php
require_once("../imports.php");

use App\Classes\Category\Category;

if (!$_SESSION['loginStatus']) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['loginStatus'] && $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryObj = new Category();
    $categoryName = strtoupper(trim($_POST['categoryName']));

    $errors = [];

    if (empty($categoryName)) {
        $errors['categoryName'] = "Category name cannot be empty.";
    }

    $existingCategory = $categoryObj->getCategoryByName($categoryName);
    if ($existingCategory) {
        $errors['categoryExists'] = 'This category already exists, please check and try again';
    }

    if (!empty($errors)) {
        $_SESSION['createCategoryErrors'] = $errors;
        header('Location: ../dashboard.php#manageCategories');
        exit();
    }

    $result = $categoryObj->addCategory($categoryName);

    if ($result) {
        $_SESSION['createCategorySuccess'] = 'Category added successfully';
        header('Location: ../dashboard.php#manageCategories');
        exit();
    } else {
        $_SESSION['createCategoryErrors'] = ['category' => "Error creating category. Please try again."];
        header('Location: ../dashboard.php#manageCategories');
        exit();
    }
} else {
    header('Location: ../dashboard.php');
    exit();
}
