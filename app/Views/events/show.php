<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>

<div class="container">
    <h4><?= $data['event']->name ?></h4>


    <p>
        <?= $data['event']->description ?>

        <hr>

        <strong>Дата: </strong> <?= $data['event']->date ?>
        <strong>Начало: </strong> <?= $data['event']->start ?>
        <strong>Край: </strong> <?= $data['event']->end ?>
    </p>

    <p>
        <?= sessionFlash('message') ?>
    </p>

    <?php if (App\Services\Auth::check()) : ?>
        <form action="/event/<?= $data['event']->id ?>/import" method="post" enctype="multipart/form-data">
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
            if (\App\Services\Auth::check()) {
            }
        }
    }
    ?>
</div>

<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>