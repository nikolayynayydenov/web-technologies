(function() {
    var events = document.querySelectorAll('#eventsList li.event');
    console.log(events);
    for (var i = 0; i < events.length; i++) {
        events[i].addEventListener("click", showStatistics(events[i]));
    }
})();

function showStatistics(element) {

}