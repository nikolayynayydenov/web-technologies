<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>

<?= $data['event']->name ?>
<br>
<?= $data['event']->description ?>

<form action="/event/<?= $data['event']->id ?>/import" method="post">
    <input type="file" name="csv_file">
    <input type="submit" value="Импортиране на присъствия">
</form>

<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>