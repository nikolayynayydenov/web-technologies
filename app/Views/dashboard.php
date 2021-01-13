<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dashboard.css">
    <title>dashboard</title>
</head>
<body> -->

<?php require_once('includes/header.php'); ?>
<link rel="stylesheet" href="/dashboard.css">

<main>
    <div id="header">
        <h2 id="name">Иван Иванов: преподавател</h1>
            <button onclick="window.location='registerEvent'" id="createEventBtn">
                Създай събитие
            </button>
            <hr>
    </div>


    <?php foreach ($data['events'] as $event) {  ?>

        <ul>
            <li>
                <?php echo $event; ?>
            </li>
        </ul>

    <?php } ?>
    <section id="eventsStatistics">
        <h4>
            Статистика за събития
        </h4>
        <ul id="eventsList">
            <li class="event">JavaScript, 01/12/2020, 10:15 - 12:00
                <div class="hidden">
                    <h6>Списък със студенти, които са участвали</h6>
                    <ol>
                        <li>81888 Петя Иванова</li>
                        <li>81555 Стефан Стефанов</li>
                    </ol>
                </div>
            </li>

            <li class="event">CSS, 02/12/2020, 13:15- 15:00
                <div class="hidden">
                    <h6>Списък със студенти, които са участвали</h6>
                    <ol>
                        <li>81678 Камелия Петрова</li>
                        <li>81456 Петър Георгиев</li>
                    </ol>
                </div>
            </li>
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