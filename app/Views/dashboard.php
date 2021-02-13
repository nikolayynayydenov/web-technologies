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
                    Нови коментари: <?php $_SESSION['numberOfNewComments'] ?>
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
                <?php foreach ($data['eventsWithPendingComments'] as $event) : ?>
                    <li class="event">
                        <h3><a href="/event/<?= $event['id'] ?>" class="link"><?= $event['name'] ?></a></h3>
                        <?php echo $event['date'] . ', ' . $event['start'] . ' - ' . $event['end'] ?>
                        <h4>Списък със студенти, които са участвали</h4>
                        <div class="hidden">
                            <ol>
                                <?php
                                $sql = "SELECT * FROM student WHERE faculty_number IN (SELECT faculty_number FROM attendance WHERE event_id=:eventId)";
                                $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                                $preparedStmt->execute(['eventId' => $event['id']]);
                                $studentsWhoParticipated = $preparedStmt->fetchAll();
                                if ($studentsWhoParticipated === false) {
                                    throw new \Exception();
                                }
                                ?>
                                <?php foreach ($studentsWhoParticipated as $student) : ?>
                                    <li>
                                        <a href="/attendance?fn=<?= $student['faculty_number'] ?>" class="link">
                                            <?= $student['faculty_number'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>



            <h2>
                Събития
            </h2>
            <ul id="eventsList">
                <?php foreach ($data['eventsWithoutPendingComments'] as $event) : ?>
                    <li class="event">
                        <h3><a href="/event/<?php $event['id'] ?>" class="link"><?php $event['name'] ?></a></h3>
                        <?php echo $event['date'] . ', ' . $event['start'] . ' - ' . $event['end'] ?>

                        <h4>Списък със студенти, които са участвали</h4>
                        <div class="hidden">
                            <ol>
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
                                <?php foreach ($studentsWhoParticipated as $student) : ?>
                                    <li>
                                        <a href="/attendance?fn=<?= $student['faculty_number'] ?>" class="link">
                                            <?= $student['faculty_number'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </li>
                <?php endforeach; ?>

                <!-- това са всички събития, а ние искаме да разделим, pending от не-pending -->
                <?php foreach ($data['events'] as $event) :  ?>
                    <li class="event">
                        <h3><a href="/event/<?= $event->id ?>" class="link"><?= $event->name ?></a></h3>

                        <?= $event->date . ', ' . $event->start . ' - ' . $event->end ?>
                        <h4>Списък със студенти, които са участвали</h4>
                        <div class="hidden">
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

        <?php endif; ?>


        <?php if (\App\Services\Auth::checkStudent()) : ?>
            <h2>Събитията, в които съм участвал</h2>
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
                <?php foreach ($eventsOfStudent as $event) : ?>
                    <li class="event">
                        <h3><a href="/event/<?= $event['id'] ?>" class="link"><?= $event['name'] ?></a></h3>
                        <?= $event['date'] . ', ' . $event['start'] . ' - ' . $event['end'] ?>

                        <h4>Списък със студенти, които са участвали</h4>
                        <div class="hidden">
                            <ol>
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
                                <?php foreach ($studentsWhoParticipated as $student) : ?>
                                    <li>
                                        <a href="/attendance?fn=<?= $student['faculty_number'] ?>" class="link">
                                            <?= $student['faculty_number'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h2>Всички останали събития</h2>
            <ul>
                <?php
                $sql = "SELECT * FROM events WHERE id IN (SELECT event_id FROM attendance WHERE NOT (faculty_number=:fn))";
                $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                $preparedStmt->execute(["fn" => $_SESSION['fn']]);
                $eventsOfStudent = $preparedStmt->fetchAll();
                if ($eventsOfStudent === false) {
                    throw new \Exception();
                }
                ?>
                <?php foreach ($eventsOfStudent as $event) : ?>
                    <li class="event">
                        <h3><a href="/event/<?= $event['id'] ?>" class="link"><?= $event['name'] ?></a></h3>
                        <?= $event['date'] . ', ' . $event['start'] . ' - ' . $event['end'] ?>

                        <h4>Списък със студенти, които са участвали</h4>
                        <div class="hidden">
                            <ol>
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
                                <?php foreach ($studentsWhoParticipated as $student) : ?>
                                    <li>
                                        <a href="/attendance?fn=<?= $student['faculty_number'] ?>" class="link">
                                            <?= $student['faculty_number'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </section>



    <section id="studentsStatistics">
        <h2>Студенти</h2>
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
                    <h4>Списък със събития, в които е участвал</h4>
                    <div class="hidden">
                        <ol>
                            <?php
                            $sql = "SELECT * FROM events WHERE id IN 
                                            (SELECT event_id FROM attendance WHERE faculty_number=:fn)";
                            $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                            try {
                                $preparedStmt->execute(["fn" => $student['faculty_number']]);
                            } catch (\PDOException $e) {
                                $errMsg = $e->getMessage();
                            }
                            $eventsForStudent = $preparedStmt->fetchAll();
                            if ($eventsForStudent === false) {
                                throw new \Exception();
                            }
                            ?>
                            <?php foreach ($eventsForStudent as $event) : ?>
                                <li>
                                    <a href="/event/<?= $event['id'] ?>" class="link"><?= $event['name'] ?></a>
                                    <?php echo $event['name'] . " " . $event['date'] . " " . $event['start'] . "-" . $event['end']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
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