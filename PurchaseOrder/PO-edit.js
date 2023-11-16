$(document).ready(function () {
    $(document).on("click", "#editPObtn", function(e) { 
        var edit_data = $(this).data('vendoridtbl');

        $.ajax({
            url: "generate-edit-table.php?vendorid=" + edit_data,
            method: "GET",
            success: function (response) {
                console.log(response);  
            }
        });
        
    });
});
