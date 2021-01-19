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


    <form action="/event/<?= $data['event']->id ?>/import" method="post" enctype="multipart/form-data">
        <input type="file" name="attendance_file">

        <br />
        <br />

        <input class="btn btn-info" type="submit" value="Импортиране на присъствия">
    </form>
</div>

<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>