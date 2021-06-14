<?php

namespace App\Controllers;

use App\Services\Auth;
use App\Services\S3;
use App\Services\Validator;

class ProfileController
{
    public function showOwn()
    {
        Auth::guard();



        return view('profile/own');
    }

    public function updateAvatar()
    {
        Auth::guard();

        $v = new Validator($_FILES);
        $v->validate([
            'avatar' => ['required', 'image'],
        ]);

        if (!$v->isValid()) {
            $_SESSION['errors'] = $v->errors;
            redirect("/profile");
        }
        
        $fileName = pathinfo($_FILES['avatar']['name'])['filename'];
        
        if (Auth::checkStudent()) {
            $fileName .= '-student';
        } else {
            $fileName .= '-teacher';

        }

        $fileName .= '.' . pathinfo($_FILES['avatar']['name'])['extension'];        

        $s3 = new S3();
        $s3->put($_FILES['avatar']['tmp_name'], $fileName);
    }

    public function saveAvatar()
    {
        
    }
}
