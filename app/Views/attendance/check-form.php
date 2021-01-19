<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>
<link rel="stylesheet" href="/studentsLogin.css">

<h1>Проверка на присъствия</h1>
<hr>
<form action="/attendance" method="GET">
    <div>
        <label for="fn">Факултетен номер</label>
        <input type="text" id="fn" placeholder="81000" name="fn">
    </div>
    <div>
        <input type="submit" value="Проверка">
    </div>
</form>
<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>