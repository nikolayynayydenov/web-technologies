<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>

<?= $data['event']->name ?>
<br>
<?= $data['event']->description ?>
<br>
<?= sessionFlash('message') ?>

<form action="/event/<?= $data['event']->id ?>/import" method="post" enctype="multipart/form-data">
    <input type="file" name="attendance_file">
    <input type="submit" value="Импортиране на присъствия">
</form>

<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>