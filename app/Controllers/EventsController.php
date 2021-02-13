<?php

namespace App\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\Comment;
use App\Services\Auth;
use App\Services\Validator;
use Core\Database;
use Core\Exceptions\NotFoundException;
use \Exception;

class EventsController
{
    public function create()
    {
        Auth::guard();
        view('events/create');
    }

    public function store()
    {
        // TODO: check if start > end
        Auth::guard();

        $errors = [];

        $conn = Database::getConnection();

        function testInput($input)
        {
            $input = trim($input);
            $input = htmlspecialchars($input);
            //$input = stripslashes($input);
            return $input;
        }
        $eventName = testInput($_POST['name']);
        $teacher = $_SESSION['teacherId'];
        $eventDate = $_POST['date'];
        $eventStart = $_POST['start'];
        $eventEnd = $_POST['end'];
        $description = $_POST['description'];

        if (!$eventName) {
            $errors[] = "Името на събитието е задължително поле!";
        }
        if (mb_strlen($eventName) > 150) {
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

        if (strtotime($eventStart) > strtotime($eventEnd)) {
            $errors[] = "Началният час трябва да е преди крайният";
        }

        if ($eventName && mb_strlen($eventName) <= 150 && $eventDate && $eventStart && $eventEnd) {
            $event = new Event([
                'name' => $eventName,
                'teacher_id' => $teacher,
                'date' => $eventDate,
                'start' => $eventStart,
                'end' => $eventEnd,
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

        if (is_null($event)) {
            throw new NotFoundException('Не е намерено събитие с id: ' . $id);
        }

        $comments = Comment::getMany([
            'event_id' => $event->id
        ]);

        $attendances = Attendance::getMany([
            'event_id' => $id
        ]);

        if ($event) {
            view('/events/show', [
                'event' => $event,
                'comments' => $comments,
                'attendances' => $attendances,
            ]);
        } else {
            response('Event not found', 404);
        }
    }

    /**
     * Show the edit form
     * 
     * @param int $id
     */
    public function edit($id)
    {
        Auth::guard();

        $event = Event::getById($id);

        if (is_null($event)) {
            throw new NotFoundException('Не е намерено събитие с id: ' . $id);
        }

        view('events/edit', [
            'event' => $event
        ]);
    }

    /**
     * @param int $id
     */
    public function update($id)
    {
        // TODO: check if overlaps
        Auth::guard();

        $event = Event::getById($id);

        if (is_null($event)) {
            throw new NotFoundException('Не е намерено събитие с id: ' . $id);
        }

        if ($_SESSION['teacherId'] != $event->teacher_id) {
            throw new Exception('You can only update own events');
        }

        $v = new Validator($_POST);
        $v->validate([
            'name' => ['required', 'min:5', 'max:300'],
            'description' => ['required', 'min:5'],
            'date' => ['required', 'date'],
            'start' => ['required', 'time', 'before:end'],
            'end' => ['required', 'time'],
        ]);

        if (!$v->isValid()) {
            $_SESSION['errors'] = $v->errors;
            redirect("/event/$id/edit");
        }

        $event->update([
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'date' => $_POST['date'],
            'start' => $_POST['start'],
            'end' => $_POST['end'],
            'teacher_id' => $_SESSION['teacherId'],
        ]);

        $_SESSION['message'] = 'Успешна промяна';
        redirect("/event/$id/edit");
    }

    public function delete($id)
    {
        Auth::guard();

        $event = Event::getById($id);

        if (is_null($event)) {
            throw new NotFoundException('Не е намерено събитие с id: ' . $id);
        }

        if ($_SESSION['teacherId'] != $event->teacher_id) {
            throw new Exception('You can only delete own events');
        }

        $event->delete();

        $_SESSION['message'] = 'Успешно изтриване';

        redirect('/dashboard');
    }
}
