(function() {
    var buttons_delete = document.getElementsByClassName('btn_delete');
    var buttons_accept = document.getElementsByClassName('btn_accept');
    for(var i=0; i<buttons_accept.length; i++){
        buttons_delete[i].addEventListener("click", deleteComment(buttons_accept[i].parentElement));
        buttons_accept[i].addEventListener("click", acceptComment(buttons_delete[i].parentElement));
    }
})();

deleteComment(divToDelete)
{
    divToDelete.style.display ="none";
    var commentFN = divToDelete.children[1].innerHTML; //innerText?
    var commentText = divToDelete.children[2].innerHTML; ///innerText?

    var http = new XMLHttpRequest();
    var url = 'get_data.php';
    var params = 'orem=ipsum&name=binny';
    http.open('POST', url, true);

    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/json');

    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            var sql = "UPDATE comments SET is_visible, pending VALUES(false, false) 
                        WHERE fn=commentFN AND textContent = commentText";
        }
    }
    http.send(params);

    //намиране на коментара в базата данни => променяме is_visible и pending
    //$sql = "UPDATE comments SET is_visible, pending VALUES(false, false) WHERE fn=commentFN AND textContent = commentText";
}

acceptComment(divToChange)
{
    var commentFN = divToChange.children[1].innerHTNL;
    var commentText = divToDelete.children[2].innerHTML;

}

