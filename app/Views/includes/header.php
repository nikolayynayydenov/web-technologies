<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Bootstrap/css/bootstrap-grid.min.css">
    <!-- <link rel="stylesheet" href="/Bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="icon" href="/NiRa logo.png"> -->
    <link rel="icon" href="/green_dot.png">
    <link rel="stylesheet" href="/navbar.css">
    <link rel="stylesheet" href="/css/app.css">
    <title>TheSystem</title>
</head>

<body>
    <ul id="nav_ul">
        <li class="nav_li1" id="li1"><a href="/">Начало</a></li>

        <?php if (App\Services\Auth::check()) : ?>
            <li class="nav_li1" id="li2"><a href="/event/create">Създаване на събитие</a></li>
            <li class="nav_li1" id="li3"><a href="/dashboard">Основна страница</a></li>
        <?php endif ?>

        <li class="nav_li1" id="li4"><a href="/attendance/check">Проверка на присъствия</a></li>

        <?php if (App\Services\Auth::check()) : ?>
            <li class="nav_li2" id="li5"><a href="#"><?= $_SESSION['firstName'] . '  ' . $_SESSION['lastName'] ?></a></li>
            <li class="nav_li2" id="li6"><a href="/logout">Изход</a></li>
        <?php else : ?>
            <li class="nav_li2" id="li5"><a href="/login">Вход</a></li>
            <li class="nav_li2" id="li6"><a href="/register">Регистрация</a></li>
        <?php endif ?>
    </ul>

    <div class="flash-message"><?= sessionFlash('message') ?></div>