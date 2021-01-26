<?php

use Core\Router;

$router = new Router();

// Authentication
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login_method');
$router->get('/register', 'AuthController@showRegister');
$router->post('/enter-teacher', 'AuthController@enterTeacher');
$router->post('/logout', 'AuthController@register_method');



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
$router->post('/front_page', 'HomeController@frontPage_method');
$router->get('/dashboard', 'HomeController@showDashboard');
$router->post('/dashboard', 'HomeController@dashboard_method');


$router->fallback();
