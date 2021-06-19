<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class Student extends Model
{
    private $id;
    private $firstName;
    private $lastName;
    private $faculty_number;

    protected static $table = 'student';


    public function __construct($fn = null)
    {
        parent::__construct();
        $this->faculty_number = $fn;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getFN()
    {
        return $this->faculty_number;
    }
    public function getConn()
    {
        return $this->conn;
    }
    public function setId($studentId)
    {
        $this->id = $studentId;
    }
    public function setFirstName($last_name)
    {
        $this->lastName = $last_name;
    }
    public function setFN($fn)
    {
        $this->faculty_number = $fn;
    }

    public function isValid()
    {
        $sql = "SELECT * FROM student WHERE faculty_number=:fn";
        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
        $query = [];
        try {
            $preparedStmt->execute(["fn" => $this->getFN()]);
            $query = ["successfullyExecuted" => true];
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }
        $students_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if ($students_assoc) {
            $query = ["successfullyExecuted" => true, "isValid" => true];
        } else {
            $query = ["successfullyExecuted" => true, "isValid" => false];
        }
        return $query;
    }

    public static function getAvatarSrc($fn)
    {
        $src = '/images/avatars/' . $fn . '-student.jpg';

        return file_exists(__DIR__ . '/../../public' . $src)
            ? $src
            : '/images/avatars/default.jpg';
    }
}
