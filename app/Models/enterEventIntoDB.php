<?php
    include_once "Event.php";

    $errors = [];
    $result;

    $conn = \Core\Database::getConnection();

    function testInput($input) {
        $input = trim($input);
        $input = htmlspecialchars($input);
        //$input = stripslashes($input);
        return $input;
    }

    if($_POST){
        $eventName = testInput($_POST['name']);
        $teacher = "Teacher"; //трябва да го вземем от формата, с която се е логнал преподавателят
        $eventDate = $_POST['date'];
        $eventStart = $_POST['start'];
        $eventEnd = $_POST['end'];
        $description = $_POST['description'];

        if(!$eventName){
            $errors[] = "Името на събитието е задължително поле!";
        }
        if(strlen($eventName)>150){
            $errors[] = "Името не трябва да е по-дълго от 150 символа! 
                        Използвайте полето за описание, за да дадете повече информация за събитието!";
        }
        if(!$eventDate){
            $errors[] = "Датата на събитието е задължително поле!";
        }
        if(!$eventStart){
            $errors[] = "Началният час на събитието е задължително поле!";
        }
        if(!$eventEnd){
            $errors[] = "Крайният час на събитието е задължително поле!";
        }

        if($eventName && strlen($eventName)<=150 && $eventDate && $eventStart && $eventEnd){
            $event = new Event($eventName, $teacher, $eventDate, $eventStart, $eventEnd, $description);
            $overlaps = $event->eventOverlapsWithAnotherEvent();
            if($ovelaps["successfullyExecuted"] == false){
                $errors[] = "Неуспешна заявка - error message: " . $overlaps["errMessage"];
            }
            else if($overlaps["successfullyExecuted"] == true){
                if($overlaps["eventOverlapsWithAnotherEvent"] == true){
                    $errors[] = "Събитието се припокрива с друго събитие!";
                }
                else if($overlaps["eventOverlapsWithAnotherEvent"] == false){
                    $create = $event->createEvent();
                    if($create["successfullyExecuted"] == false){
                        $errors[] = "Неуспешна заявка за добавяне в базата данни - error message: " . $create["errMessage"];
                    }
                }
            }
        }

        if($errors) {
            foreach ($errors as $error) {
                echo $error;
                echo "<br/>";
            }
            echo "<a href='registerEvent.php'>Кликни тук, за да се върнеш към формата</a>";
        } else {
            echo "Събитието е добавено успешно!";
            echo "<br>";
            echo "<a href='registerEvent.php'>Кликни тук, за да се върнеш към формата</a>";
        }

    }
    else{
        echo "Невалиден тип заявка!";
    }

?>