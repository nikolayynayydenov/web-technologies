<?php //require_once('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <title>TheSystem</title>
</head>
<body>

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
                        <button type="button" class="btn btn-secondary mb-5 mx-5" onclick="window.location='front_page';">Върни се към заглавната страница</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>

    
<?php //require_once('includes/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"
    integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
    crossorigin="anonymous"></script>


    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
