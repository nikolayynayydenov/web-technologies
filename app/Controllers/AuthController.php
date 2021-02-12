<?php

namespace App\Controllers;

use App\Models\Teacher;
use App\Services\Auth;

class AuthController
{
    public function showLogin()
    {
        view('login');
    }

    public function login()
    {
        $errors = [];

        $email = isset($_POST["email"]) ? testInput($_POST["email"]) : "";
        $password = isset($_POST["password"]) ? testInput($_POST["password"]) : "";

        if (!$email) {
            $errors[] = "Моля, попълнете полето email!";
        }

        if (!$password) {
            $errors[] = "Mоля, попълнете полето парола!";
        }

        $teacher = Teacher::get([
            'email' => $email
        ]);

        if (!$teacher) {
            $errors[] = 'Невалиден email!';
        }

        if (!password_verify($password, $teacher->password)) {
            $errors[] = 'Невалидна парола!';
        }

        if (count($errors) === 0) {
            Auth::login($teacher);

            if (isset($_POST['remember_me']) && $_POST['remember_me'] === 'on') {
                Auth::rememberMe($_POST['email'], $_POST['password']);
            } else {
                Auth::forgetMe();
            }

            $_SESSION['message'] = 'Добре дошли, ' . $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
            redirect('/dashboard');
        } else {
            redirectWithErrors('/login', $errors);
        }
    }

    public function showRegister()
    {
        view('register');
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        redirect('/login');
    }

    public function register()
    {
        $errors = [];

        $firstName = testInput($_POST['firstName']);
        $lastName = testInput($_POST['lastName']);
        $email = $_POST['email'];
        $password = testInput($_POST['password']);
        $confirmPassword = testInput($_POST['confirmPassword']);

        if (!$firstName) {
            $errors[] = "Иметo е задължително поле!";
        }
        if (strlen($firstName) > 50) {
            $errors[] = "Името не трябва да е по-дълго от 50 символа!";
        }
        if (!$lastName) {
            $errors[] = "Фамилията е задължително поле!";
        }
        if (strlen($lastName) > 50) {
            $errors[] = "Фамилията не трябва да е по-дълга от 50 символа!";
        }
        if (!$email) {
            $errors[] = "Имейлът е задължително поле!";
        }
        if (!$password) {
            $errors[] = "Паролата е задължително поле!";
        }
        if (!$confirmPassword) {
            $errors[] = "Потвърждаването на паролата е задължително!";
        }
        if ($password != $confirmPassword) {
            $errors[] = "Паролата не е потвърдена!";
        }

        if (Teacher::exists(['email' => $email])) {
            $errors[] = 'Преподавател с този имейл вече съществува';
        }

        if ($errors) {
            redirectWithErrors('/register', $errors);
        } else {
            $teacher = Teacher::insert([
                'email' => $email,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'password' => password_hash($password, PASSWORD_BCRYPT),
            ]);

            Auth::login($teacher);

            redirect('/dashboard');
        }
    }
}
