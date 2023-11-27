$(document).ready(function() {
    var dataToUpdate = [];
    var overAllQty = 0;
    
    $("#alert-pos").hide();
    $("#alert-pos-stocks").hide();
    $("#purchase").click(function() {
        
        var account_id = $("#acc-id").val();
        var cash_input = parseFloat($('#cash').val());
        var total_input = parseFloat($('#modalPTotal').val());
        var qty;
        var overallTotalVal = parseFloat($('#overallTotal').text());

        if(cash_input >= total_input) {

            $("#tableBody tr").each(function() {
                var sku = $(this).find(".sku").text();
                qty = parseFloat($(this).find(".qty").val());
                var item_name = $(this).find(".item-name").text();
                var itemPrice = $(this).find(".price").text();
                var totalAmount = $(this).find(".totalPrice").text();

                dataToUpdate.push({ sku: sku, item_name: item_name, itmPrice: itemPrice, totalAmount: totalAmount, qty: qty });

                overAllQty += qty;
            });
            $.ajax({
                url: "updateStocks.php", 
                type: "POST",
                data: { dataToUpdate: JSON.stringify(dataToUpdate), overAllQty: overAllQty, overallTotalVal: overallTotalVal, accountid: account_id },
                success: function(response) {
                    overAllQty = 0;
                    var responseTxt = response;
                    console.log(response);
                    
                    if(responseTxt === "false") {
                        $("#paymentModal").modal('hide');
                        $("#alert-pos-stocks").show();

                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                    else if (responseTxt.includes("JUNCATHYR")) {
                        printReceipt(responseTxt);
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
            var subtract = (parseFloat(cash_input) - parseFloat(total_input)).toFixed(2);
            $(".change-pay").val(subtract);
        }
        

    });
    $('.bt-hide').on('click', function () {
        $("#alert-pos").fadeOut();
    });

    $('.bt-hide-stocks').on('click', function () {
        $("#alert-pos-stocks").fadeOut();
    });

    function printReceipt(reciept) {
        var recieptNo = reciept;
        var change = parseFloat($('#change').val()).toFixed(2);
        var cash = parseFloat($('#cash').val()).toFixed(2);
        var userName = $('#user-nm').val();
        var excludeVat = $('#excluded-vat-amount').val();
        var vatAmount = $('#modalPVat').val();
        var overallTotalVal = parseFloat($('#overallTotal').text());
        
        // Create a new HTML page with the receipt content
        var printContent = '<html><head><title>Receipt</title></head><body><br>';
        printContent += '<center><h1>Jun&Cathy Grocery</h1></center>';
        printContent += '<center><h3>Reciept: ' + recieptNo +'</h3></center>';
        
        printContent += '<table style="width: 100%; border-collapse: collapse;">';
        printContent += '<thead>';
        printContent += '<tr>';
        printContent += '<th style="text-align:left; padding: 3px;">Quantity</th>';
        printContent += '<th style="text-align:left; padding: 3px;">Item</th>';
        printContent += '<th style="text-align:left; padding: 3px;">Price</th>';
        printContent += '<th style="text-align:left; padding: 3px;">Total Price</th>';
        printContent += '</tr>';
        printContent += '</thead><br><br>';
        
        printContent += '<tbody>';
        for (var i = 0; i < dataToUpdate.length; i++) {
        printContent += '<tr>';
        printContent += '<td style="text-align:left; padding: 3px;">' + dataToUpdate[i].qty + '</td>';
        printContent += '<td style="text-align:left; padding: 3px;">' + dataToUpdate[i].item_name + '</td>';
        printContent += '<td style="text-align:left; padding: 3px;">' + dataToUpdate[i].itmPrice + '</td>';
        printContent += '<td style="text-align:left; padding: 3px;">' + dataToUpdate[i].totalAmount + '</td>';
        printContent += '</tr>';
    }
    printContent += '</tbody>';
    
    printContent += '</table>';


        printContent += '<div style="margin-top: 80px;">';
        printContent += '<p>Total Price:  ' + overallTotalVal + '</p>';
        printContent += '<p>Tendered Amount: ' + cash + '</p>';
        printContent += '<p>Change:  ' + change +'</p>';
        printContent += '<p>Cashier:  ' +  userName +'</p>';
        printContent += '<hr style="border: 1px solid #bbb; margin-bottom: 50px;">';

        printContent += '<p>Vatable Sale: ' +  excludeVat +'</p>';
        printContent += '<p>VAT(12%): ' + vatAmount +  '</p>';

        printContent += '</body></html>';
        printContent += '</div>';
    
        // Open a new window with the receipt content
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write(printContent);
        printWindow.document.close();
    
        // Print the content
        printWindow.print();
    
        // Close the window after printing
        printWindow.close();
    }
});




