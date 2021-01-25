<?php

namespace App\Controllers;


class HomeController
{
    public function index()
    {
        view('home');
    }

    public function frontPage_method()
    {
        view('front_page');
    }

    public function showDashboard()
    {

        $events = [1,2,3,4,5,6];
        view('dashboard', [
            'events' => $events
        ]); 

    }

    

    public function dashboard_method()
    {
        view('dashboard');
    }

}
