<?php

namespace App\Classes\User;

use App\Database\Connection;

class User
{
    public function createUser($username, $password)
    {
        $db = new Connection();
        $defaultRole = "client";

        $db->run(
            "INSERT INTO user (username, password, role)
            VALUES (:username, :password, :role)",
            [
                "username" => $username,
                "password" => $password,
                "role" => $defaultRole
            ]
        );
    }

    public function getUserId($username)
    {
        $db = new Connection();

        $result = $db->run(
            "SELECT id FROM user WHERE username = :username",
            ["username" => $username]
        )->fetch();

        return $result ? $result['id'] : null;
    }

    public function validateUser($username, $password)
    {
        $db = new Connection();

        $user = $db->run(
            "SELECT * FROM user WHERE username = :username",
            ["username" => $username]
        )->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }

    public function isUsernameTaken($username)
    {
        $db = new Connection();

        $user = $db->run(
            "SELECT * FROM user WHERE username = :username",
            ["username" => $username]
        )->fetch();

        if ($user) {
            return true;
        }

        return false;
    }
}
