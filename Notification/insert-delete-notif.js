$(document).ready(function () {
    const sse = new EventSource('check_expiration.php');

    sse.onmessage = function(event) {
        console.log(event.data);
    }

    // sse.onerror = function(err) {
    //     console.log(err);
    // }

$(document).on('click', "#btn-del", function () {
    var row_id = $(this).data('id');
    console.log(row_id)
    $.ajax({
        url: "delete-notif.php?id=" + row_id,
        method: "GET",
        success: function (response) {
            console.log(response);
            location.reload();
        }
    });
});



//fetch table to notification.php

setInterval(()=> {
    $.ajax({
        url: "fetch-notif-table.php",
        method: "POST",
        success: function (response) {
            $("#fetch-table").html(response);
            console.log("there's a response");
        }
    });
}, 500);
});