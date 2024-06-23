<?php
require_once '../imports.php';

use App\Classes\Comment\Comment;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user'])) {
        echo json_encode(['success' => false, 'message' => 'You must be logged in to submit a comment']);
        exit();
    }

    $userId = $_SESSION['user']['id'];
    $bookId = isset($_POST['bookId']) ? $_POST['bookId'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;

    $commentModel = new Comment();
    $existingComments = $commentModel->getCommentsByUserAndBook($userId, $bookId);

    if (!empty($existingComments)) {
        echo json_encode(['success' => false, 'message' => 'You have already submitted a comment for this book']);
        exit();
    }

    $success = $commentModel->createComment($userId, $bookId, $content);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Comment submitted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error submitting comment, you are allowed one comment for a particular book']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
