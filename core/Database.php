<?php

namespace Core;

use PDO;

class Database
{
    private static $instance = null;
    public $connection;

    private function __construct()
    {
        $db = config('database');

        $this->connection = new PDO(
            'mysql:host=' . $db['host'] . ';dbname=' . $db['database'],
            $db['user'],
            $db['password'],
            $db['pdo']
        );

        self::$instance = $this;
    }

    public static function getConnection()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance->connection;
    }
}
