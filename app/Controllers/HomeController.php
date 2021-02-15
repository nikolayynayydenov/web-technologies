<?php

namespace App\Controllers;

use App\Models\Event;
use App\Models\Comment;
use App\Services\Auth;
use Core\Database;

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

        if (Auth::checkTeacher()) {
            $eventsWithPendingCommentsQuery = Comment::extractEventsWithPendingComments($_SESSION['teacherId']);
            if (
                $eventsWithPendingCommentsQuery["successfullyExecuted"] == true &&
                $eventsWithPendingCommentsQuery["thereAreEvents"] == true
            ) {
                $eventsWithPendingComments = $eventsWithPendingCommentsQuery['eventsWithPendingComments'];
            } else {
                $eventsWithPendingComments = [];
            }

            $eventsWithoutPendingCommentsQuery = Comment::extractEventsWithoutPendingComments($_SESSION['teacherId']);
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
            : []; // TODO: remake

        $sql = "SELECT * FROM student";
        $preparedStmt = Database::getConnection()->prepare($sql);
        $preparedStmt->execute();
        $students = $preparedStmt->fetchAll();
        if ($students === false) {
            throw new \Exception("Problem with the database!");
        }

        if (Auth::checkTeacher()) {
            view('dashboard', [
                'events' => $events,
                'eventsWithPendingComments' => $eventsWithPendingComments,
                'eventsWithoutPendingComments' => $eventsWithoutPendingComments,
                'students' => $students
            ]);
        }
        if (Auth::checkStudent()) {
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
