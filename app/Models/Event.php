<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class Event extends Model
{
    protected static $table = 'events';

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
        $this->conn = Database::getConnection();
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
    
    /**
     * @param array $columns  
     * @return array
     */
    public static function getManyWithAttendance($columns)
    {
        $events = self::getMany($columns);

        foreach ($events as $event) {
            $event->attendances = Attendance::getMany([
                'event_id' => $event->id
            ]);
        }

        return $events;
    }
}
