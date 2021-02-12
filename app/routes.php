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
$router->get('/studentsLogin', 'UsersController@showStudentsLogin');

// Events
$router->get('/event/create', 'EventsController@create');
$router->post('/event', 'EventsController@store');
$router->get('/event/{id}', 'EventsController@show');
$router->post('/event/{id}/import', 'EventsController@import');
$router->get('/event/{id}/edit', 'EventsController@edit');
$router->put('/event/{id}', 'EventsController@update');
$router->delete('/event/{id}', 'EventsController@delete');


//Attendance
$router->get('/attendance/check', 'AttendanceController@checkForm');
$router->get('/attendance', 'AttendanceController@show');



//Other
$router->get('/', 'UsersController@showFrontPage');
$router->post('/front_page', 'HomeController@frontPage_method');
$router->get('/dashboard', 'HomeController@showDashboard');
$router->post('/dashboard', 'HomeController@dashboard_method');

//Comments
$router->post('/event/{id}/delete-comment/{commentId}', 'CommentsController@delete'); //delete
$router->post('/event/{id}/accept-comment/{commentId}', 'CommentsController@accept'); //accept
$router->post('/event/{id}/comment', 'CommentsController@enterCommentIntoDB');

$router->fallback();
