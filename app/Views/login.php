<?php require_once('includes/header.php'); ?>
<link rel="stylesheet" href="/teachersLogin.css">

<h1>Вход за преподаватели</h1>
<hr>
<form action="/login" method="POST">
    <?php flashErrors(); ?>
    <div>
        <label for="email">Имейл</label>
        <input type="email" id="email" name="email" value="<?= $_COOKIE['email'] ?? '' ?>">
    </div>
    <div>
        <label for="password">Парола</label>
        <input type="password" id="password" name="password" value="<?= $_COOKIE['password'] ?? '' ?>">
    </div>
    <div>
        <label for="remember_me">Запомни ме</label>
        <input type="checkbox" id="password" name="remember_me">
    </div>
    <div>
        <input type="submit" value="Влез">
    </div>
</form>


<?php require_once('includes/footer.php'); ?>