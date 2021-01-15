<?php

namespace App\Models;

use Core\Model;
 
class Comment extends Model
{
    protected static $table = 'comments';

    private $textContent;
    private $fn;
    private $isVisible;

    private $conn;

    public function __construct($textContent, $fn, $isVisible){
        $this->textContent = $textContent;
        $this->fn = $fn;
        $this->isVisible = $isVisible;
        $this->conn = \Core\Database::getConnection();
    }

    public function getTextContent(){
        return $this->textContent;
    }
    public function getFN(){
        return $this->fn;
    }
    public function getIsVisible(){
        return $this->isVisible;
    }
    public function getConn(){
        return $this->conn;
    }

    public function exists(){
        $query = [];
        $sql = "SELECT * FROM comments WHERE textContent=:textContent AND fn=:fn";
        $preparedStmt = $this->getConn()->prepare($sql);
        try{
            $preparedStmt->execute(["textContent" => $this->getTextContent(), "fn" => $this->getFN()]);
        }catch(\PDOException $e){
            $errMsg = $e->getMessage();
            $query = ["sucessfullyExecuted" => false, "errMessage" => $errMsg];
            return $query;
        }
        $comments_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if($comments_assoc){
            $query = ["sucessfullyExecuted" => true, "commentExists" => true];
            return $query;
        }
        else{
            $query = ["sucessfullyExecuted" => true, "commentExists" => false];
            return $query;
        }
    }

    public function createComment(){
        $sql = "INSERT INTO `comments`(`textContent`, `fn`, `isVisible`)
                VALUE(:textContent, :fn, :isVisible)";
        $preparedStmt = $this->getConn()->prepare($sql);
        $query =[];

        try {
            $preparedStmt->execute(["textContent" => $this->getTextContent(), 
                                    "fn" => $this->getFN(), 
                                    "isVisible" => $this->getIsVisible]);
            $query = ["successfullyExecuted" => true]; 
        } catch(\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }

        return $query;
    }

}