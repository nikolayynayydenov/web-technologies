<?php

namespace App\Models;

use Core\Model;

 
class Event extends Model
{
    protected static $table = 'events';

    private $eventName;
    private $teacher;
    private $eventDate;
    private $eventStart;
    private $eventEnd;
    private $description;
    private $conn;

    public function __construct($eventName, $teacher, $eventDate, $eventStart, $eventEnd, $description){
        $this->eventName = $eventName;
        $this->teacher = $teacher;
        $this->eventDate = $eventDate;
        $this->eventStart = $eventStart;
        $this->eventEnd = $eventEnd;
        $this->description = $description;
        $this->conn = \Core\Database::getConnection();
    }

    public function getEventName(){
        return $this->eventName;
    }
    public function getTeacher(){
        return $this->teacher;
    }
    public function getEventdate(){
        return $this->eventDate;
    }
    public function getEventStart(){
        return $this->eventStart;
    }
    public function getEventEnd(){
        return $this->eventEnd;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getConn(){
        return $this->conn;
    }

    public function eventOverlapsWithAnotherEvent(){
        $query=[];
        $sql = "SELECT * FROM events WHERE eventDate=:eventDate AND 
        ((eventStart <= :eventStart AND eventEnd > :eventStart) OR (eventStart >= :eventStart AND eventStart < :eventEnd))";
        $preparedStmt = $this->getConn()->prepare($sql);

        try {
            $preparedStmt->execute(["eventDate" => $this->getEventDate(), 
            "eventStart" => $this->getEventStart(), "eventEnd" => $this->getEventEnd()]);

            //$query = ["sucessfullyExecuted" => true];
        } catch(\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["sucessfullyExecuted" => false, "errMessage" => $errMsg];
            return $query;
        }

        $event_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if($event_assoc){
            $query = ["sucessfullyExecuted" => true, "eventOverlapsWithAnotherEvent" => true];
            return $query;
        }
        else{
            $query = ["sucessfullyExecuted" => true, "eventOverlapsWithAnotherEvent" => false];
            return $query;
        }
    }

    public function createEvent(){
        $sql = "INSERT INTO `events`(`eventName`, `teacher`, `eventDate`, `eventStart`, `eventEnd`, `description`)
                VALUE(:eventName, :teacher, :eventDate, :eventStart, :eventEnd, :description)";
        $preparedStmt = $this->getConn()->prepare($sql);
        $query =[];

        try {
            $preparedStmt->execute(["eventName" => $this->getEventName(),
                                    "teacher" => $this->getTeacher(),
                                    "eventDate" => $this->getEventDate(),
                                    "eventStart" => $this->getEventStart(),
                                    "eventEnd" => $this->getEventDate(), 
                                    "description" => $this->getDescription()]);
            $query = ["successfullyExecuted" => true]; 
        } catch(\PDOException $e) {
            $errMsg = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }

        return $query;
    }

    public function extractAllEvents(){
        $sql = "SELECT * FROM events";
        $preparedStmt = $this->getConn()->prepare($sql);
        $query = [];

        try{
            $preparedStmt->execute();
            $query = ["successfullyExecuted" => true];
        } catch(\PDOException $e){
            $errMsg  =$e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }

        $arrayEvents = [];
        $events_assoc = $preparedStmt->fetch(\PDO::FETCH_ASSOC);
        if($events_assoc){
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
        }
        else{
            $query = ["sucessfullyExecuted" => true, "noEvents" => true];
            return $query;
        }
    }
}