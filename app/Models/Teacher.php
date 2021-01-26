<?php

namespace App\Models;

use Core\Model;

class Teacher extends Model
{
    protected static $table = 'teachers';

    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $confirmPassword;
    //private $conn;

    // public function __construct($firstName, $lastName, $email, $password)
    // {
    //     $this->firstName = $firstName;
    //     $this->lastName = $lastName;
    //     $this->email = $email;
    //     $this->password = $password;
    //     $this->conn = \Core\Database::getConnection();
    // }

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->conn = \Core\Database::getConnection();
    }


    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }
    public function getConn()
    {
        return $this->conn;
    }
    public function setPassword($pass)
    {
        $this->password = $pass;
    }
    public function getTeacherId(){
        return $this->teacherId;
    }
    public function setEmail($email1){
        $this->email = $email1;
    }
    public function setFirstName($firstName1){
        $this->firstName = $firstName1;
    }
    public function setLastName($lastName1){
        $this->lastName = $lastName1;
    }


    public function teacherExists()
    {
        $query = [];
        $sql = "SELECT * FROM teachers WHERE email=:email";
        $preparedStmt = $this->getConn()->prepare($sql);
        try {
            $preparedStmt->execute(["email" => $this->getEmail()]);
            //$query = ["successfullyExecuted" => true];
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
            return $query;
        }

        $teacher_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if ($teacher_assoc) {
            $query = ["successfullyExecuted" => true, "teacherExists" => true];
            return $query;
        } else {
            $query = ["successfullyExecuted" => true, "teacherExists" => false];
            return $query;
        }
    }

    public function createTeacher($email1, $passwordHash, $firstName1, $lastName1)
    {
        $sql = "INSERT INTO `teachers` (`email`, `password`, `first_name`, `last_name`) 
                VALUES (:email, :passwordHash, :firstName, :lastName);";
        $preparedStmt = $this->getConn()->prepare($sql);
        $query = [];
        try {
            $preparedStmt->execute([
                "email" => $email1/*$this->getEmail()*/,
                "passwordHash" => $passwordHash,
                "firstName" => $firstName1/*$this->getFirstName()*/,
                "lastName" => $lastName1/*$this->getLastName()*/
            ]);
            $query = ["successfullyExecuted" => true];
            $this->setEmail($email1);
            $this->setFirstName($firstName1);
            $this->setLastName($lastName1);
            $this->setPassword($passwordHash);
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }
        return $query;
    }

    public function isValid(){
        $sql = "SELECT * FROM teachers WHERE email=:email AND password=:pass";
        $preparedStmt = $this->getConn()->prepare($sql);
        try {
            $preparedStmt->execute(["email" => $this->getEmail(), "pass" => $this->getPassword()]);
            //$query = ["successfullyExecuted" => true];
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
            return $query;
        }

        $teacher_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if ($teacher_assoc) {
            $query = ["successfullyExecuted" => true, "teacherIsValid" => true];
            return $query;
        } else {
            $query = ["successfullyExecuted" => true, "teacherIsValid" => false];
            return $query;
        }
    }

    public function getOwnEvents()
    {
        return [];
    }
}
