$(document).ready(function () {
    var markup = 0;
    var markup_decimal = 0;
    
    // for adding items
    $('#mark-up').keyup(function (e) { 
        var markup = $('#mark-up').val();
        markup_decimal = markup / 100;
        console.log(markup_decimal);
    });
    

    $('#cpriceInput').keyup(function() {
        var cost_price = $(this).val();
        var total_items = parseFloat($(this).val());

        if(!isNaN(cost_price) && !isNaN(total_items)) {
        var MAI = (cost_price * markup_decimal).toFixed(2);
        var price = (parseFloat(cost_price) + parseFloat(MAI)).toFixed(2);

        $("#priceInput").val(price);
        }
        else {
            $("#priceInput").val(0);
        }
    });


    $('#edt-mark-up').keyup(function (e) { 
        markup = $('#edt-mark-up').val();
        markup_decimal = markup / 100;
    });


    $('#edt-cpriceInput').keyup(function() {
        var cost_price = $(this).val();
        var total_items = parseFloat($(this).val());

        if(!isNaN(cost_price) && !isNaN(total_items)) {
        var MAI = (cost_price * markup_decimal).toFixed(2);
        var price = (parseFloat(cost_price) + parseFloat(MAI)).toFixed(2);

        $("#upriceInput").val(price);
        }
        else {
            $("#upriceInput").val(0);
        }
    });
});