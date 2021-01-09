// $(function(){
//     var events = querySelectorAll('ul li');
//     console.log(events);
//     for(var i=0; i<events.length; i++){
//         events[i].addEventListener('click', showStatistics(events[i]));
//     }
// });

function my_function(){
    var events = querySelectorAll('ul li');
    console.log(events);
    for(var i=0; i<events.length; i++){
        events[i].addEventListener('click', showStatistics(events[i]));
    }
}

function showStatistics(element){
    var el = element.getElementBytagName('div');
    console.log(el);
    el.style.display = 'block';
}