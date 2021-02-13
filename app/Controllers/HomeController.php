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
        if (\App\Services\Auth::checkTeacher()){
            $eventsWithPendingCommentsQuery = \App\Models\Comment::extractEventsWithPendingComments($_SESSION['teacherId']);
            if (
                $eventsWithPendingCommentsQuery["successfullyExecuted"] == true &&
                $eventsWithPendingCommentsQuery["thereAreEvents"] == true
            ) {
                $eventsWithPendingComments = $eventsWithPendingCommentsQuery['eventsWithPendingComments'];
            } else {
                $eventsWithPendingComments = [];
            }
    
            $eventsWithoutPendingCommentsQuery = \App\Models\Comment::extractEventsWithoutPendingComments($_SESSION['teacherId']);
            if (
                $eventsWithoutPendingCommentsQuery["successfullyExecuted"] == true &&
                $eventsWithoutPendingCommentsQuery["thereAreEvents"] == true
            ) {
                $eventsWithoutPendingComments = $eventsWithoutPendingCommentsQuery['eventsWithoutPendingComments'];
            } else {
                $eventsWithoutPendingComments = [];
            }
        }

        $events = Auth::checkTeacher()
            ? Event::getManyWithAttendance([
                'teacher_id' => $_SESSION['teacherId'],
            ])
            : [];

        $sql = "SELECT * FROM student";
        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
        $preparedStmt->execute();
        $students = $preparedStmt->fetchAll();
        if ($students === false) {
            throw new \Exception("Problem with the database!");
        }

        if (\App\Services\Auth::checkTeacher()){
            view('dashboard', [
                'events' => $events,
                'eventsWithPendingComments' => $eventsWithPendingComments,
                'eventsWithoutPendingComments' => $eventsWithoutPendingComments,
                'students' => $students
            ]);
        }
        if(\App\Services\Auth::checkStudent()){
            view('dashboard', [
                'events' => $events,
                'students' => $students
            ]);
        }

        
    }

    public function dashboard_method()
    {
        view('dashboard');
    }
}
