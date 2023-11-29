$(document).ready(function () {

    $('#itemnameInput').keyup(function (e) { 
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


    $(document).on('click', '.clickers', function(e) {
        var get_itemsku = $(this).data('itemsku');
        $('#skuInput').val(get_itemsku);

        $.ajax({
            url: "fetch-items.php",
                method: "POST",
                data: { v_id: get_itemsku },
                success: function (response) {
                    console.log(response);
                    fetch_data_from_input(response);
                }
            });
        

        $("#showlist_skuitems").html('');
        $('#cpriceInput').prop("disabled", false);
        $('#priceInput').prop("disabled", false);
        $('#generate').prop("disabled", true);
    });


    //clearing the modal inputs when clicked

    $(document).on('click', '#closeBtn', function (e) {
        e.preventDefault();
        $('#skuInput').val("");
        $('#barcodeInput').val("");
        $('#stocksInput').val("");
        $('#expdateInput').val("");
        $('#itemnameInput').val("");
        $("#showlist_skuitems").html('');
        $('#generate').prop("disabled", false);

    });

    //generate sku
    $(document).on('click', "#generate", function (e) {
        e.preventDefault();
        var generate_sku = generateRandomSku();
        $('#skuInput').val(generate_sku);
    });
});


function fetch_data_from_input(data) {
    if (data && Array.isArray(data.itemdesc)) {
        data.itemdesc.forEach(function (item) {
            $('#itemnameInput').val(item.po_item_name);
            $('#add_category').val(item.po_category);
        });
    } else {
        console.error("Data or data.itemdesc is not defined or not an array.");
    }
}

function generateRandomSku() {
    var currentDate = new Date();
    var year = currentDate.getFullYear().toString().substr(-2); // Get the last two digits of the year
    var month = (currentDate.getMonth() + 1).toString().padStart(2, "0"); // Ensure two-digit month
    var day = currentDate.getDate().toString().padStart(2, "0"); // Ensure two-digit day

    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; // You can add more characters if needed
    var randomLetters = "";

    for (var i = 0; i < 3; i++) {
        randomLetters += characters.charAt(Math.floor(Math.random() * characters.length));
    }

    var sku = year + month + day + randomLetters;

    return sku;
}