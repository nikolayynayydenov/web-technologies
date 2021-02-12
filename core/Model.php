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

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
        $this->conn = Database::getConnection();
    }

    /**
     * TODO: insert multiple rows with single query
     * 
     * @param array $data
     * @return self
     */
    public static function insert(array $data)
    {
        $sql =  'INSERT INTO ' . self::getTableName() .
            ' (' . implode(', ', array_keys($data)) .
            ') VALUES (' .
            implode(', ', array_fill(0, count($data), '?')) . ');';

        $conn = Database::getConnection();

        $stmt = $conn->prepare($sql);

        $result = $stmt->execute(array_values($data));

        if (!$result) {
            throw new DbException('DB problem');
        }

        $modelClass = get_called_class();
        $model = new $modelClass();
        $data['id'] = intval($conn->lastInsertId());
        $model->setAttributes($data);
        return $model;
    }
    public function save()
    {
        self::insert($this->attributes);
    }

    /**
     * Check if a given model exists in the database,
     * based on the current attributes
     * 
     * @param array $attributes
     */
    public static function exists(array $attributes)
    {
        return !is_null(self::get($attributes));
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

    /**
     * Get a single record by an array of columns
     * 
     * @param array $columns
     * @return self|null
     */
    public static function get($columns)
    {
        $sql = 'SELECT * FROM ' . self::getTableName();
        $sql .=  self::generateWhereSql($columns);
        $stmt = Database::getConnection()->prepare($sql);

        $stmt->execute($columns);

        $result = $stmt->fetch();

        if ($result !== false) {
            $modelClass = get_called_class();
            $model = new $modelClass();
            $model->attributes = $result;
            return $model;
        }

        return null;
    }

    /**
     * Update a given model
     * 
     * @param array $data The new values
     */
    public function update(array $data): void
    {
        $sql = 'UPDATE ' . self::getTableName() . ' SET ';
        $i = 0;
        $colLen = count($data);

        foreach ($data as $column => $value) {
            $sql .= "$column = :$column";

            if ($i !== $colLen - 1) {
                $sql .= ", ";
            }

            $i++;
        }
        $sql .= ' WHERE id = :id;';

        $stmt = Database::getConnection()->prepare($sql);

        if (!$stmt) {
            throw new DbException('DB problem');
        }

        $result = $stmt->execute(array_merge($data, [
            'id' => $this->id
        ]));

        if (!$result) {
            throw new DbException('DB problem');
        }
    }

    public function delete(): void
    {
        //
    }

    /**
     * Get all records by an array of columns
     * 
     * @param array $columns
     * @return array array of models
     */
    public static function getMany($columns)
    {
        $sql = 'SELECT * FROM ' . self::getTableName();
        $sql .=  self::generateWhereSql($columns);
        $stmt = Database::getConnection()->prepare($sql);

        $stmt->execute($columns);

        $results = $stmt->fetchAll();

        if ($results !== false) {
            return array_map(function ($result) {
                $modelClass = get_called_class();
                $model = new $modelClass();
                $model->attributes = $result;
                return $model;
            }, $results);
        }

        return [];
    }

    /**
     * @param @data
     * @return void
     */
    public function setAttributes(array $data)
    {
        $this->attributes = $data;
    }

    /**
     * @param array $columns
     * @return string
     */
    protected static function generateWhereSql(array $columns)
    {
        $sql = ' WHERE ';
        $colLen = count($columns);

        $i = 0;
        foreach ($columns as $column => $value) {
            $sql .= "$column = :$column";

            if ($i !== $colLen - 1) {
                $sql .= " AND ";
            }

            $i++;
        }
        $sql .= ';';

        return $sql;
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
