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
            "SELECT * FROM author WHERE is_deleted IS NULL AND id = :authorId",
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

    public function addAuthor($firstName, $lastName, $bio)
    {
        $db = new Connection();
        $result = $db->run(
            "INSERT INTO author (first_name, last_name, bio)
            VALUES (:firstName, :lastName, :bio)",
            [
                "firstName" => $firstName,
                "lastName" => $lastName,
                "bio" => $bio
            ]
        );

        return $result;
    }

    public function updateAuthor($authorId, $firstName, $lastName, $bio)
    {
        $db = new Connection();
        $result = $db->run(
            "UPDATE author
            SET first_name = :firstName,
                last_name = :lastName,
                bio = :bio
            WHERE id = :authorId",
            [
                "firstName" => $firstName,
                "lastName" => $lastName,
                "bio" => $bio,
                "authorId" => $authorId
            ]
        );

        return $result;
    }

    public function deleteAuthor($authorId)
    {
        $db = new Connection();
        $result = $db->run(
            "UPDATE author
            SET is_deleted = 1
            WHERE id = :authorId AND is_deleted IS NULL",
            ["authorId" => $authorId]
        );

        return $result;
    }
}
