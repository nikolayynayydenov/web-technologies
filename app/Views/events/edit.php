<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>
<link rel="stylesheet" href="/registerEvent.css">

<main>
    <h1>Промна на събитие <strong><?= $data['event']->name ?></strong></h1>
    <hr>
    <form action="/event/<?= $data['event']->id ?>" method="POST">
        <input type="hidden" name="_method" value="PUT">

        <div class="field">
            <label for="name">Име</label>
            <input type="text" id="name" placeholder="Име на събитието" name="name" value="<?= $data['event']->name ?>">
        </div>

        <div class="field">
            <label for="date">Дата</label>
            <input type="date" id="date" placeholder="01/01/2021" name="date" value="<?= $data['event']->date ?>">
        </div>

        <div class="field" id="selectFields">
            <label for="start">Начало</label>
            <select name="start" id="start">
                <?php for ($i = 8; $i < 20; $i++) {
                    $value = lz($i) . ":15:00";
                    $displayValue = "$i:15";
                    $selected = $value === $data['event']->start ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$displayValue</option>";
                }
                ?>
            </select>

            <label for="end">Край</label>
            <select name="end" id="end">
                <?php for ($i = 9; $i < 21; $i++) {
                    $value = lz($i) . ":00:00";
                    $displayValue = "$i:00";
                    $selected = $value === $data['event']->end ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$displayValue</option>";
                }
                ?>
            </select>
        </div>

        <div class="field">
            <label for="description">Описание</label>
            <textarea name="description" id="description" cols="50" rows="7" placeholder="Кратко описание на събитието"><?= $data['event']->description ?></textarea>
        </div>

        <input type="submit" value="Добави събитието!">
    </form>
</main>
<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>