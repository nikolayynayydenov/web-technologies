<?php

function view(string $name, array $data = [])
{
    require_once("./../app/Views/$name.php");
    die;
}

function config($name)
{
    global $config;
    return $config[$name];
}
