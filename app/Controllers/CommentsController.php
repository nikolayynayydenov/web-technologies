<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Teacher;
use App\Services\Auth;
use Core\Database;

class CommentsController
{
    public function delete($eventId, $commentId)
    {
        $sql = "UPDATE comments SET is_visible, pending VALUES(0, 0) WHERE id=:commentId";
        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
        $query = [];
        try {
            $preparedStmt->execute();
            $query = ["successfullyExecuted" => true];
            $_SESSION["message"] = "succesfully deleted comment with id: " . $commentId;
            redirect("/event/$eventId");
        } catch (\PDOException $e) {
            $errMsg  = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }
    }
    public function accept($eventId, $commentId)
    {
        $sql = "UPDATE comments SET is_visible, pending VALUES(1, 0) WHERE id=:commentId";
        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
        $query = [];
        try {
            $preparedStmt->execute();
            $query = ["successfullyExecuted" => true];
            $_SESSION["message"] = "succesfully accepted comment with id: " . $commentId;
            redirect("/event/$eventId");
        } catch (\PDOException $e) {
            $errMsg  = $e->getMessage();
            $query = ["successfullyExecuted" => false, "errMessage" => $errMsg];
        }
    }

    public function enterCommentIntoDB($eventID)
    {

        $errors = [];

        function testInput($input)
        {
            $input = trim($input);
            $input = htmlspecialchars($input);
            $input = stripslashes($input);
            return $input;
        }

        if (!Auth::check()) {
            $_SESSION["message"] = "Трябва да влезете в системата, за да пишете коментари";
            redirect('/studentsLogin');
        }

        if ($_POST) {
            $textContent = testInput($_POST['textContent']);
            //$fn = testInput($_POST['fn']);
            //$isVisible = true; //не го взимаме от форма...

            if (!$textContent) {
                $errors[] = "Не сте въвели коментар!";
            }
            // if(!is_numeric($fn) || mb_strlen($fn) != 5){
            //     $errors[] = "Некоректен факултетен номер!";
            // }

            if ($textContent && Auth::checkStudent()/* && mb_strlen($fn) == 5 && is_numeric($fn)*/) {
                echo "hello";
                echo '<br>';
                $comment = new Comment($textContent, $_SESSION['fn']);
                $exists = $comment->comment_exists();
                if ($exists["successfullyExecuted"] == false) {
                    $errors[] = "Неуспешна заявка - error message: " . $exists["errMessage"];
                } else if ($exists["successfullyExecuted"] == true) {
                    if ($exists["commentExists"] == true) {
                        $errors[] = "Коментарът вече е въведен!";
                    } else if ($exists["commentExists"] == false) {
                        $create = $comment->createComment($eventID);
                        if ($create["successfullyExecuted"] == false) {
                            $errors[] = "Неуспешна заявка за добавяне в базата данни - error message: " . $create["errMessage"];
                        }
                    }
                }
            }

            if ($textContent && Auth::checkTeacher()) {
                $comment = new Comment($textContent);
                $create = $comment->createTeacherComment($eventID, $_SESSION['teacherId']);
                if ($create["successfullyExecuted"] == false) {
                    $errors[] = "Неуспешна заявка за добавяне в базата данни - error message: " . $create["errMessage"];
                }
            }           

            if ($errors) {
                foreach ($errors as $error) {
                    echo $error;
                    echo "<br/>";
                }
                //echo "<a href='register.php'>Кликни тук, за да се върнеш към формата</a>";
            } else {
                $_SESSION["message"] = "Коментарът е добавен успешно!";
                redirect('/event/' . $eventID);
                //echo "<a href='register.php'>Кликни тук, за да се върнеш към формата</a>";
            }
        } else {
            echo "Невалиден тип заявка!";
        }
    }
}
