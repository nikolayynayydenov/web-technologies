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
        $textContent = testInput($_POST['textContent']);
        $fn = testInput($_POST['fn']);
        //$isVisible = true; //не го взимаме от форма...

        if(!$textContent){
            $errors[] = "Не сте въвели коментар!";
        }
        if(!is_numeric($fn) || strlen($fn) != 5){
            $errors[] = "Некоректен факултетен номер!";
        }

        if($textContent && strlen($fn) == 5 && is_numeric($fn)){
            $comment = new App\Models\Comment($textContent, $fn);
            $exists = $comment->comment_exists();
            if($exists["successfullyExecuted"] == false){
                $errors[] = "Неуспешна заявка - error message: " . $exists["errMessage"];
            }
            else if($exists["successfullyExecuted"] == true){
                if($exists["commentExists"] == true){
                    $errors[] = "Коментарът вече е въведен!";
                }
                else if($exists["commentExists"] == false){
                    $create = $comment->createComment();
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
            // echo "<a href='register.php'>Кликни тук, за да се върнеш към формата</a>";
        } else {
            echo "Събитието е добавено успешно!";
            echo "<br>";
            // echo "<a href='register.php'>Кликни тук, за да се върнеш към формата</a>";
        }

    }
    else{
        echo "Невалиден тип заявка!";
    }

?>