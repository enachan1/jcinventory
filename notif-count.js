$(document).ready(function () {
    const sse = new EventSource('../Notification/check_expiration.php');

    setInterval(function() {
        $.ajax({
            method: "POST",
            url: "../Notification/count.php",
            success: function (response) {
                if(response != 0) {
                    $(".num-notif").text(response);
                }
                else {
                    $(".num-notif").text("");
                }
                
            }
        });

    },500);
        

});