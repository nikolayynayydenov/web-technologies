<?php require_once('includes/header.php'); ?>
<link rel="stylesheet" href="/teachersRegister.css">

    <h1>Регистрация на преподаватели</h1>
    <hr>

    <form action="/enter-teacher" method="POST">
        <?php flashErrors() ?>
        <div>
            <label for="firstName">Име</label>
            <input type="text" name="firstName" id="firstName">
        </div>
        <div>
            <label for="lastName">Фамилия</label>
            <input type="text" name="lastName" id="lastName">
        </div>
        <div>
            <label for="email">Имейл</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Парола</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="confirmPassword">Потвърди паролата</label>
            <input type="password" name="confirmPassword" id="confirmPassword">
        </div>
        <div>
            <input type="submit" value="Регистрирай се">
        </div>
    </form>



<script src="registerScript.js"></script>

<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>

<script src="public/registerScript.js"></script>

<script>
    $(function() {
        $('#inlineRadio1:checked').click();
        //$('input:radio[name=inlineRadio_student]:checked').click();
        $('#inlineRadio1').on('click', function() {
            $('#if_student').removeClass("d-none");
            //$('#if_teacher').addClass('d-none');
        });
        $('#inlineRadio2:checked').click();
        //$('input:radio[name=inlineRadio_teacher]:checked').click();
        $('#inlineRadio2').on('click', function() {
            $('#if_student').addClass('d-none');
            //$('#if_teacher').removeClass('d-none');
        });
    });
</script>

<?php require_once('includes/footer.php'); ?>