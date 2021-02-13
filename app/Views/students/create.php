<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>
<link rel="stylesheet" href="/studentsLogin.css">

<h1>Създаване на студент</h1>
<hr>
<form action="/student" method="POST">
    <?php flashErrors(); ?>
    <div>
        <label for="faculty_number">Факултетен номер</label>
        <input type="number" id="faculty_number" placeholder="81000" name="faculty_number" required>
    </div>
    <div>
        <label for="first_name">Име</label>
        <input type="text" id="first_name" name="first_name" required>
    </div>
    <div>
        <label for="last_name">Фамилия</label>
        <input type="text" id="last_name" name="last_name" required>
    </div>
    <div>
        <input type="submit" value="Създаване">
    </div>
</form>
<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>