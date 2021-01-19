<?php

namespace Core;

use Core\Exceptions\DbException;

abstract class Model
{
    /**
     * @var string The name of the DB table
     */
    protected static $table;
    protected $conn;
    protected $attributes = [];

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    /**
     * TODO: insert multiple rows with single query
     * 
     * @param array $data
     * @return void
     */
    public static function insert(array $data)
    {
        $sql =  'INSERT INTO ' . self::getTableName() .
            ' (' . implode(', ', array_keys($data)) .
            ') VALUES (' .
            implode(', ', array_fill(0, count($data), '?')) . ');';

        $stmt = Database::getConnection()->prepare($sql);

        $result = $stmt->execute(array_values($data));

        if (!$result) {
            throw new DbException('DB problem');
        }
    }

    public function save()
    {
        self::insert($this->attributes);
    }

    /**
     * @param int $id
     * @return self|null
     */
    public static function getById(int $id)
    {
        $stmt = Database::getConnection()->prepare(
            'SELECT * FROM ' . self::getTableName() . ' WHERE id = ?;'
        );

        $stmt->execute([$id]);

        $result = $stmt->fetch();

        if ($result !== false) {
            $modelClass = get_called_class();
            $model = new $modelClass();
            $model->attributes = $result;
            return $model;
        }

        return null;
    }

    public function update(array $data): void
    {
        //
    }

    public function delete(): void
    {
        //
    }

    protected static function getTableName()
    {
        if (isset(get_called_class()::$table)) {
            return get_called_class()::$table;
        }

        throw new \Exception('Unknown table');
    }

    public function __get($name)
    {
        return array_key_exists($name, $this->attributes)
            ? $this->attributes[$name]
            : null;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}
