<?php

namespace App\Models;

use Core\Model;

class Comment extends Model
{
    protected static $table = 'comments';

    private $textContent;
    private $fn;
    private $isVisible;
    private $pending;

   // private $conn;

    public function __construct($textContent, $fn)
    {
        $this->textContent = $textContent;
        $this->fn = $fn;
        //$this->isVisible = $isVisible;
        $this->conn = \Core\Database::getConnection();
    }

    public function getTextContent()
    {
        return $this->textContent;
    }
    public function getFN()
    {
        return $this->fn;
    }
    public function getIsVisible()
    {
        return $this->isVisible;
    }
    public function getConn()
    {
        return $this->conn;
    }
    public function getPending()
    {
        return $this->pending;
    }
    public function setIsVisible($is_visible)
    {
        $this->isVisible = $is_visible;
    }
    public function setPending($is_pending)
    {
        $this->pending = $is_pending;
    }
    public function setTextContent($text_content)
    {
        $this->textContent = $text_content;
    }
    public function setFN($facultyNumber)
    {
        $this->fn = $facultyNumber;
    }

    public function comment_exists()
    {
        $query = [];
        $sql = "SELECT * FROM comments WHERE textContent=:textContent AND fn=:fn";
        $preparedStmt = $this->getConn()->prepare($sql);
        try {
            $preparedStmt->execute(["textContent" => $this->getTextContent(), "fn" => $this->getFN()]);
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
            return $query;
        }
        $comments_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if ($comments_assoc) {
            $query = ["successfullyExecuted" => true, "commentExists" => true];
            return $query;
        } else {
            $query = ["successfullyExecuted" => true, "commentExists" => false];
            return $query;
        }
    }

    public function createComment($eventID)
    {
        $sql = "INSERT INTO `comments`(`content`, `event_id`, `fn`, `pending`)
                VALUE(:textContent, :eventID :fn, :pending)";
        $preparedStmt = $this->getConn()->prepare($sql);
        $query = [];

        try {
            $preparedStmt->execute([
                "textContent" => $this->textContent,
                "event_id" => $eventID,
                "fn" => $this->fn,
                "pending" => 1
            ]);
            $query = ["successfullyExecuted" => true];
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }

        return $query;
    }

    public static function extractEventsWithPendingComments(){
        $sql = "SELECT * FROM events WHERE id IN (SELECT event_id FROM comments WHERE pending = 1)";
        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
        try {
            $preparedStmt->execute();
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
                return $query;
        }

        $events_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if ($events_assoc) {
            $query = ["successfullyExecuted" => true, "thereAreEvents" => true, 
            "eventsWithPendingComments" => $events_assoc, "numberOfComments" => count($events_assoc)];
            return $query;
        } else {
            $query = ["successfullyExecuted" => true, "thereAreEvents" => false];
            return $query;
        }
        
    }
    public function extractEventsWithoutPendingComments(){
        $sql = "SELECT * FROM events WHERE id IN (SELECT event_id FROM comments WHERE pending = 0)";
        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
        try {
            $preparedStmt->execute();
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
                return $query;
        }

        $events_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if ($events_assoc) {
            $query = ["successfullyExecuted" => true, "thereAreEvents" => true, 
            "eventsWithPendingComments" => $events_assoc];
            return $query;
        } else {
            $query = ["successfullyExecuted" => true, "thereAreEvents" => false];
            return $query;
        }
    }
}
