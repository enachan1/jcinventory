$(document).ready(function() {
    var dataToInsert = [];
    $("#purchase").click(function() {
    
    $("tbody tr").each(function() {
        var sku = $(this).find(".sku").text();
        var qty = parseFloat($(this).find(".qty").val());
        dataToInsert.push({ sku: sku, qty: qty });
    });
    $.ajax({
        url: "updateStocks.php", 
        type: "POST",
        data: { dataToUpdate: JSON.stringify(dataToInsert) },
        success: function(response) {
            location.reload();
        },
        error: function(error) {
            console.error("Error:", error);
        }
    });
    });

    
});
