
<?php require_once('includes/header.php'); ?>


    <div class="d-flex justify-content-center">
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
                            <label for="firstName">Име</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Име">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 mb-3">
                            <label for="LastName">Фамилия</label>
                            <input type="text" class="form-control" id="LastName" placeholder="Фамилия">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12 mb-3">
                            <label for="pass">Парола</label>
                            <input type="password" class="form-control" id="pass" placeholder="Парола">
                        </div>
                    </div>

                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mx-5 my-4">Влез в профила си</button>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary mb-5 mx-5" onclick="window.location='front_page.html';">Върни се към заглавната страница</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>

    
<?php require_once('includes/footer.php'); ?>

