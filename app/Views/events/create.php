<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <title>TheSystem</title>
</head>
<body> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="d-flex justify-content-center">
    <div class="border border-warning rounded m-5">
        <div class="d-flex justify-content-center px-5 pt-5">
            <h1>
                Регистрация на събитие
            </h1>
        </div>

        <div class="d-flex flex-column">
            <form class="px-5">
                <div class="form-row">
                    <div class="form-group col-md-12 mb-3">
                        <label for="eventName">Име</label>
                        <input type="text" class="form-control" id="eventName" placeholder="Име на събитието">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4 mb-3">
                        <label for="teacherName">Име на преподавател</label>
                        <input type="text" class="form-control" id="teacherName" placeholder="Име">
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label for="teacherLastName">Фамилия на преподавател</label>
                        <input type="text" class="form-control" id="teacherLastName" placeholder="Фамилия">
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label for="teacherEmail">Имейл на преподавател</label>
                        <input type="email" class="form-control" id="teacherEmail" placeholder="Имейл">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="datettime">Дата</label>
                        <input type="text" class="form-control" id="datetime" placeholder="Избери дата">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="timepicker">Час</label>
                        <input type="text" class="form-control" id="timepicker" placeholder="Избери час">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12 mb-3">
                        <label for="description">Описание на събитието</label>
                        <textarea class="form-control" id="description" placeholder="Описание" rows="4"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning mx-5 my-4">Регистрирай събитиeто</button>
                </div>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-secondary mb-5 mx-5" href="/">Върни се към заглавната страница</a>
                </div>
            </form>
        </div>

    </div>
</div>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script src="public/registerScript.js"></script>
<script src="public/jquery.datetiempicker.full.js"></script>

<script>
    $('#datetime').datepicker({
        //startDate:'+2018/01/01'
    });
    $('#timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 15,
        minTime: '8',
        maxTime: '10:00pm',
        defaultTime: '8',
        startTime: '8:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
</script>

<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>