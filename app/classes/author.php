<?php

namespace App\Classes\Author;

use App\Database\Connection;


class Author
{

    public function getAllAuthors()
    {
        $db = new Connection();
        $authors = $db->run("SELECT * FROM author WHERE is_deleted IS NULL ORDER BY first_name ASC")->fetchAll();
        $db->kill();

        return $authors;
    }

    public function getAuthorById($authorId)
    {
        $db = new Connection();
        $authors = $db->run(
            "SELECT * FROM author WHERE is_deleted=0 AND id = :authorId",
            ["authorId" => $authorId]
        )->fetch();
        $db->kill();

        return $authors;
    }

    public function getAuthorByName($firstName, $lastName)
    {
        $db = new Connection();
        $author = $db->run(
            "SELECT * FROM author WHERE first_name = :firstName AND last_name = :lastName",
            [
                "firstName" => $firstName,
                "lastName" => $lastName
            ]
        );
        return $author->fetch();
    }

    public function addAuthor($authorData)
    {
        $db = new Connection();
        $result = $db->run(
            "INSERT INTO author (first_name, last_name, bio)
            VALUES (:firstName, :lastName, :bio)",
            $authorData
        );

        return $result;
    }
}
