<?php
    include_once "Teacher.php";

    $errors = [];
    $result;

    $conn = \Core\Database::getConnection();

    function testInput($input) {
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripslashes($input);
        return $input;
    }

    if($_POST){
        $firstName = testInput($_POST['firstName']);
        $lastName = testInput($_POST['lastName']);
        $email = $_POST['email'];
        $password = testInput($_POST['pass']);
        $confirmPassword = testInput($_POST['confirmPass']);

        if(!$firstame){
            $errors[] = "Иметo е задължително поле!";
        }
        if(strlen($firstName)>50){
            $errors[] = "Името не трябва да е по-дълго от 50 символа!";
        }
        if(!$lastname){
            $errors[] = "Фамилията е задължително поле!";
        }
        if(strlen($lastName)>50){
            $errors[] = "Фамилията не трябва да е по-дълга от 50 символа!";
        }
        if(!$email){
            $errors[] = "Имейлът е задължително поле!";
        }
        if(!$password){
            $errors[] = "Паролата е задължително поле!";
        }
        if(!$confirmPassword){
            $errors[] = "Потвърждаването на паролата е задължително!";
        }
        if($password != $confirmPassword){
            $errors[] = "Паролата не е потвърдена!";
        }

        if($firstName && strlen($firstName)<=50 && $lastName && strlen($lastname)<=50 && 
            $email && $password && $confirmPassword && $password == $confirmPassword){
            $teacher = new Teacher($firstName, $lastname, $email, $password);
            $exists = $teacher->teacherExists();
            if($exists["successfullyExecuted"] == false){
                $errors[] = "Неуспешна заявка - error message: " . $exists["errMessage"];
            }
            else if($exists["successfullyExecuted"] == true){
                if($exists["teacherExists"] == true){
                    $errors[] = "Вече сте регистриран!";
                }
                else if($exists["teacherExists"] == false){
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $create = $teacher->createTeacher($passwordHash);
                    if($create["successfullyExecuted"] == false){
                        $errors[] = "Неуспешна заявка за добавяне в базата данни - error message: " . $create["errMessage"];
                    }
                }
            }
        }

        if($errors) {
            foreach ($errors as $error) {
                echo $error;
                echo "<br/>";
            }
            echo "<a href='register.php'>Кликни тук, за да се върнеш към формата</a>";
        } else {
            echo "Събитието е добавено успешно!";
            echo "<br>";
            echo "<a href='register.php'>Кликни тук, за да се върнеш към формата</a>";
        }

    }
    else{
        echo "Невалиден тип заявка!";
    }

?>