<?php require_once('includes/header.php'); ?>
<link rel="stylesheet" href="/registerEvent.css">

    <main>
        <h2>Създаване на събитие</h2>
        <hr>
        <form action="enterEventIntoDB.php" method="POST">
            <div class="field">
                <label for="name">Име</label>
                <input type="text" id="name" placeholder="Име на събитието">
            </div>

            <div class="field">
                <label for="date">Дата</label>
                <input type="text" id="data" placeholder="01/01/2021">
            </div>

            <div class="field" id="selectField1">
                <label for="start">Начало</label>
                <select name="start" id="start">
                    <option value="8">8:15</option>
                    <option value="9">9:15</option>
                    <option value="10">10:15</option>
                    <option value="11">11:15</option>
                    <option value="12">12:15</option>
                    <option value="13">13:15</option>
                    <option value="14">14:15</option>
                    <option value="15">15:15</option>
                    <option value="16">16:15</option>
                    <option value="17">17:15</option>
                    <option value="18">18:15</option>
                    <option value="19">19:15</option>
                    <option value="20">20:15</option>
                </select>
            </div>

            <div class="field" id="selectField2">
                <label for="end">Край</label>
                <select name="end" id="end">
                    <option value="9">9:00</option>
                    <option value="10">10:00</option>
                    <option value="11">11:00</option>
                    <option value="12">12:00</option>
                    <option value="13">13:00</option>
                    <option value="14">14:00</option>
                    <option value="15">15:00</option>
                    <option value="16">16:00</option>
                    <option value="17">17:00</option>
                    <option value="18">18:00</option>
                    <option value="19">19:00</option>
                    <option value="20">20:00</option>
                    <option value="21">21:00</option>
                </select>
            </div>

            <div class="field">
                <label for="description">Описание</label>
                <textarea name="description" id="description" cols="50" rows="7" placeholder="Кратко описание на събитието"></textarea>
            </div>

            <input type="submit" value="Добави събитието!">
        </form>
    </main>
</body>
</html>