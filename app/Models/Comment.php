<?php

namespace App\Models;

use Core\Model;
use Core\Database;


class Comment extends Model
{
    protected static $table = 'comments';

    // private $textContent;
    private $fn;
    // private $isVisible;
    // private $pending;
    // private $teacherId;

    // private $conn;

    public function __construct($textContent = null, $fn = null)
    {
        $this->textContent = $textContent;
        $this->fn = $fn;
        //$this->isVisible = $isVisible;
        //$this->conn = \Core\Database::getConnection();
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
    // public function getConn()
    // {
    //     return $this->conn;
    // }
    public function getPending()
    {
        return $this->pending;
    }
    public function getTeacherId()
    {
        return $this->teacherId;
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
    public function setTeacherId($teacherID)
    {
        $this->teacherId = $teacherID;
    }

    public function comment_exists()
    {
        $query = [];
        $sql = "SELECT * FROM comments WHERE content=:textContent AND faculty_number=:fn";
        $preparedStmt = Database::getConnection()->prepare($sql);
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

    public function createTeacherComment($eventID, $teacherID)
    {
        $sql = "INSERT INTO `comments` (`content`, `event_id`, `teacher_id`, `pending`, `is_visible`) 
                VALUE(:content, :event_id, :teacherId, :pending, :isVisible)";
        $preparedStmt = Database::getConnection()->prepare($sql);
        $query = [];
        try {
            $preparedStmt->execute([
                "content" => $this->getTextContent(),
                "event_id" => $eventID,
                "teacherId" => $teacherID,
                "pending" => 0,
                "isVisible" => 1
            ]);
            $query = ["successfullyExecuted" => true];
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }
        return $query;
    }

    public function createComment($eventID)
    {
        $sql = "INSERT INTO `comments` (`content`, `event_id`, `faculty_number`, `pending`) 
        VALUE(:content, :event_id, :faculty_number, :pending)";
        $preparedStmt = Database::getConnection()->prepare($sql);
        $query = [];

        try {
            $preparedStmt->execute([
                "content" => $this->textContent,
                "event_id" => $eventID,
                "faculty_number" => $this->fn,
                "pending" => 1
            ]);
            $query = ["successfullyExecuted" => true];
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }

        return $query;
    }

    public static function extractEventsWithPendingComments($teacherId)
    {
        $sql = "SELECT * FROM events WHERE id IN (SELECT event_id FROM comments WHERE pending = 1) AND teacher_id=:teacherId";
        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
        try {
            $preparedStmt->execute(["teacherId" => $teacherId]);
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
            return $query;
        }

        $events_assoc = $preparedStmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($events_assoc) {
            $query = [
                "successfullyExecuted" => true, "thereAreEvents" => true,
                "eventsWithPendingComments" => $events_assoc, "numberOfComments" => count($events_assoc)
            ];
            return $query;
        } else {
            $query = ["successfullyExecuted" => true, "thereAreEvents" => false];
            return $query;
        }
    }


    public static function extractEventsWithoutPendingComments($teacherId)
    {
        $sql = "SELECT * FROM events 
                WHERE id IN ( 
                    SELECT event_id FROM comments 
                    WHERE pending != 1 
                ) AND teacher_id = :teacherId";
        
        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
        try {
            $preparedStmt->execute(["teacherId" => $teacherId]);
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
            return $query;
        }

        $events_assoc = $preparedStmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($events_assoc) {
            $query = [
                "successfullyExecuted" => true, "thereAreEvents" => true,
                "eventsWithoutPendingComments" => $events_assoc
            ];
            return $query;
        } else {
            $query = ["successfullyExecuted" => true, "thereAreEvents" => false];
            return $query;
        }
    }
}
