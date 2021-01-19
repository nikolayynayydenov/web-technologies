<?php

namespace App\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use Core\Database;

class EventsController
{
    public function create()
    {
        view('events/create');
    }

    public function store()
    {
        $errors = [];
        $result = null;

        $conn = Database::getConnection();

        function testInput($input)
        {
            $input = trim($input);
            $input = htmlspecialchars($input);
            //$input = stripslashes($input);
            return $input;
        }
        $eventName = testInput($_POST['name']);
        $teacher = 1; // TODO: трябва да го вземем от формата, с която се е логнал преподавателят
        $eventDate = $_POST['date'];
        $eventStart = $_POST['start'];
        $eventEnd = $_POST['end'];
        $description = $_POST['description'];

        if (!$eventName) {
            $errors[] = "Името на събитието е задължително поле!";
        }
        if (strlen($eventName) > 150) {
            $errors[] = "Името не трябва да е по-дълго от 150 символа! 
                        Използвайте полето за описание, за да дадете повече информация за събитието!";
        }
        if (!$eventDate) {
            $errors[] = "Датата на събитието е задължително поле!";
        }
        if (!$eventStart) {
            $errors[] = "Началният час на събитието е задължително поле!";
        }
        if (!$eventEnd) {
            $errors[] = "Крайният час на събитието е задължително поле!";
        }

        if ($eventName && strlen($eventName) <= 150 && $eventDate && $eventStart && $eventEnd) {
            $event = new Event([
                'name' => $eventName,
                'teacher_id' => $teacher,
                'date' => $eventDate,
                'start' => "$eventStart:15:00",
                'end' => "$eventEnd:15:00",
                'description' => $description
            ]);

            $overlaps = $event->eventOverlapsWithAnotherEvent();
            if ($overlaps["successfullyExecuted"] == false) {
                $errors[] = "Неуспешна заявка - error message: " . $overlaps["errMessage"];
            } else if ($overlaps["successfullyExecuted"] == true) {
                if ($overlaps["eventOverlapsWithAnotherEvent"] == true) {
                    $errors[] = "Събитието се припокрива с друго събитие!";
                } else if ($overlaps["eventOverlapsWithAnotherEvent"] == false) {
                    $event->save();
                }
            }
        }

        if ($errors) {
            foreach ($errors as $error) {
                echo $error;
                echo "<br/>";
            }
            echo "<a href='/event/create'>Кликни тук, за да се върнеш към формата</a>";
        } else {
            redirect('/event/' . $conn->lastInsertId());
        }
    }

    public function show($id)
    {
        $event = Event::getById($id);

        if ($event) {
            view('/events/show', [
                'event' => $event
            ]);
        } else {
            response('Event not found', 404);
        }
    }

    public function import($id)
    {
        $event = Event::getById($id);

        if ($event) {
            // Validation            
            if (!is_uploaded_file($_FILES['attendance_file']['tmp_name'])) {
                $_SESSION['message'] = 'Моля, изберете файл';
                redirect("/event/$id");
            }

            if ($_FILES['attendance_file']['type'] !== 'text/plain') {
                $_SESSION['message'] = 'Файлът трябва да е с разширение txt';
                redirect("/event/$id");
            }

            $lines = file($_FILES['attendance_file']['tmp_name']);

            /**
             * @var array import mapping
             */
            $m = [
                'event_id' => 0,
                'user_fn_id' => 1,
                'enroll_source' => 2,
                'enroll_datetime' => 3,
                'event_trust' => 4,
                'check_description' => 5
            ];

            foreach ($lines as $line) {
                $arr = preg_split('/\s{3,}/', $line);

                Attendance::insert([
                    'event_id' => $id,
                    'faculty_number' => $arr[$m['user_fn_id']],
                    'logged_at' => $arr[$m['enroll_datetime']],
                    'check_description' => $arr[$m['check_description']],
                    'enroll_source' => $arr[$m['enroll_source']],
                    'thrust' => preg_replace('/[^0-9]/', '', $arr[$m['event_trust']]),
                ]);
            }


            $_SESSION['message'] = 'Успешно импортиране';
            redirect("/event/$id");
        } else {
            response('Event not found', 404);
        }
    }
}
