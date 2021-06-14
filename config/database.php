<?php

return [
    'host' => 'localhost',
    'database' => 'web-technologies',
    'user' => 'root',
    'password' => '',
    'pdo' => [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ]
];
