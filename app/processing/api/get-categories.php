<?php
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../../imports.php");

use App\Classes\Category\Category;

if ($_SERVER['REQUEST_METHOD'] = 'GET') {
    if (isset($_GET['categories'])) {
        $categoryObj = new Category();
        $categories = $categoryObj->getAllCategories();
        echo json_encode($categories);
    }

    if (isset($_GET['categoryId'])) {
        $categoryObj = new Category();
        $category = $categoryObj->getCategoryById($_GET['categoryId']);
        echo json_encode($category);
    }
}
