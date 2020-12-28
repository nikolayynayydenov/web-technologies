<?php

namespace App\Controllers;

use App\Models\User;

class HomeController
{
    public function index($name)
    {
        $u = new User;
        $u->getById(3);
        echo $u->name;

        view('home', [
            'name' => $name
        ]);
    }
}
