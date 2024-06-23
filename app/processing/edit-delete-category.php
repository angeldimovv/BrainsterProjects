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
    $categoryId = $_POST['categoryId'];
    $categoryName = strtoupper(trim($_POST['editCategoryName']));

    $errors = [];

    if (isset($_POST['editCategory'])) {
        if (empty($categoryName)) {
            $errors['editCategoryName'] = "Category name cannot be empty.";
        }

        if (!empty($errors)) {
            $_SESSION['editCategoryErrors'] = $errors;
            header('Location: ../dashboard.php#manageCategories');
            exit();
        }

        $result = $categoryObj->updateCategory($categoryId, $categoryName);

        if ($result) {
            $_SESSION['editCategorySuccess'] = 'Category edited successfully';
            header('Location: ../dashboard.php#manageCategories');
            exit();
        } else {
            $_SESSION['editCategoryErrors'] = ['category' => "Error editing category. Please try again."];
            header('Location: ../dashboard.php#manageCategories');
            exit();
        }
    }

    if (isset($_POST['deleteCategory'])) {
        $result = $categoryObj->deleteCategory($categoryId);

        if ($result) {
            $_SESSION['deleteCategorySuccess'] = 'Category removed successfully';
            header('Location: ../dashboard.php#manageCategories');
            exit();
        } else {
            $_SESSION['deleteCategoryErrors'] = ['category' => "Error deleting category. Please try again."];
            header('Location: ../dashboard.php#manageCategories');
            exit();
        }
    }
}
