var buttonsStudents = document.getElementsByClassName('showEvents');
for (var i = 0; i < buttonsStudents.length; i++) {
    buttonsStudents[i].addEventListener('click', toggleStatisticsStudents);
}

var buttonsEvents = document.getElementsByClassName('showStudents');
for (var i = 0; i < buttonsEvents.length; i++) {
    buttonsEvents[i].addEventListener('click', toggleStatisticsEvents);
}


function toggleStatisticsStudents(event) {
    let btn = event.target
    let show = Boolean(btn.getAttribute('data-show'));
    let events = btn.parentElement.getElementsByClassName('hidden_events')[0];

    if (show) {
        events.style.display = "none";
        btn.innerHTML = "Покажи събития";
        btn.setAttribute('data-show', '');
    } else {
        events.style.display = "block";
        btn.innerHTML = "Скрий събития";
        btn.setAttribute('data-show', '1');
    }
}

function toggleStatisticsEvents(event) {
    let btn = event.target
    let show = Boolean(btn.getAttribute('data-show'));
    let events = btn.parentElement.getElementsByClassName('hidden_students')[0];

    if (show) {
        events.style.display = "none";
        btn.innerHTML = "Покажи студенти";
        btn.setAttribute('data-show', '');
    } else {
        events.style.display = "block";
        btn.innerHTML = "Скрий студенти";
        btn.setAttribute('data-show', '1');
    }
}