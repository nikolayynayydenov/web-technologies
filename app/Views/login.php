<?php require_once('includes/header.php'); ?>
<link rel="stylesheet" href="/teachersLogin.css">

<h1>Вход за преподаватели</h1>
<hr>
<form action="/login" method="POST">
    <?php flashErrors(); ?>
    <div>
        <label for="email">Имейл</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="password">Парола</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <input type="submit" value="Влез">
    </div>
</form>

<!-- <div class="d-flex justify-content-center">
    <div class="border border-primary rounded m-5">
        <div class="d-flex justify-content-center px-5 pt-5">
            <h1>
                Вход
            </h1>
        </div>
        <div class="d-flex flex-column">
            <form class="px-5">
                <div class="form-row">
                    <div class="form-group col-md-12 mb-3">
                        <label for="email">Имейл</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12 mb-3">
                        <label for="pass">Парола</label>
                        <input type="password" class="form-control" id="pass">
                    </div>
                </div>


                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mx-5 my-4">Влез в профила си</button>
                </div>

                <div class="d-flex justify-content-center">
                    <a class="btn btn-secondary mb-5 mx-5" href="/">Върни се към заглавната страница</a>
                </div>
            </form>
        </div>
    </div>
</div> -->


<?php require_once('includes/footer.php'); ?>