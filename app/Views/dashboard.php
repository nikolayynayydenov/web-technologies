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
        <?php if (\App\Services\Auth::checkTeacher()) : ?>
            <h1 id="name">
                <?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?>
            </h1>
        <?php endif; ?>
        <div id="buttons">
            <p id="undoneComments">
                <?php if (isset($_SESSION['numberOfNewComments'])) { ?>
                    Нови коментари: <?= $_SESSION['numberOfNewComments'] ?>
                <?php } ?>
            </p>
            <?php if (\App\Services\Auth::checkTeacher()) : ?>

                <a href="/event/create" id="createEventBtn">
                    Създай събитие
                </a>
            <?php endif; ?>

            <!-- защо това не работи?? -->
            <!-- <?php //if (\App\Services\Auth::checkStudent()) : 
                    ?>
                <h1 id="name">
                <?php//$_SESSION["studentNames"] ?>
                </h1>
            <?php //endif; 
            ?> -->
        </div>
        <hr>
    </div>

    <section id="eventsStatistics">
        <?php if (\App\Services\Auth::checkTeacher()) : ?>
            <h2>
                Събития с нови коментари
            </h2>
            <ul>
                <?php if (count($data['eventsWithPendingComments']) === 0) : ?>
                    В момента няма такива събития.
                <?php endif; ?>
                <?php foreach ($data['eventsWithPendingComments'] as $event) : ?>
                    <li class="event">
                        <h3><a href="/event/<?= $event['id'] ?>" class="link"><?= $event['name'] ?></a></h3>
                        <?php echo $event['date'] . ', ' . $event['start'] . ' - ' . $event['end'] ?>
                        <button class="showStudents" data-show="">Покажи студенти</button>
                        <div class="hidden_students"></br>
                            </br>
                            <!-- <h4>Списък със студенти, които са участвали</h4> -->
                            <?php
                            $sql = "SELECT * FROM student WHERE faculty_number IN (SELECT faculty_number FROM attendance WHERE event_id=:eventId)";
                            $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                            $preparedStmt->execute(['eventId' => $event['id']]);
                            $studentsWhoParticipated = $preparedStmt->fetchAll();
                            if ($studentsWhoParticipated === false) {
                                throw new \Exception();
                            }
                            ?>
                            <?php if (count($studentsWhoParticipated) === 0) : ?>
                                За това събития няма записани присъствия
                            <?php endif; ?>
                            <ul>
                                <?php foreach ($studentsWhoParticipated as $student) : ?>
                                    <li>
                                        <a href="/attendance?fn=<?= $student['faculty_number'] ?>" class="link">
                                            <?= $student['faculty_number'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>



            <h2>
                Събития без нови коментари
            </h2>
            <ul id="eventsList">
                <?php if (count($data['eventsWithoutPendingComments']) === 0) : ?>
                    В момента няма такива събития.
                <?php endif; ?>
                <?php foreach ($data['eventsWithoutPendingComments'] as $event) : ?>
                    <li class="event">
                        <h3><a href="/event/<?= $event['id'] ?>" class="link"><?= $event['name'] ?></a></h3>
                        <?php echo $event['date'] . ', ' . $event['start'] . ' - ' . $event['end'] ?>
                        <button class="showStudents" data-show="">Покажи студенти</button>

                        <div class="hidden_students"></br>
                            </br>
                            <!-- <h4>Списък със студенти, които са участвали</h4> -->

                            <?php
                            $sql = "SELECT * FROM student WHERE faculty_number IN 
                                    (SELECT faculty_number FROM attendance WHERE event_id=:eventId)";
                            $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                            $preparedStmt->execute(['eventId' => $event['id']]);
                            $studentsWhoParticipated = $preparedStmt->fetchAll();
                            if ($studentsWhoParticipated === false) {
                                throw new \Exception();
                            }
                            ?>
                            <?php if (count($studentsWhoParticipated) === 0) : ?>
                                За това събитиe няма записани присъствия
                            <?php endif; ?>
                            <ul>
                                <?php foreach ($studentsWhoParticipated as $student) : ?>
                                    <li>
                                        <a href="/attendance?fn=<?= $student['faculty_number'] ?>" class="link">
                                            <?= $student['faculty_number'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>

                <!-- това са всички събития, а ние искаме да разделим, pending от не-pending -->
            </ul>

        <?php endif; ?>


        <?php if (\App\Services\Auth::checkStudent()) : ?>
            <h2>Събития, в които съм участвал</h2>
            <ul id="eventsList">
                <?php
                $sql = "SELECT * FROM events WHERE id IN (SELECT event_id FROM attendance WHERE faculty_number=:fn)";
                $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                $preparedStmt->execute(["fn" => $_SESSION['fn']]);
                $eventsOfStudent = $preparedStmt->fetchAll();
                if ($eventsOfStudent === false) {
                    throw new \Exception();
                }
                ?>

                <?php if (count($eventsOfStudent) === 0) : ?>
                    Няма такива събития
                <?php endif; ?>
                <?php foreach ($eventsOfStudent as $event) : ?>
                    <li class="event">
                        <h3><a href="/event/<?= $event['id'] ?>" class="link"><?= $event['name'] ?></a></h3>
                        <?= $event['date'] . ', ' . $event['start'] . ' - ' . $event['end'] ?>
                        <button class="showStudents" data-show="">Покажи студенти</button>

                        <div class="hidden_students"></br>
                            </br>
                            <!-- <h4>Списък със студенти, които са участвали</h4> -->

                            <?php
                            $sql = "SELECT * FROM student WHERE faculty_number IN 
                                        (SELECT faculty_number FROM attendance WHERE event_id=:eventId)";
                            $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                            $preparedStmt->execute(['eventId' => $event['id']]);
                            $studentsWhoParticipated = $preparedStmt->fetchAll();
                            if ($studentsWhoParticipated === false) {
                                throw new \Exception();
                            }
                            ?>
                            <?php if (count($studentsWhoParticipated) === 0) : ?>
                                За това събития няма записани присъствия
                            <?php endif; ?>
                            <ul>
                                <?php foreach ($studentsWhoParticipated as $student) : ?>
                                    <li>
                                        <a href="/attendance?fn=<?= $student['faculty_number'] ?>" class="link">
                                            <?= $student['faculty_number'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h2>Всички останали събития</h2>
            <ul>
                <?php
                $sql = "SELECT * FROM events WHERE id NOT IN (SELECT event_id FROM attendance WHERE faculty_number=:fn)";
                $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                $preparedStmt->execute(["fn" => $_SESSION['fn']]);
                $eventsOfStudent = $preparedStmt->fetchAll();
                if ($eventsOfStudent === false) {
                    throw new \Exception();
                }
                ?>
                <?php if (count($eventsOfStudent) === 0) : ?>
                    В системата не са регистрирани събития
                <?php endif; ?>
                <?php foreach ($eventsOfStudent as $event) : ?>
                    <li class="event">
                        <h3><a href="/event/<?php echo $event['id'] ?>" class="link"><?php echo $event['name'] ?></a></h3>
                        <?php echo $event['date'] . ', ' . $event['start'] . ' - ' . $event['end'] ?>
                        <button class="showStudents" data-show="">Покажи студенти</button>

                        <div class="hidden_students"></br>
                            </br>
                            <!-- <h4>Списък със студенти, които са участвали</h4> -->
                            <?php
                            $sql = "SELECT * FROM student WHERE faculty_number IN 
                                        (SELECT faculty_number FROM attendance WHERE event_id=:eventId)";
                            $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                            $preparedStmt->execute(['eventId' => $event['id']]);
                            $studentsWhoParticipated = $preparedStmt->fetchAll();
                            if ($studentsWhoParticipated === false) {
                                throw new \Exception();
                            }
                            ?>
                            <?php if (count($studentsWhoParticipated) === 0) : ?>
                                Този студент не участва в никакви събития
                            <?php endif; ?>
                            <ul>
                                <?php foreach ($studentsWhoParticipated as $student) : ?>
                                    <li>
                                        <a href="/attendance?fn=<?= $student['faculty_number'] ?>" class="link">
                                            <?php echo $student['faculty_number'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </section>



    <section id="studentsStatistics">
        <h2>Всички студенти</h2>
        <ol id="studentsList">
            <?php foreach ($data['students'] as $student) : ?>
                <li class="student">
                    <h3>
                        <?php
                        echo $student['faculty_number'] . ' ';
                        echo $student['first_name'] . ' ';
                        echo $student['last_name'];
                        ?>
                    </h3>
                    <button class="showEvents" data-show="">Покажи събития</button>
                    <div class="hidden_events">
                        </br>
                        </br>
                        <!-- <h4>Списък със събития, в които е участвал</h4> -->
                        <?php
                        $sql = "SELECT * FROM events WHERE id IN 
                                            (SELECT event_id FROM attendance WHERE faculty_number=:fn)";
                        $preparedStmt = \Core\Database::getConnection()->prepare($sql);

                        $preparedStmt->execute(["fn" => $student['faculty_number']]);

                        $eventsForStudent = $preparedStmt->fetchAll();
                        if ($eventsForStudent === false) {
                            throw new \Exception();
                        }
                        ?>
                        <?php if (count($eventsForStudent) === 0) : ?>
                            Този студент не участва в никакви събития
                        <?php endif; ?>
                        <ul>
                            <?php foreach ($eventsForStudent as $event) : ?>
                                <li>
                                    <a href="/event/<?= $event['id'] ?>" class="link"><?= $event['name'] ?></a>
                                    <?php echo $event['name'] . " " . $event['date'] . " " . $event['start'] . "-" . $event['end']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </section>


</main>


<script src="/dashboard.js"></script>

</body>

</html>

<?php require_once('includes/footer.php'); ?>