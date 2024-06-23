<?php

declare(strict_types=1);

namespace App\Database;

class Connection
{
    const HOST = 'localhost';
    const DB_NAME = 'brainster_project';
    const PORT = '3306';
    const USERNAME = 'root';
    const PASSWORD = '';

    protected $instance = null;

    public function __construct()
    {
        $options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];

        $dsn =
            'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';port=' . self::PORT . ';charset=utf8mb4';

        try {
            $this->instance = new \PDO(
                $dsn,
                self::USERNAME,
                self::PASSWORD,
                $options
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public function kill()
    {
        $this->instance = null;
    }

    public function run($sql, $args = null)
    {
        $stmt = $this->instance->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
