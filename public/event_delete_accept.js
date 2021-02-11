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
    //намиране на коментара в базата данни => променяме is_visible и pending
    //sql = "SET is_visible, pending FROM comments VALUES(false, false) WHERE fn=commentFN AND textContent = commentText";
}