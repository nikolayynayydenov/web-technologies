<?php

namespace App\Controllers;
 
class UsersController
{

    public function showFrontPage()
    {
        view('front_page');
    }

    public function frontPage_method()
    {
        view('front_page');
    }

    public function showLogin()
    {
        view('login');
    }

    public function login_method()
    {
        view('login');
    }

    public function showRegister()
    {
        view('register');
    }

    public function register_method()
    {
        view('register');
    }
}