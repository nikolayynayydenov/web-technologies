<?php
    session_start();
    if($_POST){
        if($_SESSION){
            session_unset();
            session_destroy();

            echo "Излязохте от профила си!";
        }
        echo "Сесията вече не е валидна!";
    }
    else{
        echo "Невалидна заявка!";
    }
?>