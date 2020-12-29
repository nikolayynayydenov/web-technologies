<?php require_once('includes/header.php'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

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
                        <div class="form-group col-md-4 mb-3">
                            <label for="datettime">Date & Time</label>
                            <input type="text" class="form-control" id="datetime" placeholder="Date & Time">
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            <label for="timepicker">Date & Time</label>
                            <input type="text" class="form-control" id="timepicker" placeholder="Time">
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
                        <div class="form-check form-check-inline col-md-2 mb-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Student">
                            <label class="form-check-label" for="inlineRadio1">Ученик</label>
                        </div>
                        <div class="form-check form-check-inline col-md-2 mb-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Teacher">
                            <label class="form-check-label" for="inlineRadio2">Преподавател</label>
                        </div>
                    </div>

                    <div class="form-row d-none" id="if_student">

                        <div class="form-group col-md-4 mb-3">
                            <label for="Number">Номер</label>
                            <input type="text" class="form-control" id="Number" placeholder="Номер">
                        </div>
                        
                        <div class="form-group clearfix col-md-4 mb-3">
                            <label for="Grade">Клас</label>
                            <select id="Grade" class="form-control" required>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <div class="form-group clearfix col-md-4 mb-3">
                            <label for="Group">Паралелка</label>
                            <select id="Group" class="form-control" required>
                                <option value="A">А</option>
                                <option value="B">Б</option>
                                <option value="C">В</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row d-none" id="if_teacher">
                        <div class="form-group col-md-4 mb-3">
                            <label for="TecherNumber">Идентификационен номер</label>
                            <input type="text" class="form-control" id="TeacherNumber" placeholder="Номер">
                        </div>
                    </div>

                    
                    <!-- </div> -->
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning mx-5 my-4">Регистрирай събитиeто</button>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary mb-5 mx-5" onclick="window.location='front_page.php';">Върни се към заглавната страница</button>
                    </div>
                  </form>
            </div>
        
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <div class="datetime-group">
        <label for="producedOn">Produced On</label>
        <input id="producedOn" type="text" placeholder="Date & Time...">
    </div>

    <!-- <script src="jquery.datetimepicker.full.js"></script> -->
    <script>
        $('#datetime').datepicker({
            //startDate:'+2018/01/01'
        });
        $('#timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
    </script>
    

<?php require_once('includes/footer.php'); ?>