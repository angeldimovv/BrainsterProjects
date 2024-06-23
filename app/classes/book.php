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

    public function addBook($bookData)
    {
        $db = new Connection();
        $result = $db->run(
            "INSERT INTO book (title, author_id, category_id, publication_year, pages, image_url)
            VALUES (:title, :author_id, :category_id, :publication_year, :pages, :image_url)",
            $bookData
        );
        $db->kill();

        return $result;
    }

    public function modifyBook($bookData)
    {
        $db = new Connection();
        $db->run(
            "UPDATE book
            SET title = :title,
                author_id = :author_id,
                category_id = :category_id,
                publication_year = :publication_year,
                pages = :pages,
                image_url = :image_url
            WHERE id = :bookId",
            $bookData
        );
        $db->kill();
    }

    public function deleteBook($bookId)
    {
        $db = new Connection();
        $db->run(
            "DELETE FROM book 
            WHERE id = :bookId",
            ["bookId" => $bookId]
        );
        $db->kill();
    }
}
