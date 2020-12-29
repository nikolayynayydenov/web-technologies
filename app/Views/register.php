<?php require_once('includes/header.php'); ?>

    

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
                        <button type="submit" class="btn btn-success mx-5 my-4">Регистрирай се</button>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary mb-5 mx-5" onclick="window.location='front_page.html';">Върни се към заглавната страница</button>
                    </div>
                  </form>
            </div>
        
        </div>
    </div>

    <?php require_once('includes/footer.php'); ?>