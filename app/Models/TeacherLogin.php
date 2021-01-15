<?php
    require_once "Teacher.php";

    session_start();

    $errors = [];

    function testInput($input) {
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripslashes($input);
        return $input;
    }

    if ($_POST) {
        $email = isset($_POST["email"]) ? testInput($_POST["email"]) : "";
        $password = isset($_POST["password"]) ? testInput($_POST["password"]) : "";

        if (!$email) {
            $errors[] = "Input email!";
        }

        if (!$password) {
            $errors[] = "Input password!";
        }

        if ($username && $password) {
            $teacher = new App\Models\Teacher($email, $password);
            $isValid = $teacher->isValid();

            if ($isValid["successfullyExecuted"]) {
                if($isValid["success"]){
                    $_SESSION["email"] = $email;
                    $_SESSION["firstName"] = $teacher->getFirstName();
                    $_SESSION["lastName"] = $teacher->getLastName();
                    $_SESSION["teacherId"] = $teacher->getTeacherId();
                    
                    header("Location: dashboard.php");
                }
                
            } else {
                echo $isValid["errMessage"];
            }
        } else {
            foreach ($errors as $error) {
                echo $error;
                echo "<br/>";
            }
        }
    } else {
        echo "Invalid type of request";
    }
?>