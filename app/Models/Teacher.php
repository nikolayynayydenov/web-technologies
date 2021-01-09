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
    private $conn;

    public function __construct($firstName, $lastName, $email, $password){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->conn = \Core\Database::getConnection();
    }
    public function getFirstName(){
        return $this->firstName;
    }
    public function getLastName(){
        return $this->lastName;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getConfirmPassword(){
        return $this->confirmPassword;
    }
    public function getConn(){
        return $this->conn;
    }
    public function setPassword($pass){
        $this->password = $pass;
    }

    public function teacherExists(){
        $query=[];
        $sql = "SELECT * FROM teachers WHERE email=:email";
        $preparedStmt = $this->getConn()->prepare($sql);
        try {
            $preparedStmt->execute(["email" => $this->getEmail()]);
            //$query = ["sucessfullyExecuted" => true];
        } catch(PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["sucessfullyExecuted" => false, "errMessage" => $errMsg];
            return $query;
        }

        $teacher_assoc = $preparedStmt->fetch(PDO::FETCH_ASSOC);
        if($teacher_assoc){
            $query = ["sucessfullyExecuted" => true, "teacherExists" => true];
            return $query;
        }
        else{
            $query = ["sucessfullyExecuted" => true, "teacherExists" => false];
            return $query;
        }
    }

    public function createTeacher($passwordHash){
        $sql = "INSERT INTO `teachers`(`firstName`, `lastName`, `email`, `password`) 
                VALUE(:firstName, :lastName, :email, :passwordHash)";
        $preparedStmt = $this->getConn()->prepare($sql);
        $query =[];
        try {
            $preparedStmt->execute(["firstName" => $this->getFirstName(),
                                    "lastName" => $this->getLastName(),
                                    "email" => $this->getEmail(), 
                                    "passwordHash" => $passwordHash]);
            $query = ["successfullyExecuted" => true]; 
            $this->setPassword($passwordHash);
        } catch(PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }
        return $query;
    }

}