<?php

namespace App\Classes\Book;

use App\Database\Connection;


class Book
{
    public function getAllBooks()
    {
        $db = new Connection();
        $books = $db->run("SELECT * FROM book ORDER BY title ASC")->fetchAll();
        $db->kill();

        return $books;
    }

    public function getBookById($bookId)
    {
        $db = new Connection();
        $book = $db->run(
            "SELECT * FROM book WHERE id = :bookId",
            ["bookId" => $bookId]
        )->fetch();
        $db->kill();

        return $book;
    }

    public function getBookByTitle($title)
    {
        $db = new Connection();
        $book = $db->run(
            "SELECT * FROM book WHERE title = :title",
            ["title" => $title]
        )->fetch();
        $db->kill();

        return $book;
    }

    public function getAllBookDataById($bookId)
    {
        $db = new Connection();
        $data = $db->run(
            "SELECT book.title AS title, book.image_url AS image_url, book.pages AS pages, book.publication_year AS publication_year, 
                  author.first_name AS authorFirstName, author.last_name AS authorLastName, author.bio AS authorBio, author.is_deleted AS author_isDeleted,
                  category.name AS categoryName, category.is_deleted AS category_isDeleted 
                  FROM book
                    JOIN author ON book.author_id = author.id
                    JOIN category on book.category_id = category.id
                    WHERE books.id = :bookId",
            ["bookId" => $bookId]
        )->fetch();
        $db->kill();

        return $data;
    }

    public function addBook($title, $authorId, $categoryId, $publicationYear, $numPages, $imageUrl)
    {
        $db = new Connection();
        $result = $db->run(
            "INSERT INTO book (title, author_id, category_id, publication_year, pages, image_url)
            VALUES (:title, :authorId, :categoryId, :publicationYear, :numPages, :imageUrl)",
            [
                "title" => $title,
                "authorId" => $authorId,
                "categoryId" => $categoryId,
                "publicationYear" => $publicationYear,
                "numPages" => $numPages,
                "imageUrl" => $imageUrl
            ]
        );
        $db->kill();

        return $result;
    }

    public function updateBook($bookId, $title, $authorId, $categoryId, $publicationYear, $numPages, $imageUrl)
    {
        $db = new Connection();
        $result = $db->run(
            "UPDATE book
            SET title = :title,
                author_id = :authorId,
                category_id = :categoryId,
                publication_year = :publicationYear,
                pages = :numPages,
                image_url = :imageUrl
            WHERE id = :bookId",
            [
                "title" => $title,
                "authorId" => $authorId,
                "categoryId" => $categoryId,
                "publicationYear" => $publicationYear,
                "numPages" => $numPages,
                "imageUrl" => $imageUrl,
                "bookId" => $bookId
            ]
        );
        $db->kill();

        return $result;
    }

    public function deleteBook($bookId)
    {
        $db = new Connection();
        $result = $db->run(
            "DELETE FROM book 
            WHERE id = :bookId",
            ["bookId" => $bookId]
        );
        $db->kill();

        return $result;
    }
}
