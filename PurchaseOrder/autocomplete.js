$(document).ready(function () {
    $('#vendorNAME').keyup(function (e) { 
        e.preventDefault();
        var get_vendorNAME = $(this).val();


        if(get_vendorNAME != '') {
            $.ajax({
                url: "fetch_autocomplete.php",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({ query: get_vendorNAME }),
                success: function (response) {
                    $("#showlist_vendorname").html(response);
                }
            });
        } else {
            $("#showlist_vendorname").html('');
        }
    });

    $(document).on('click', '.clickers', function(e) {
        var get_vendornm = $(this).text();
        $('#vendorNAME').val(get_vendornm);

        $.ajax({
            url: "getName.php",
                method: "POST",
                data: { v_name: get_vendornm },
                success: function (response) {
                    console.log("there's a response");
                    $("#vendorID").val(response);
                }
            });
        

        $("#showlist_vendorname").html('');
    });
});