<?php

namespace App\Controllers;

use App\Services\Auth;
use App\Services\S3;
use App\Services\Validator;
use Aws\S3\Exception\S3Exception;


class ProfileController
{
    public function showOwn()
    {
        Auth::guard();
        $s3 = new S3();
        try {
            $s3->getAndSave(Auth::getAvatarName() . '.jpg');
        } catch (S3Exception $exception) {
        }

        return view('profile/own');
    }

    public function updateAvatar()
    {
        Auth::guard();

        $v = new Validator($_FILES);
        $v->validate([
            'avatar' => ['required', 'jpeg'],
        ]);

        if (!$v->isValid()) {
            $_SESSION['errors'] = $v->errors;
            redirect("/profile");
        }

        $fileName = Auth::getAvatarName();

        $fileName .= '.' . pathinfo($_FILES['avatar']['name'])['extension'];

        $s3 = new S3();
        $s3->put($_FILES['avatar']['tmp_name'], $fileName);

        $_SESSION['message'] = 'Профилната снимка беше сменена успешно. Промените ще бътат видими след известно време';
        redirect('/profile');
    }

    public function saveAvatar()
    {
    }
}
