<?php

use Core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/import', 'UsersController@import');


$router->fallback();