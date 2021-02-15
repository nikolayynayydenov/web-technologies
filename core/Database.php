<?php

namespace Core;

use Core\Exceptions\DbException;
use PDO;
use PDOStatement;

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

    public static function inst()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $sql
     * @return PDOStatement
     */
    public function query($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);

        $result = $stmt->execute($params);

        if ($result === false) {
            throw new DbException('Query exception');
        }

        return $stmt;
    }

    /**
     * Perform a select query 
     * @param string $sql
     */
    public function select($sql, $params = [])
    {
        $stmt = $this->query('SELECT ' . $sql, $params);

        return $stmt->fetchAll();
    }
}
