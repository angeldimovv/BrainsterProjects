<?php

namespace App\Classes\Comment;

use App\Database\Connection;


class Comment
{
    public function getAllComments()
    {
        $db = new Connection();
        $comments = $db->run("SELECT * FROM comment ORDER BY created_at ASC")->fetchAll();
        $db->kill();

        return $comments;
    }

    public function getCommentById($commentId)
    {
        $db = new Connection();
        $comment = $db->run(
            "SELECT comm.* FROM comment AS comm
                JOIN user ON comm.user_id = user.id
                JOIN book ON comm.book_id = book.id
                WHERE comm.id = :commentId",
            ["commentId" => $commentId]
        )->fetch();
        $db->kill();

        return $comment;
    }

    public function createComment($userId, $bookId, $content)
    {
        $db = new Connection();
        $time = date('Y-m-d H:i:s');
        $result = $db->run(
            "INSERT INTO comment (user_id, book_id, comment_content, created_at) 
            VALUES (:userId, :bookId, :content, :created_at)",
            [
                "userId" => $userId,
                "bookId" => $bookId,
                "content" => $content,
                "created_at" => $time
            ]
        );
        $db->kill();

        return $result;
    }

    public function getPendingComments()
    {
        $db = new Connection();
        $pendingComments = $db->run(
            "SELECT c.*, u.username AS username, b.title AS book_title
            FROM comment c
            JOIN user u ON c.user_id = u.id
            JOIN book b ON c.book_id = b.id
            WHERE c.approved = 0 AND c.denied = 0",
        )->fetchAll();

        return $pendingComments;
    }

    public function getDeniedComments()
    {
        $db = new Connection();
        $deniedComments = $db->run(
            "SELECT c.*, u.username AS username, b.title AS book_title
            FROM comment c
            JOIN user u ON c.user_id = u.id
            JOIN book b ON c.book_id = b.id
            WHERE c.approved = 0 AND c.denied = 1",
        )->fetchAll();

        return $deniedComments;
    }

    public function getApprovedComments()
    {
        $db = new Connection();
        $approvedComments = $db->run(
            "SELECT c.*, u.username AS username, b.title AS book_title
            FROM comment c
            JOIN user u ON c.user_id = u.id
            JOIN book b ON c.book_id = b.id
            WHERE c.approved = 1 AND c.denied = 0",
        )->fetchAll();

        return $approvedComments;
    }

    public function getCommentsByUserAndBook($userId, $bookId)
    {
        $db = new Connection();
        $comments = $db->run(
            "SELECT * FROM comment
            WHERE user_id = :userId AND book_id = :bookId",
            [
                "userId" => $userId,
                "bookId" => $bookId
            ]
        )->fetchAll();
        $db->kill();

        return $comments;
    }

    public function getAllCommentsByBookId($bookId)
    {
        $db = new Connection();
        $comments = $db->run(
            "SELECT comment.id AS comment_id,
                    comment.content,
                    comment.approved,
                    comment.created_at AS comment_created_at,
                    users.id AS user_id,
                    users.username,
                    books.id AS book_id,
                    books.title AS book_title
            FROM comment
            JOIN user ON comment.user_id = user.id
            JOIN book ON comment.book_id = book.id
            WHERE book.id = :bookId AND comment.approved = 1",
            ["bookId" => $bookId]
        )->fetchAll();
        $db->kill();

        return $comments;
    }

    public function approveComment($commentId)
    {
        $db = new Connection();
        $result = $db->run(
            "UPDATE comments 
            SET approved = 1 
            WHERE id = :commentId",
            ["commentId" => $commentId]
        );
        $db->kill();

        return $result;
    }

    public function denyComment($commentId)
    {
        $db = new Connection();
        $result = $db->run(
            "UPDATE comments 
            SET denied = 1 
            WHERE id = :commentId",
            ["commentId" => $commentId]
        );
        $db->kill();

        return $result;
    }
}
