// Sa document.ready function, itinatag ang mga event listeners para sa paghahanap.
$(document).ready(function () {
    // I-handle ang pag-browse ng keyup sa input ng paghahanap
    $("#searchForm input[name='search']").on("keyup", function (event) {
        var searchQuery = $(this).val();

        // Gumagamit ng AJAX para kumuha ng mga resulta ng paghahanap mula sa server
        $.ajax({
            url: "search_script.php",
            type: "GET",
            data: { search: searchQuery },
            success: function (response) {
                // I-update ang resulta ng paghahanap sa HTML
                if (response.trim() !== "") {
                    $("#searchResults tbody").html(response);

                    // I-handle ang click event para sa mga resulta ng paghahanap
                    $(".search-result").on("click", function () {
                        // Kumuha ng mga detalye ng item mula sa resulta ng paghahanap
                        var sku = $(this).data("sku");
                        var itemName = $(this).find("td:eq(1)").text();
                        var category = $(this).find("td:eq(2)").text();
                        var stocks = $(this).find("td:eq(3)").text();
                        var price = $(this).find("td:eq(4)").text();
                        var barcode = $(this).data("barcode");

                        $("#tableBody th:contains('SKU')").text(sku);

                         var existingRow = $("#tableBody").find("tr:contains('" + sku + "')");
    if (existingRow.length === 0) {
        addToDisplayTable(sku, itemName, category, stocks, price, barcode);
    } else {
        var existingQtyInput = existingRow.find(".qty");
        var quantity = parseInt(existingQtyInput.val()) * 2; // Double the quantity
        existingQtyInput.val(quantity);

        var totalPriceElement = existingRow.find('.totalPrice');
        var priceValue = parseFloat(price);
        if (!isNaN(priceValue) && !isNaN(quantity)) {
            var totalPrice = quantity * priceValue;
            totalPriceElement.text(totalPrice.toFixed(2));
            updateOverallTotal(); // Update overall total when quantity changes
        }
    }

    $("#searchModal").modal("hide");
});
                } else {
                    $("#searchResults tbody").html('<tr><td colspan="5">Walang Natagpuang Item</td></tr>');
                }
            }
        });
    });

    // I-handle ang "Enter" key press event sa labas ng keyup event listener
    $("#searchForm input[name='search']").on("keydown", function (event) {
        if (event.which === 13) {
            event.preventDefault();
            $(".search-result:first").click();
        }
    });
});

// Function para idagdag ang napiling item sa display table
function addToDisplayTable(sku, itemName, category, stocks, price, barcode) {
    // Assumed na may paraan kang nakuha ang quantity (halimbawa, gamit ang isang input field)
    var quantity = 1; // Quantity default sa 1

    // Kalkulahin ang total amount
    var totalAmount = quantity * parseFloat(price);

    // Maaaring i-modify ang function na ito base sa iyong display table structure
    var tableRow = '<tr>';
    tableRow += '<td><input class="form-control adjustments qty" type="number" value="' + quantity + '"></td>';
    tableRow += '<td class="sku">' + barcode + '</td>'; // Update SKU column with barcode value
    tableRow += '<td class="item-name">' + itemName + '</td>';
    tableRow += '<td class="price">' + price + '</td>';
    tableRow += '<td class="totalPrice">' + totalAmount + '</td>';
    tableRow += '<td><button class="btn btn-primary btn-sm btn-danger del-row"><i class="fas fa-trash"></i></button></td>';
    tableRow += '</tr>';

    // Ilagay ang bagong row sa display table
    $("#tableBody").append(tableRow);

    // Update barcode in the main table header
    $("#tableBody th:contains('SKU')").text(barcode);

    // I-update ang overall total
    updateOverallTotal();
}
// Function para i-update ang overall total amount
function updateOverallTotal() {
    var totalAmount = 0;
    $('.totalPrice').each(function () {
        var totalPriceText = $(this).text();
        var totalPriceValue = parseFloat(totalPriceText);
        if (!isNaN(totalPriceValue)) {
            totalAmount += totalPriceValue;
        }
    });
    $("#overallTotal").text(totalAmount.toFixed(2));
}

// Handle input change event for quantity inside the table
$(document).on('input', '#tableBody .qty', function () {
    var quantity = parseInt($(this).val());
    var priceText = $(this).closest('tr').find('.price').text();
    var priceValue = parseFloat(priceText);
    var totalPriceElement = $(this).closest('tr').find('.totalPrice');

    if (!isNaN(quantity) && !isNaN(priceValue)) {
        var totalPrice = quantity * priceValue;
        totalPriceElement.text(totalPrice.toFixed(2));
        updateOverallTotal(); // Update overall total when quantity changes
    }
});

// Handle click event for deleting a row
$(document).on('click', '.del-row', function () {
    var row = $(this).closest('tr');
    row.remove();
    updateOverallTotal();
});

// Handle click event for clearing all rows
$("#F3Button").on('click', function () {
    $("#tableBody").empty();
    updateOverallTotal();
});

// Handle keydown event for F3 key
$(document).on('keydown', function (e) {
    if (e.which === 114 || e.which === 113) { // F3 key codes
        $("#tableBody").empty();
        updateOverallTotal();
        location.reload();
    }
});
