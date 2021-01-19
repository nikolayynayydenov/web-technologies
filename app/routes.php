<?php

use Core\Router;

$router = new Router();

// Authentication
$router->get('/login', 'UsersController@showLogin');
$router->post('/login', 'UsersController@login_method');
$router->get('/register', 'UsersController@showRegister');
$router->post('/register', 'UsersController@register_method');
$router->post('/enter-teacher', 'UsersController@enterTeacher');


// Events
$router->get('/event/create', 'EventsController@create');
$router->post('/event', 'EventsController@store');
$router->get('/event/{id}', 'EventsController@show');
$router->post('/event/{id}/import', 'EventsController@import');


//Attendance
$router->get('/attendance/check', 'AttendanceController@checkForm');
$router->get('/attendance', 'AttendanceController@show');


//Other
$router->get('/', 'UsersController@showFrontPage');
$router->post('/front_page', 'UsersController@frontPage_method');
$router->get('/dashboard', 'UsersController@showDashboard');
$router->post('/dashboard', 'UsersController@dashboard_method');


$router->fallback();
