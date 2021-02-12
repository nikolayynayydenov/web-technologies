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
            <p id="undoneComments">
                <?php if (isset($_SESSION['numberOfNewComments'])) { ?>
                    Нови коментари: <?php $_SESSION['numberOfNewComments'] ?>
                <?php } ?>
            </p>
            <a href="/event/create" id="createEventBtn">
                Създай събитие
            </a>
        </div>
        <hr>
    </div>

    <section id="eventsStatistics">
        <?php if(!$_SESSION['fn']) : ?>
        <h4>
            Събития с нови коментари
        </h4>
        <ul>
            <?php
            $eventsWithPendingCommentsQuery = \App\Models\Comment::extractEventsWithPendingComments();
            if (
                $eventsWithPendingCommentsQuery["successfullyExecuted"] == true &&
                $eventsWithPendingCommentsQuery["thereAreEvents"] == true
            ) 
            {
                $data['eventsWithPendingComments'] = $eventsWithPendingCommentsQuery['eventsWithPendingComments'];
            }


            ?>
            <?php foreach($data['eventsWithPendingComments'] as $event) : ?>
                <li class="event">
                    <h5><a href="/event/<?= $event->id ?>" class="link"><?= $event->name ?></a></h5>
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
            <?php endforeach;?>
        </ul>

        <?php endif; ?>                         

        <h4>
            Събития
        </h4>
        <ul id="eventsList">
            <?php foreach ($data['events'] as $event) :  ?>
                <li class="event">
                    <h5><a href="/event/<?= $event->id ?>" class="link"><?= $event->name ?></a></h5>

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
        <?php foreach($data['students'] as $student) : ?>
            <li class="student"><h5><?php echo $student->getFN(); echo $student->getFirstName(); echo $student->getLastName();?><h5>
                <div class="hidden">
                    <h6>Списък със събития, в които е участвал</h6>
                    <ol>
                    <?php 
                        $sql="SELECT * FROM events WHERE id IN (SELECT event_id FROM attendance WHERE faculty_number=:fn)";
                        $preparedStmt = Core\Database::getConnection()->prepare($sql);
                        try{
                            $preparedStmt->execute(["fn" => $student->getFN()]);
                        }catch(\PDOException $e){
                            $errMsg = $e->getMessage();
                        }
                    ?>
                    <?php foreach($data['eventsForStudent'] as $event) : ?>
                        <li>
                            <a href="/event/<?= $event->id ?>" class="link"><?= $event->name ?></a>
                            <?php echo $event->name . " " . $event->date . " " . $event->start . "-" . $event->end;?>
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