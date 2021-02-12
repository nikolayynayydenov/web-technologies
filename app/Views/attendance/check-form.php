<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>
<link rel="stylesheet" href="/studentsLogin.css">

<h1>Вход за студенти</h1>
<hr>
<form action="/studentsLogin" method="POST">
    <?php flashErrors(); ?>
    <div>
        <label for="fn">Факултетен номер</label>
        <input type="text" id="fn" placeholder="81000" name="fn">
    </div>
    <div>
        <input type="submit" value="Влез">
    </div>
</form>
<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>