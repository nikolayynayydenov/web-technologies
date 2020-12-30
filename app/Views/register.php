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
        <div class="border border-success rounded m-5">
            <div class="d-flex justify-content-center px-5 pt-5">
                <h1>
                    Регистрация
                </h1>
            </div>
            <div class="d-flex flex-column">
                <form class="px-5">
                    <div class="form-row">
                        <div class="form-group col-md-4 mb-3">
                            <label for="firstName">Име</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Име">
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            <label for="secondName">Презиме</label>
                            <input type="text" class="form-control" id="secondName" placeholder="Презиме">
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            <label for="LastName">Фамилия</label>
                            <input type="text" class="form-control" id="LastName" placeholder="Фамилия">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="pass">Парола</label>
                            <input type="password" class="form-control" id="pass" placeholder="Парола">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="confirmPass">Потвърди паролата</label>
                            <input type="password" class="form-control" id="confirmPass" placeholder="Потвърди паролата">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="email">Имейл</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-check form-check-inline col-md-2 mb-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Student">
                            <label class="form-check-label" for="inlineRadio1">Студент</label>
                        </div>
                        <div class="form-check form-check-inline col-md-2 mb-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Teacher">
                            <label class="form-check-label" for="inlineRadio2">Преподавател</label>
                        </div>
                    </div>

                    <div class="form-row d-none" id="if_student">
                        <div class="form-group col-md-3 mb-3">
                            <label for="Number">Факултетен номер</label>
                            <input type="text" class="form-control" id="Number" placeholder="Номер">
                        </div>
                        
                        <div class="form-group col-md-3 mb-3">
                            <label for="Specialnost">Специалност</label>
                            <select id="Specialnost" class="form-control" required>
                                <option value="mathematics">Математика</option>
                                <option value="pmath">Приложна математика</option>
                                <option value="stat">Статистика</option>
                                <option value="informatics">Информатика</option>
                                <option value="infoSystems">Информационни системи</option>
                                <option value="computerScience">Компютърни науки</option>
                                <option value="SoftwareEngineering">Софтурно инженерство</option>
                                <option value="MathAndInforamtics">Математика и информатика</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3 mb-3">
                            <label for="Year">Курс</label>
                            <select id="Year" class="form-control" required>
                                <option value="1">I</option>
                                <option value="2">II</option>
                                <option value="3">III</option>
                                <option value="4">IV</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3 mb-3">
                            <label for="Group">Група</label>
                            <select id="Group" class="form-control" required>
                                <option value="1">Първа</option>
                                <option value="2">Втора</option>
                                <option value="3">Трета</option>
                                <option value="4">Четвърта</option>
                                <option value="5">Пета</option>
                                <option value="6">Шеста</option>
                                <option value="7">Седма</option>
                                <option value="8">Осма</option>
                            </select>
                        </div>
                    </div>

                    <!-- <div class="form-row d-none" id="if_teacher">
                        <div class="form-group col-md-4 mb-3">
                            <label for="TecherNumber">Идентификационен номер</label>
                            <input type="text" class="form-control" id="TeacherNumber" placeholder="Номер">
                        </div>
                    </div> -->

                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success mx-5 my-4">Регистрирай се</button>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary mb-5 mx-5" onclick="window.location='front_page';">Върни се към заглавната страница</button>
                    </div>
                </form>
            </div>
        
        </div>
    </div>
    <script src="registerScript.js"></script>

<?php //require_once('includes/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"
    integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
    crossorigin="anonymous"></script>

    <script src="public/registerScript.js"></script>

    <script>
        $(function(){
            $('#inlineRadio1:checked').click();
            //$('input:radio[name=inlineRadio_student]:checked').click();
            $('#inlineRadio1').on('click', function(){
                $('#if_student').removeClass("d-none");
                //$('#if_teacher').addClass('d-none');
            });
            $('#inlineRadio2:checked').click();
            //$('input:radio[name=inlineRadio_teacher]:checked').click();
            $('#inlineRadio2').on('click', function(){
                $('#if_student').addClass('d-none');
                //$('#if_teacher').removeClass('d-none');
            });
        });
    </script>

    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>