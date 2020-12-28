<?php

namespace Core;

abstract class Model
{
    /**
     * @var string The name of the DB table
     */
    protected $table;
    protected $conn;
    protected $attributes = [];

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function insert(array $data): void
    {
        //
    }

    /**
     * @param int $id
     * @return bool success or not
     */
    public function getById(int $id): bool
    {
        $stmt = $this->conn->prepare(
            'SELECT * FROM ' . $this->getTableName() . ' WHERE id = ?'
        );

        $stmt->execute([$id]);

        $result = $stmt->fetch();

        if ($result !== false) {
            $this->attributes = $result;
        }

        return (bool) $result;
    }

    public function update(array $data): void
    {
        //
    }

    public function delete(): void
    {
        //
    }

    protected function getTableName()
    {
        if (isset($this->table)) {
            return $this->table;
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
