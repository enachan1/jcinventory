$(document).ready(function () {
    var mark_up = $('#mark-up').val();
    var markup_decimal = mark_up / 100;
    

    $('#stocksInput').keyup(function() {
        var cost_price = $('#cpriceInput').val();
        var total_items = parseFloat($(this).val());

        if(!isNaN(cost_price) && !isNaN(total_items)) {
        var cost_price_per_item = (cost_price / total_items).toFixed(2);
        var MAI = (cost_price_per_item * markup_decimal).toFixed(2);
        var price = (parseFloat(cost_price_per_item) + parseFloat(MAI)).toFixed(2);

        $("#priceInput").val(price);
        }
        else {
            $("#priceInput").val(0);
        }


    });
});