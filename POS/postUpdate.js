$(document).ready(function() {
    var dataToUpdate = [];
    $("#purchase").click(function() {
    
    $("tbody tr").each(function() {
        var sku = $(this).find(".sku").text();
        var qty = parseFloat($(this).find(".qty").val());
        dataToUpdate.push({ sku: sku, qty: qty });
    });
    $.ajax({
        url: "updateStocks.php", 
        type: "POST",
        data: { dataToUpdate: JSON.stringify(dataToUpdate) },
        success: function(response) {
            console.log("Success");
        },
        error: function(error) {
            console.error("Error:", error);
        }
    });
    });

    
});