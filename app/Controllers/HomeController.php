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

        $eventsWithPendingCommentsQuery = \App\Models\Comment::extractEventsWithPendingComments();
        if (
            $eventsWithPendingCommentsQuery["successfullyExecuted"] == true &&
            $eventsWithPendingCommentsQuery["thereAreEvents"] == true
        ) {
            $eventsWithPendingComments = $eventsWithPendingCommentsQuery['eventsWithPendingComments'];
        } else {
            $eventsWithPendingComments = [];
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

        view('dashboard', [
            'events' => $events,
            'eventsWithPendingComments' => $eventsWithPendingComments,
            'students' => $students
        ]);
    }

    public function dashboard_method()
    {
        view('dashboard');
    }
}
