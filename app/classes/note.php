<?php

namespace App\Classes\Note;

use App\Database\Connection;

class Note
{
    public function getBookIdFromNote($noteId)
    {
        $db = new Connection();
        $result = $db->run(
            "SELECT book_id FROM note WHERE id = :noteId",
            ["noteId" => $noteId]
        )->fetch();
        $db->kill();

        if ($result && isset($result['book_id'])) {
            return $result['book_id'];
        } else {
            return null;
        }
    }

    public function createNote($userId, $bookId, $content)
    {
        $db = new Connection();
        $time = date('Y-m-d H:i:s');

        $result = $db->run(
            "INSERT INTO note (user_id, book_id, content, created_at) 
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
}
