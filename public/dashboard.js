(function() {
    var buttonsStudents = document.getElementsByClassName('showEvents');
    for(var i=0; i<buttonsStudents.length; i++){
        buttonsStudents[i].addEventListener('click', toggleStatisticsStudents(i, buttonsStudents[i]));
        console.log(buttonsStudents[i]);
    }
    var buttonsEvents = document.getElementsByClassName('showStudents');
    for(var i=0; i<buttonsEvents.length; i++){
        buttonsEvents[i].addEventListener('click', toggleStatisticsEvents(i, buttonsEvents[i]));
        console.log(buttonsEvents[i]);
        console.log(i);
    }

})();


function toggleStatisticsStudents(i, button) {
    var eventsForStudent = document.getElementsByClassName('.hidden_student');
    console.log(eventsForStudent);
    var count=0;
    if(count%2==0){
        eventsForStudent[i].style.display="block";
        button.innerHTML="Скрий събития";

    }
    if(count%2==1){
        eventsForStudent[i].style.display="none";
        button.innerHTML = "Покажи събития";
    }
}

function toggleStatisticsEvents(i, button){
    var studentsForEvent = document.getElementsByClassName('.hidden_event');
    console.log(studentsForEvent);
    var count=0;
    if(count%2==0){
        studentsForEvent[i].style.display="block";
        button.innerHTML="Скрий студенти";
    }
    if(count%2==1){
        studentsForEvent[i].style.display="none";
        button.innerHTML="Покажи студенти";
    }
}