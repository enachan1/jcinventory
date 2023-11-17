$(document).ready(function () {
    var submitButton = $('#submitButton');
    submitButton.prop('disabled', true);

    $(document).on('input', '#barcodeInput', function () {
        var numberInput = $(this).val();

        // Check if the input is a number and not empty
        if (!isNaN(numberInput) && numberInput !== "" && numberInput.trim() !== "") {
            submitButton.prop('disabled', false);
        } else {
            submitButton.prop('disabled', true);
        }
    });

    $(document).on("click", submitButton, function (e) {  
        $("#showlist_skuitems").html('');
    });

    //fetch items from auto complete

    $('#barcodeInput').keyup(function (e) { 
        e.preventDefault();
        var skuinput_text = $(this).val();

        console.log(skuinput_text);
        if(skuinput_text != '') {
            $.ajax({
                url: "fetch-autocomplete.php",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({ query: skuinput_text }),
                success: function (response) {
                    $("#showlist_skuitems").html(response);
                }
            });
        } else {
            $("#showlist_skuitems").html('');
        }
    });



    //for class clickers
    $(document).on('click', '.clickers', function(e) {
        $('#barcodeInput').val("");
        var get_itemsku = $(this).data('itemsku');
        $('#barcodeInput').val(get_itemsku);


        //activating button
        submitButton.prop('disabled', false);

        //clicking automatically
        submitButton.click();

        //closing autocomplete
        $("#showlist_skuitems").html('');

        //focusing input
        $('#barcodeInput').focus();
    });
});