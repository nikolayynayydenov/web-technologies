<?php

use Core\Router;

$router = new Router();

//$router->get('/', 'HomeController@index');

$router->get('/', 'UsersController@showFrontPage');
$router->post('/front_page', 'UsersController@frontPage_method');

$router->get('/login', 'UsersController@showLogin');
$router->post('/login', 'UsersController@login_method');

$router->get('/register', 'UsersController@showRegister');
$router->post('/register', 'UsersController@register_method');

$router->get('/event/create', 'EventsController@create');
$router->post('/event', 'EventsController@registerEvent_method');

$router->get('/event/{id}', 'EventsController@show');
$router->post('/event/{id}/import', 'EventsController@import');

$router->get('/dashboard', 'UsersController@showDashboard');
$router->post('/dashboard', 'UsersController@dashboard_method');

$router->get('/registerEvent', 'UsersController@showRegisterEvent');
$router->post('/registerEvent', 'UsersController@registerEvent_method');

$router->get('/studentsLogin', 'UsersController@showStudentsLogin');
$router->post('/studentsLogin', 'UsersController@studentsLogin_method');

$router->post('/enter-teacher', 'UsersController@enterTeacher');

$router->fallback();