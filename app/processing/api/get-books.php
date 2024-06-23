<?php
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once("../../imports.php");

use App\Classes\Book\Book;

if ($_SERVER['REQUEST_METHOD'] = 'GET') {
    if (isset($_GET['books'])) {
        $bookObj = new Book();
        $books = $bookObj->getAllBooks();
        echo json_encode($books);
    }

    if (isset($_GET['bookId'])) {
        $bookObj = new Book();
        $book = $bookObj->getBookById($_GET['bookId']);
        echo json_encode($book);
    }
}
