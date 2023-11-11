$(document).ready(function () {
    var totalAmount = 0;

    // Function to update the overall total amount
    function updateOverallTotal() {
        totalAmount = 0;
        $('.totalPrice').each(function () {
            var totalPriceText = $(this).text();
            var totalPriceValue = parseFloat(totalPriceText);
            if (!isNaN(totalPriceValue)) {
                totalAmount += totalPriceValue;
            }
        });
        var totalWithVAT = parseFloat(totalAmount * 0.12).toFixed(2);
        var totalIncludingVAT = totalAmount + parseFloat(totalWithVAT);

        $("#modalPVat").val(totalWithVAT);
        $("#overallTotal").text(totalAmount.toFixed(2));
        $("#modalPTotal").val(totalIncludingVAT.toFixed(2));
    }


    function rowRemove(row) {
        row.remove();
        updateOverallTotal();
    }

    $("#purchaseForm").submit(function (e) {
        e.preventDefault();
        var sku = $("#barcodeInput").val();
        var quantity = 1;
        var addNewRow = true;

        $(".sku").each(function () {
            if ($(this).text() === sku) {
                var existingRow = $(this).closest("tr");
                var existingQtyInput = existingRow.find(".qty");
                quantity = parseInt(existingQtyInput.val()) + 1;
                existingQtyInput.val(quantity);

                var price = parseFloat(existingRow.find(".price").text());
                var totalPrice = quantity * price;
                existingRow.find(".totalPrice").text(totalPrice);
                $("#barcodeInput").val("");

                // Update the total amount incrementally when quantity changes
                var priceValue = parseFloat(price);
                if (!isNaN(priceValue)) {
                    totalAmount += priceValue;
                }
                updateOverallTotal();

                addNewRow = false;
                return false;
            }
        });

        if (addNewRow) {
            $.ajax({
                url: "purchaseinsert.php",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    $("#tableBody").prepend(response);
                    $("#barcodeInput").val("");
                    updateOverallTotal();
                }
            });
        }
    });

    $(document).on('input', '.qty', function () {
        var quantity = parseInt($(this).val());
        var priceText = $(this).closest('tr').find('.price').text();
        var priceValue = parseFloat(priceText);
        var totalPrice = quantity * priceValue;
        var totalPriceElement = $(this).closest('tr').find('.totalPrice');
        if (!isNaN(totalPrice)) {
            totalPriceElement.text(totalPrice.toFixed(2));
        } else {
            totalPriceElement.text('0');
        }

        // Update the total amount incrementally when quantity changes
        if (!isNaN(priceValue) && !isNaN(totalPrice)) {
            totalAmount = 0;
            $('.totalPrice').each(function () {
                var totalPriceText = $(this).text();
                var totalPriceValue = parseFloat(totalPriceText);
                if (!isNaN(totalPriceValue)) {
                    totalAmount += totalPriceValue;
                }
            });
            updateOverallTotal();
        }
    });

    // Calculate the initial overall total
    updateOverallTotal();

    $(document).on('click', '.del-row', function () {
        console.log("clicked");
        var row = $(this).closest('tr');
        rowRemove(row);
        $("#barcodeInput").focus();
    });
});
