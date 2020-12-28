<?php

use Core\Router;

$router = new Router();

$router->get('/home/{name}', 'HomeController@index');