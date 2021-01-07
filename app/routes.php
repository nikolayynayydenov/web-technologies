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


$router->fallback();