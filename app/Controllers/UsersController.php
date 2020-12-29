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

    public function login_method()
    {
        //echo realpath(dirname(__FILE__));
        //echo dirname(__FILE__) . '/../includes/header.php';
        //die();
        view('login');
    }

    public function showRegister()
    {
        //echo realpath(dirname(__FILE__));
        //echo dirname(__FILE__) . '/../includes/header.php';
        //die();
        view('register');
    }

    public function register_method()
    {
        //echo realpath(dirname(__FILE__));
        //echo dirname(__FILE__) . '/../includes/header.php';
        //die();
        view('register');
    }

    public function showRegisterEvent()
    {
        //echo realpath(dirname(__FILE__));
        //echo dirname(__FILE__) . '/../includes/header.php';
        //die();
        view('registerEvent');
    }

    public function registerEvent_method()
    {
        //echo realpath(dirname(__FILE__));
        //echo dirname(__FILE__) . '/../includes/header.php';
        //die();
        view('registerEvent');
    }
}