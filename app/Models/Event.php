<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class Event extends Model
{
    protected static $table = 'events';

    private $eventName;
    private $teacher;
    private $eventDate;
    private $eventStart;
    private $eventEnd;
    private $description;

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
        $this->conn = Database::getConnection();
    }

    public function getEventName()
    {
        return $this->eventName;
    }
    public function getTeacher()
    {
        return $this->teacher;
    }
    public function getEventdate()
    {
        return $this->eventDate;
    }
    public function getEventStart()
    {
        return $this->eventStart;
    }
    public function getEventEnd()
    {
        return $this->eventEnd;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getConn()
    {
        return $this->conn;
    }

    public function eventOverlapsWithAnotherEvent()
    {
        $query = [];
        $sql = "SELECT * FROM events WHERE date=:eventDate AND 
        ((start <= :eventStart AND end > :eventStart) OR (start >= :eventStart AND start < :eventEnd))";
        $preparedStmt = $this->getConn()->prepare($sql);

        try {
            $preparedStmt->execute([
                "eventDate" => $this->date,
                "eventStart" => $this->start,
                "eventEnd" => $this->end
            ]);

            //$query = ["sucessfullyExecuted" => true];
        } catch (\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
            return $query;
        }

        $event_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if ($event_assoc) {
            $query = ["successfullyExecuted" => true, "eventOverlapsWithAnotherEvent" => true];
            return $query;
        } else {
            $query = ["successfullyExecuted" => true, "eventOverlapsWithAnotherEvent" => false];
            return $query;
        }
    }

    // public function createEvent()
    // {
    //     $sql = "INSERT INTO `events`(`name`, `teacher_id`, `date`, `start`, `end`, `description`)
    //             VALUE(:name, :teacher_id, :eventDate, :eventStart, :eventEnd, :description)";
    //     $preparedStmt = $this->getConn()->prepare($sql);
    //     $query = [];

    //     try {
    //         $preparedStmt->execute([
    //             "eventName" => $this->getEventName(),
    //             "teacher" => $this->getTeacher(),
    //             "eventDate" => $this->getEventDate(),
    //             "eventStart" => $this->getEventStart(),
    //             "eventEnd" => $this->getEventDate(),
    //             "description" => $this->getDescription()
    //         ]);
    //         $query = ["successfullyExecuted" => true];
    //     } catch (\PDOException $e) {
    //         $errMsg = $e->getMessage();
    //         $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
    //     }

    //     return $query;
    // }

    public function extractAllEvents()
    {
        $sql = "SELECT * FROM events";
        $preparedStmt = $this->getConn()->prepare($sql);
        $query = [];

        try {
            $preparedStmt->execute();
            $query = ["successfullyExecuted" => true];
        } catch (\PDOException $e) {
            $errMsg  = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }

        $arrayEvents = [];
        $events_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if ($events_assoc) {
            $query = ["sucessfullyExecuted" => true];
            //foreach($events_assoc as $event){
            // $query[] = ["eventName" => $event->getEventName(), 
            //             "teacher" => $event->getTeacher(), 
            //             "eventDate" => $event->getEventDate(), 
            //             "eventStart" => $event->getEventStart(), 
            //             "eventEnd" => $event->getEventEnd(), 
            //             "description" => $event->getDescription()];
            // $eventsArray[] = __construct($event->getEventName(), $event->getTeacher(), 
            //             $event->getEventDate(), $event->getEventStart(), $event->getEventEnd(), $event->getDescription());
            //}

            // За всяко извлечено събитие създаваме html елемент от следния вид:
            // <li><p>CSS, 02/12/2020, 13:15- 15:00</p>
            //     <div style="display: none;">
            //         <h5>Списък с присъствали студенти</h5>
            //         <ol>
            //             <li>81888 Иван Иванов</li>
            //             <li>81555 Петя Тодорова</li>
            //         </ol>
            //     </div>
            // </li>
            // и този елемент го добавяме към DOM дървото
            return $query;
        } else {
            $query = ["sucessfullyExecuted" => true, "noEvents" => true];
            return $query;
        }
    }

    /**
     * @param int $facultyNumber
     * @return array
     */
    public static function getAllByFn($facultyNumber)
    {
        $stmt = Database::getConnection()->prepare(
            'SELECT events.* FROM attendance
            INNER JOIN events ON attendance.event_id = events.id            
            WHERE attendance.faculty_number = ?
            GROUP BY events.id'
        );

        $stmt->execute([$facultyNumber]);
        $results = $stmt->fetchAll();

        if ($results === false) {
            throw new \Exception('DB problem');
        }

        return $results;
    }
}
