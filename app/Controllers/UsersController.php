<?php

namespace App\Controllers;
 
class UsersController
{
    public function import()
    {
        //echo realpath(dirname(__FILE__));
        //echo dirname(__FILE__) . '/../includes/header.php';
        //die();
        view('users/import');
    }

    public function showLogin()
    {
        //echo realpath(dirname(__FILE__));
        //echo dirname(__FILE__) . '/../includes/header.php';
        //die();
        view('login');
    }

    public function some_method()
    {
        //echo realpath(dirname(__FILE__));
        //echo dirname(__FILE__) . '/../includes/header.php';
        //die();
        view('login');
    }
}