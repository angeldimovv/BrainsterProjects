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
}
