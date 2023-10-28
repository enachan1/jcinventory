$(document).ready(function () {
    $("#alert-call").hide();
    $("#submit_form").submit(function (e) { 
        e.preventDefault();
        var password = $("#the_password").val();
        var conf_pass = $("#confirm_pass").val();


        if(password.length < 6) {
            alert("Please Enter Longer Password");
            $("#the_password").focus();
        }
        else if (password != conf_pass) {
            alert("Password Did not match");
            $("#confirm_pass").focus();
        }

        else {
            $.ajax({
                url: "add_accounts.php",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    $("#myModal").modal('hide');
                    $("#alert-text").text(response);
                    $("#alert-call").show();
                    clear();
                }
            });
        }
        
    });


    $(document).on("click", ".btn-clsbtn", function() {  
        $("#alert-call").hide();
    });

    $(document).on("click", ".mdl-tp-cls", function() {  
        clear();
    });

    $(document).on("click", ".mdl-bt-cls", function() {  
        clear();
    });



    $(document).on("click", ".delete-btn", function() {
        var account_id = $(this).data("accid");

        $("#confirmation-modal").modal('show');
        
       
        $(document).off('click').on('click','#mdl-yes', function(e) {
            e.preventDefault();
            console.log("yes");

            $.ajax({
                url: "delete_acc.php?acc=" + account_id,
                method: "GET",
                data: $(this).serialize(),
                success: function (response) {
                    $("#confirmation-modal").modal('hide');
                    location.reload();
                    $("#alert-text").text(response);
                    $("#alert-call").show();
                }
            });
        });
    });
});


function clear() {
    $("#account_name").val(" ");
    $("#account_email").val("");
    $("#account_email").val("");
    $("#account_contact").val("");
    $("#the_password").val("");
    $("#confirm_pass").val("");
}