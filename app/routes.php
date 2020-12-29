<?php

use Core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/import', 'UsersController@import');

$router->get('/login', 'UsersController@showLogin');
$router->post('/login', 'UsersController@login_method');

$router->get('/register', 'UsersController@showRegister');
$router->post('/register', 'UsersController@register_method');

$router->get('/registerEvent', 'UsersController@showRegisterEvent');
$router->post('/register', 'UsersController@registerEvent_method');


$router->fallback();