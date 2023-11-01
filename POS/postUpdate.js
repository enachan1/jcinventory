$(document).ready(function() {
    var dataToUpdate = [];
    var overAllQty = 0;
    $("#alert-pos").hide();
    $("#alert-pos-stocks").hide();
    $("#purchase").click(function() {
        
        var cash_input = parseFloat($('#cash').val());
        var total_input = parseFloat($('#modalPTotal').val());
        var qty;
        var overallTotalVal = parseFloat($('#overallTotal').text());

        if(cash_input >= total_input) {

            $("#tableBody tr").each(function() {
                var sku = $(this).find(".sku").text();
                qty = parseFloat($(this).find(".qty").val());
                var item_name = $(this).find(".item-name").text();
                var totalAmount = $(this).find(".totalPrice").text();

                dataToUpdate.push({ sku: sku, item_name: item_name, totalAmount: totalAmount, qty: qty });

                overAllQty += qty;
            });
            $.ajax({
                url: "updateStocks.php", 
                type: "POST",
                data: { dataToUpdate: JSON.stringify(dataToUpdate), overAllQty: overAllQty, overallTotalVal: overallTotalVal },
                success: function(response) {
                    overAllQty = 0;
                    console.log(response);
                    
                    if(response === "false") {
                        console.log("tanga");
                        $("#paymentModal").modal('hide');
                        $("#alert-pos-stocks").show();

                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                    else {
                        location.reload();
                    }
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }
        else {
            $("#alert-pos").show();
        }

    });

    $(document).on('keyup', '#cash' ,function (e) { 
        console.log("keyup working")
        var cash_input = parseFloat($('#cash').val());
        var total_input = parseFloat($('#modalPTotal').val());

        if (isNaN(cash_input) || cash_input < total_input) {
            $(".change-pay").val(0);
        } else {
            var subtract = cash_input - total_input;
            $(".change-pay").val(subtract);
        }
        

    });
    $('.bt-hide').on('click', function () {
        $("#alert-pos").fadeOut();
    });

    $('.bt-hide-stocks').on('click', function () {
        $("#alert-pos-stocks").fadeOut();
    });
});
