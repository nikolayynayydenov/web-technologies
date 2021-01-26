<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dashboard.css">
    <title>dashboard</title>
</head>
<body> -->

<?php
//session_start(); 
?>

<?php require_once('includes/header.php'); ?>
<link rel="stylesheet" href="/dashboard.css">

<main>
    <div id="header">
        <h1 id="name">
            <?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?>
        </h1>
        <div id="buttons">
            <a href="/event/create" id="createEventBtn">
                Създай събитие
            </a>
        </div>
        <hr>
    </div>

    <section id="eventsStatistics">
        <h4>
            Моите събития
        </h4>
        <ul id="eventsList">
            <?php foreach ($data['events'] as $event) :  ?>
                <li class="event">
                    <a href="/event/<?= $event->id ?>" class="link"><?= $event->name ?></a>

                    <?= ', ' . $event->date . ', ' . $event->start . ' - ' . $event->end ?>
                    <div class="hidden">
                        <h6>Списък със студенти, които са участвали</h6>
                        <ol>
                            <?php foreach ($event->attendances as $attendance) : ?>
                                <li>
                                    <a href="/attendance?fn=<?= $attendance->faculty_number ?>" class="link">
                                        <?= $attendance->faculty_number ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>



    <section id="studentsStatistics">
        <h4>Статистика за студенти</h4>
        <ol id="studentsList">
            <li class="student">81580 Ралица Димитрова
                <div class="hidden">
                    <h6>Списък със събития, в които е участвал</h6>
                    <ol>
                        <li>JavaScript, 01/12/2020, 10:15 - 12:00</li>
                        <li>CSS, 02/12/2020, 13:15 - 15:00</li>
                    </ol>
                </div>
            </li>

            <li class="student">
                81888 Николай Найденов
                <div class="hidden">
                    <h6>Списък със събития, в които е уачствал</h6>
                    <ol>
                        <li>JavaScript, 01/12/2020, 10:15 - 12:00</li>
                        <li>CSS, 02/12/2020, 13:15 - 15:00</li>
                    </ol>
                </div>
            </li>
        </ol>
    </section>


</main>

<script src="/dashboard.js"></script>

</body>

</html>