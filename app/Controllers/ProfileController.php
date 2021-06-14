<?php

namespace App\Controllers;

use App\Services\Auth;
use \Exception;
use App\Services\Validator;

class ProfileController
{
    public function showOwn()
    {
        Auth::guard();

        return view('profile/own');
    }

    public function updatePhoto()
    {
        Auth::guard();

        
    }
}
