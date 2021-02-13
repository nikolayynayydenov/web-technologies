<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>
<link rel="stylesheet" href="/event_show.css">

<div class="container">
    <div>
        <h4><?= $data['event']->name ?></h4>
    </div>
    <div style="float:right;">
        <a href="/event/<?= $data['event']->id ?>/edit" class="btn btn-info">Промяна</a>
        <form style="margin-top: 5%;" action="/event/<?= $data['event']->id ?>" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" class="btn btn-danger" value="Изтриване">
        </form>
    </div>



    <p>
        <strong>Описание: </strong> <?= $data['event']->description ?>

        <hr>

        <strong>Дата: </strong> <?= $data['event']->date ?><br>
        <strong>Начало: </strong> <?= $data['event']->start ?><br>
        <strong>Край: </strong> <?= $data['event']->end ?><br>
    </p>

    <p>
        <?= sessionFlash('message') ?>
    </p>

    <?php if (App\Services\Auth::checkTeacher()) : ?>
        <form id="import" action="/event/<?= $data['event']->id ?>/import" method="post" enctype="multipart/form-data">
            <input type="file" name="attendance_file">

            <br />
            <br />

            <input class="btn btn-info" type="submit" value="Импортиране на присъствия">
        </form>
    <?php endif; ?>

    <hr>

    <h3>Присъствия</h3>

    <?php if (count($data['attendances']) === 0) : ?>
        <h5>Няма импортирани присъствия</h5>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <td>Факултетен номер</td>
                    <td>Час на записване</td>
                    <td>Процент доверие</td>
                    <td>Описание</td>
                    <td>Източник</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['attendances'] as $attendance) : ?>
                    <tr>
                        <td><?= $attendance->faculty_number ?></td>
                        <td><?= $attendance->logged_at ?></td>
                        <td><?= $attendance->thrust ?></td>
                        <td><?= $attendance->check_description ?></td>
                        <td><?= $attendance->enroll_source ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php foreach ($data['comments'] as $comment) {
        if ($comment->is_approved) {
        } else {
            if (\App\Services\Auth::checkTeacher()) {
            }
        }
    }
    ?>

    <!-- следващият див да се визуализира само ако потребителят е преподавател -->
    <div id="messages">
        <?php if (isset($_SESSION["message"])) : ?>
            <?php echo $_SESSION["message"]; ?>
            <?php unset($_SESSION["message"]); ?>
        <?php endif; ?>
    </div>

    <?php if (\App\Services\Auth::checkTeacher()) : ?>
        <div id="pending_comments">
            <?php foreach ($data['comments'] as $comment) : ?>
                <?php if ($comment->getPending() == true) : ?>
                    <div class="pendingComments">
                        <h5><?= $comment->getFN() ?></h5>
                        <p><?= $comment->getTextContent() ?></p>
                        <button class="btn_accept">Приеми</button>
                        <button class="btn_delete">Изтрий</button>
                    </div>
                    <form action="" method="">
                        <input type="hidden" value="<?= $comment->id ?>">
                    </form>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <div id="visible_comments">
        <?php
        $sql = "SELECT * FROM comments WHERE is_visible=1 AND event_id=:eventID";
        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
        $preparedStmt->execute([
            "eventID" => $data['event']->id
        ]);
        $visibleComments = $preparedStmt->fetchAll();
        if($visibleComments === false){
            throw new \Exception();
        }
        ?>
        <?php foreach ($visibleComments as $comment) : ?>
            <?php if ($comment['is_visible'] == true) : ?>
                <div class="visibleComments">
                    <?php if ($_SESSION['fn']) : ?>
                        <h4><?= $comment['fn'] ?></h4>
                    <?php endif; ?>
                    <?php if (App\Services\Auth::checkTeacher()) : ?>
                        <?php $sql="SELECT first_name, last_name FROM teachers WHERE id=:teacherId";
                        $preparedStmt = \Core\Database::getConnection()->prepare($sql);
                        $preparedStmt->execute(["teacherId" => $comment['teacherId']]);
                        $names=$preparedStmt->fetchAll();
                        if($names===false){
                            throw new \Exception();
                        }
                        ?>
                        <h4><?=$names?></h4>
                    <?php endif; ?>
                    <p><?= $comment['textContent'] ?></p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>


    <div id="commentsForm">
        <h4>Напишете коментар:</h4>
        <form action="/event/<?php echo $data['event']->id; ?>/comment" method="POST">
            <div>
                <label for="textContent">Вашият коментар</label>
                <textarea name="textContent" id="textContent" cols="30" rows="10" palceholder="Коментар..."></textarea>
            </div>
            <div>
                <input type="submit" value="Запиши коментар">
            </div>
        </form>
    </div>

</div>


<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>