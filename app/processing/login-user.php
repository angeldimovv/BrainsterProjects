<?php

use App\Classes\User\User;

require_once("../imports.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userObj = new User();

    $user = $userObj->validateUser($username, $password);

    if ($user) {
        $_SESSION['user'] = $user;

        if ($user['role'] === 'admin') {
            $_SESSION['loginStatus'] = true;
            $_SESSION['userRole'] = 'admin';
            header("Location: ../dashboard.php");
            exit();
        }

        $_SESSION['loginStatus'] = true;
        header('Location: ../index.php');
        exit();
    }

    header('Location: ../login.php?error=1');
    exit();
}

header('Location: ../login.php');
exit();
