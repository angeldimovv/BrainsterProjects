<?php

use App\Classes\User\User;

require_once("../imports.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $userObj = new User();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $userObj->validateUser($username, $password);

    if ($user) {
        $_SESSION['user'] = $user;

        if ($user['role'] === 'admin') {
            header("Location: ../dashboard.php");
            exit();
        }

        header('Location: ../index.php');
        exit();
    }

    header('Location: ../login.php?error=1');
    exit();
}

header('Location: ../login.php');
exit();
