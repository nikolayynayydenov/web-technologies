<?php

namespace App\Controllers;

use App\Models\Event;
use App\Services\Auth;

class HomeController
{
    public function index()
    {
        view('home');
    }

    public function frontPage_method()
    {
        view('front_page');
    }

    public function showDashboard()
    {
        Auth::guard();
        
        $events = Auth::check()
            ? Event::getManyWithAttendance([
                'teacher_id' => $_SESSION['teacherId'],
            ])
            : [];

        view('dashboard', [
            'events' => $events
        ]);
    }

    public function dashboard_method()
    {
        view('dashboard');
    }
}
