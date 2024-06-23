<?php
session_start();

use App\Classes\User\User;

require_once("../imports.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatedPassword = $_POST['repeatpassword'];

    $errors = [];

    if (empty($username)) {
        $errors['username'] = 'Username cannot be empty.';
    } elseif (!preg_match('/^[a-zA-Z][a-zA-Z0-9]{4,}$/', $username)) {
        $errors['username'] = 'Invalid username. It must start with a letter and have at least 5 characters.';
    }

    if (empty($password)) {
        $errors['password'] = 'Password cannot be empty.';
    } elseif (!preg_match('/^[a-zA-Z]\w{4,}$/', $password)) {
        $errors['password'] = 'Invalid password. It must start with a letter and have at least 5 characters.';
    }

    if ($password !== $repeatedPassword) {
        $errors['repeatPassword'] = 'Passwords do not match.';
    }

    $userObj = new User();

    if ($userObj->isUsernameTaken($username)) {
        $errors['usernameTaken'] = 'This username is already taken. Please choose another one.';
    }

    if (!empty($errors)) {
        $_SESSION['registerErrors'] = $errors;
        header('Location: ../register.php');
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $userObj->createUser($username, $hashedPassword);
    $_SESSION['registerSuccess'] = 'User created successfully,<br>go ahead and log yourself in.<br>
    <a href="./login.php" class="text-success-emphasis link-underline link-underline-opacity-0">Login Page</a>';

    header('Location: ../register.php');
    exit();
}

header('Location: ../register.php');
exit();
