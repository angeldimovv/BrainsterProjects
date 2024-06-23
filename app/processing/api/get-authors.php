<?php
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../../imports.php");

use App\Classes\Author\Author;

if ($_SERVER['REQUEST_METHOD'] = 'GET') {
    if (isset($_GET['authors'])) {
        $authorObj = new Author();
        $authors = $authorObj->getAllAuthors();
        echo json_encode($authors);
    }

    if (isset($_GET['authorId'])) {
        $authorObj = new Author();
        $author = $authorObj->getAuthorById($_GET['authorId']);
        echo json_encode($author);
    }
}
