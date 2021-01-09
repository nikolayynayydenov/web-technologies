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

    <main onload="my_function()">
        <h2 id="name">Иван Иванов: преподавател</h1>
        <button onclick="window.location='registerEvent'" id="createEventBtn">
            Създай събитие
        </button>
        <hr>

        <section id="eventsStatistics">
            <h4>
                Статистика за събития
            </h4>
            <ul id="eventsList">
                <li><p>JavaScript, 01/12/2020, 10:15 - 12:00</p>
                    <div>
                        <h5>Списък с присъствали студенти</h5>
                        <ol>
                            <li>81580 Ралица Димитрова</li>
                            <li>81888 Николай Найденов</li>
                        </ol>
                    </div>
                </li>

                <li><p>CSS, 02/12/2020, 13:15- 15:00</p>
                    <div>
                        <h5>Списък с присъствали студенти</h5>
                        <ol>
                            <li>81888 Иван Иванов</li>
                            <li>81555 Петя Тодорова</li>
                        </ol>
                    </div>
                </li>
            </ul>
        </section>
    

    
        <section id="studentsStatistics">
            <h4>Статистика за студенти</h4>
            <ol id="studentsList">
                <li>81580 Ралица Димитрова</li>
            </ol>
        </section>
    
        
    </main>

    <script src="/dashboard.js"></script>

</body>
</html>