<?php

session_start();

require_once('autoloader.php');
require_once('helpers.php');

$config['database'] = require_once('../config/database.php');
$config['app'] = require_once('../config/app.php');

require_once('../app/routes.php');
