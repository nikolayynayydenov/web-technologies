<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>

<div class="container">
    <?php if (count($data['events']) === 0) : ?>

        Студент с този факултетен номер не е участвал в никакви събития.

    <?php endif; ?>

    <h4>Събития, в които студент с ФН: <strong><?= $data['fn'] ?></strong> е участвал.</h4>
    <ul>
        <?php foreach ($data['events'] as $event) : ?>
            <li class="list-item">
                <a style="color: black;" href="/event/<?= $event['id'] ?>"><?= $event['name'] ?></a>
                <p>
                    <?= $event['description'] ?>

                    <hr class="dark">

                    <strong>Дата: </strong> <?= $event['date'] ?>
                    <strong>Начало: </strong> <?= $event['start'] ?>
                    <strong>Край: </strong> <?= $event['end'] ?>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>