<?php

namespace App\Controllers;

use App\Models\Attendance;
use App\Models\Event;

class AttendanceController
{
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
}
