<?php

namespace App\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use Core\Database;

class AttendanceController
{
    const SEPARATOR = '/\s{3,}/';

    public function checkForm()
    {
        view('attendance/check-form');
    }

    public function show()
    {
        $fn = $_GET['fn'];
        if (!ctype_digit($fn)) {
            return;
        }

        $events = Event::getAllByFn($fn);

        view('attendance/show', [
            'events' => $events,
            'fn' => $fn,
        ]);
    }

    public function import($id)
    {
        $event = Event::getById($id);

        if ($event) {
            // Validation          
            $errors = [];
            if (!is_uploaded_file($_FILES['attendance_file']['tmp_name'])) {
                $errors[] = 'Моля, изберете файл';
            }

            if ($_FILES['attendance_file']['type'] !== 'text/plain') {
                $errors[] = 'Файлът трябва да е с разширение txt';
            }   

            $lines = file($_FILES['attendance_file']['tmp_name']);

            $missingFns = $this->missingStudentsFns($lines);

            if (count($missingFns) > 0) {
                $msg = 'Следните студенти не съществуват в системата: ';
                $msg .= implode(', ', $missingFns);
                $msg .= '. Можете да ги добавите от ';
                $msg .= '<a href="/student/create">тук</a>.';
                $errors[] = $msg;
            }

            if (count($errors) > 0) {
                $_SESSION['errors'] = $errors;
                redirect("/event/$id");
            }

            /**
             * @var array import mapping
             */
            $m = [
                'user_fn_id' => 0,
                'enroll_source' => 1,
                'enroll_datetime' => 2,
                'event_trust' => 3,
                'check_description' => 4
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

    /**
     * @param array $lines
     * 
     * @return array
     */
    protected function missingStudentsFns(array $lines)
    {
        $fns = array_map(function ($line) {
            $line = preg_split(self::SEPARATOR, $line);
            return $line[0];
        }, $lines);

        $students = Database::inst()->select(
            '* FROM student WHERE faculty_number IN (' .
                implode(
                    ', ',
                    array_fill(0, count($fns), '?')
                ) .
                ')',
            $fns
        );

        $missingFns = [];

        if (count($students) !== count($fns)) {
            foreach ($fns as $fn) {
                if (!$this->fnExists($students, $fn)) {
                    $missingFns[] = $fn;
                }
            }
        }

        return $missingFns;
    }

    /**
     * @param array $students
     * @param int $fn
     * 
     * @return bool
     */
    protected function fnExists($students, $fn)
    {
        foreach ($students as $student) {
            if ($fn == $student['faculty_number']) {
                return true;
            }
        }

        return false;
    }
}
