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
        // TODO: query to DB to take events
        $events = [1,2,3,4,5,6];
        view('dashboard', [
            'events' => $events
        ]); 

    }

    public function dashboard_method()
    {
        view('dashboard');
    }
    
    public function showStudentsLogin()
    {
        view('studentsLogin');
    }

    public function studentsLogin_method()
    {
        view('studentsLogin');
    }

    public function enterTeacher()
    {
        $errors = [];
        $result = null;
        $conn = \Core\Database::getConnection();

        function testInput($input)
        {
            $input = trim($input);
            $input = htmlspecialchars($input);
            $input = stripslashes($input);
            return $input;
        }

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

        if (
            $firstName && strlen($firstName) <= 50 && $lastName && strlen($lastName) <= 50 &&
            $email && $password && $confirmPassword && $password == $confirmPassword
        ) {
            $teacher = new \App\Models\Teacher($firstName, $lastName, $email, $password);
            $exists = $teacher->teacherExists();
            if ($exists["successfullyExecuted"] == false) {
                $errors[] = "Неуспешна заявка - error message: " . $exists["errMessage"];
            } else if ($exists["successfullyExecuted"] == true) {
                if ($exists["teacherExists"] == true) {
                    $errors[] = "Вече сте регистриран!";
                } else if ($exists["teacherExists"] == false) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $create = $teacher->createTeacher($passwordHash);
                    if ($create["successfullyExecuted"] == false) {
                        $errors[] = "Неуспешна заявка за добавяне в базата данни - error message: " . $create["errMessage"];
                    }
                }
            }
        }

        if ($errors) {
            foreach ($errors as $error) {
                echo $error;
                echo "<br/>";
            }
            echo "<a href='/register'>Кликни тук, за да се върнеш към формата</a>";
        } else {
            echo "Успяша регистрация!";
            echo "<br>";
            echo "<a href='/register'>Кликни тук, за да се върнеш към формата</a>";
        }
    }
}
