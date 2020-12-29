<?php

use Core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/import', 'UsersController@import');

$router->get('/login', 'UsersController@showLogin');
$router->post('/login', 'UsersController@some_method');

$router->get('/registerEvent', 'Another_Controller@showRegisterEvent');


$router->fallback();