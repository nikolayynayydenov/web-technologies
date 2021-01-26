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
}
