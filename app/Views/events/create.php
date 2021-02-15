<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>
<link rel="stylesheet" href="/registerEvent.css">

<main>
    <h1>Създаване на събитие</h1>
    <hr>
    <form action="/event" method="POST">
        <div class="field">
            <label for="name">Име</label>
            <input type="text" id="name" placeholder="Име на събитието" name="name">
        </div>

        <div class="field">
            <label for="date">Дата</label>
            <input type="date" id="date" placeholder="01-01-2021" name="date">
        </div>

        <div class="field" id="selectFields">
            <label for="start">Начало</label>
            <!-- <input type="time" id="start" name="start"> -->
            <select name="start" id="start">
                <?php require('partials/start-hours.php') ?>
            </select>

            <label for="end">Край</label>
            <!-- <input type="time" id="end" name="end"> -->
            <select name="end" id="end">
                <?php require('partials/end-hours.php') ?>
            </select>
        </div>

        <div class="field">
            <label for="description">Описание</label>
            <textarea name="description" id="description" cols="50" rows="7" placeholder="Кратко описание на събитието"></textarea>
        </div>

        <input type="submit" value="Добави събитието!">
    </form>
</main>
<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>