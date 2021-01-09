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
    public function showDashboard()
    {
        view('dashboard');
    }

    public function dashboard_method()
    {
        view('dashboard');
    }
    public function showRegisterEvent()
    {
        view('registerEvent');
    }

    public function registerEvent_method()
    {
        view('registerEvent');
    }
}