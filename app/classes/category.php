<?php

namespace App\Classes\Category;

use App\Database\Connection;


class Category
{
    public function getAllCategories()
    {
        $db = new Connection();
        $categories = $db->run("SELECT * FROM category WHERE is_deleted IS NULL ORDER BY `name` ASC")->fetchAll();
        $db->kill();

        return $categories;
    }

    public function getCategoryById($categoryId)
    {
        $db = new Connection();
        $category = $db->run(
            "SELECT * FROM category 
            WHERE is_deleted IS NULL AND id = :categoryId",
            ["categoryId" => $categoryId]
        )->fetch();
        $db->kill();

        return $category;
    }

    public function getCategoryByName($name)
    {
        $db = new Connection();
        $category = $db->run(
            "SELECT * FROM category 
            WHERE is_deleted IS NULL AND `name` = :`name`",
            ["name" => $name]
        )->fetch();
        $db->kill();

        return $category;
    }

    public function addCategory($name)
    {
        $db = new Connection();
        $result = $db->run(
            "INSERT INTO category (name)
            VALUES (:`name`)",
            ["name" => $name]
        );
        $db->kill();

        return $result;
    }

    public function updateCategory($categoryId, $name)
    {
        $db = new Connection();
        $result = $db->run(
            "UPDATE category
            SET `name` = :`name`
            WHERE id = :categoryId",
            [
                "name" => $name,
                "categoryId" => $categoryId
            ]
        );
        $db->kill();

        return $result;
    }

    public function deleteCategory($categoryId)
    {
        $db = new Connection();
        $result = $db->run(
            "UPDATE author
            SET is_deleted = 1
            WHERE id = :categoryId AND is_deleted IS NULL",
            ["categoryId" => $categoryId]
        );
        $db->kill();

        return $result;
    }
}
