<?php

use App\Controllers\CommentsController;
use Core\Router;

$router = new Router();

// Authentication
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@showRegister');
$router->post('/enter-teacher', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');
$router->get('/studentsLogin', 'AuthController@showStudentsLogin');
$router->post('/studentsLogin', 'AuthController@studentsLogin');

// Events
$router->get('/event/create', 'EventsController@create');
$router->post('/event', 'EventsController@store');
$router->get('/event/{id}', 'EventsController@show');
$router->post('/event/{id}/import', 'AttendanceController@import');
$router->get('/event/{id}/edit', 'EventsController@edit');
$router->put('/event/{id}', 'EventsController@update');
$router->delete('/event/{id}', 'EventsController@delete');

// Students
$router->get('/student/create', 'StudentsController@create');
$router->post('/student', 'StudentsController@store');


//Attendance
// $router->get('/attendance/check', 'AttendanceController@checkForm');
$router->get('/attendance', 'AttendanceController@show');



//Other
$router->get('/', 'UsersController@showFrontPage');
$router->post('/front_page', 'HomeController@frontPage_method');
$router->get('/dashboard', 'HomeController@showDashboard');
$router->post('/dashboard', 'HomeController@dashboard_method');

//Comments
$router->patch('/event/{id}/delete-comment/{commentId}', 'CommentsController@delete'); //delete
$router->patch('/event/{id}/accept-comment/{commentId}', 'CommentsController@accept'); //accept
$router->post('/event/{id}/comment', 'CommentsController@enterCommentIntoDB');

$router->fallback();
