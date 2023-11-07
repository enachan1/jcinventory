$(document).ready(function () {
    var mark_up = $('#mark-up').val();
    //console.log(mark_up);
    var markup_decimal = mark_up / 100;
    //console.log(markup_decimal);
    

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
});