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
            "SELECT * FROM category WHERE is_deleted IS NULL AND id = :categoryId",
            ["categoryId" => $categoryId]
        )->fetch();
        $db->kill();

        return $category;
    }
}
