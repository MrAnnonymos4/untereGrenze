'use strict';


function sendInvitation(taskId, userId) {
    getRequest("sendInvitation.php?taskId=" + taskId + "&userId=" + userId);
    $("#inviteButton" + userId).remove();
}



function getRequest(queryString, callbackFunction) {
    var xmlhttp = new XMLHttpRequest();
    let callback = arguments.length == 2;
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (callback) callbackFunction(this.responseText);
        }
    };
    xmlhttp.open("GET", "../api/" + queryString, true);
    xmlhttp.send();
}