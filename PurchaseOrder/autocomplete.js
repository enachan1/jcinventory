$(document).ready(function () {
    $('#vendorID').keyup(function (e) { 
        e.preventDefault();
        var vendorId_text = parseFloat($(this).val());


        if(vendorId_text != '') {
            $.ajax({
                url: "fetch_autocomplete.php",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({ query: vendorId_text }),
                success: function (response) {
                    $("#showlist_vendorid").html(response);
                }
            });
        } else {
            $("#showlist_vendorid").html('');
        }
    });

    $(document).on('click', '.clickers', function(e) {
        var get_vendorID = $(this).text();
        $('#vendorID').val(get_vendorID);

        $.ajax({
            url: "getName.php",
                method: "POST",
                data: { v_id: get_vendorID },
                success: function (response) {
                    console.log("there's a response");
                    $("#vendorNAME").val(response);
                }
            });
        

        $("#showlist_vendorid").html('');
    });
});