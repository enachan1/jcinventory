            //search
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
                                        var sku = $(this).find("td:eq(0)").text();
                                        var itemName = $(this).find("td:eq(1)").text();
                                        var category = $(this).find("td:eq(2)").text();
                                        var stocks = $(this).find("td:eq(3)").text();
                                        var price = $(this).find("td:eq(4)").text();
    
                                        // Check kung ang item ay nasa display table na
                                        var existingRow = $("#tableBody").find("tr:contains('" + sku + "')");
                                            if (existingRow.length > 0) {
                                                // Kung nasa display table na, i-update ang quantity at total amount
                                                var existingQtyInput = existingRow.find(".qty");
                                                var quantity = parseInt(existingQtyInput.val()) + 1;
                                                existingQtyInput.val(quantity);
    
                                                var priceValue = parseFloat(price);
                                                if (!isNaN(priceValue)) {
                                                    totalAmount += priceValue;
                                                }
                                                updateOverallTotal();
                                            } else {
                                                // Kung hindi pa nasa display table, idagdag ang item
                                                addToDisplayTable(sku, itemName, category, stocks, price);
                                            }
    
                                            // Isara ang modal para sa paghahanap (kung kinakailangan)
                                            $("#searchModal").modal("hide");
                                        });
                                    } else {
                                        // Kung wala kang natagpuang item, ipakita ang mensahe
                                        $("#searchResults tbody").html('<tr><td colspan="5">Walang Natagpuang Item</td></tr>');
                                    }
                                }
                            });
                        });
    
                        // I-handle ang "Enter" key press event sa labas ng keyup event listener
                        $("#searchForm input[name='search']").on("keydown", function (event) {
                            if (event.which === 13) {
                                // Pigilan ang default na behavior ng form submission
                                event.preventDefault();
    
                                // Simulahan ang click sa unang resulta ng paghahanap
                                $(".search-result:first").click();
                            }
                        });
                    });
    
                    // Function para idagdag ang napiling item sa display table
                    function addToDisplayTable(sku, itemName, category, stocks, price) {
                        // Assumed na may paraan kang nakuha ang quantity (halimbawa, gamit ang isang input field)
                        var quantity = 1; // Quantity default sa 1
    
                        // Kalkulahin ang total amount
                        var totalAmount = quantity * parseFloat(price);
    
                        // Maaaring i-modify ang function na ito base sa iyong display table structure
                        var tableRow = '<tr>';
                        tableRow += '<td><input class="form-control adjustments qty" type="number" value="' + quantity + '"></td>';
                        tableRow += '<td class="sku">' + sku + '</td>';
                        tableRow += '<td class="item-name">' + itemName + '</td>';
                        tableRow += '<td class="price">' + price + '</td>';
                        tableRow += '<td class="totalPrice">' + totalAmount + '</td>';
                        tableRow += '<td><button class="btn btn-primary btn-sm btn-danger del-row"><i class="fas fa-trash"></i></button></td>';
                        tableRow += '</tr>';
    
                        // Ilagay ang bagong row sa display table
                        $("#tableBody").append(tableRow);
    
                        // I-update ang overall total
                        updateOverallTotal();
                    }
    
                    // I-handle ang event kapag may input change sa quantity field
                    $(document).on('input', '.qty', function () {
                        var quantity = parseInt($(this).val());
                        var priceText = $(this).closest('tr').find('.price').text();
                        var priceValue = parseFloat(priceText);
                        var totalPrice = quantity * priceValue;
                        var totalPriceElement = $(this).closest('tr').find('.totalPrice');
                        if (!isNaN(totalPrice)) {
                            totalPriceElement.text(totalPrice.toFixed(2));
                        } else {
                            totalPriceElement.text('0.00');
                        }
    
                        // I-update ang overall total incrementally kapag nagbago ang quantity
                        if (!isNaN(priceValue) && !isNaN(totalPrice)) {
                            updateOverallTotal();
                        }
                    });
    
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
    
                    // Kalkulahin ang initial overall total
                    updateOverallTotal();
    
                    // I-handle ang click event kapag binubura ang isang row
                    $(document).on('click', '.del-row', function () {
                        console.log("clicked");
                        var row = $(this).closest('tr');
                        rowRemove(row);
                        $("#barcodeInput").focus();
                    });
    
                    // Function para i-remove ang isang row
                    function rowRemove(row) {
                        row.remove();
                        updateOverallTotal();
                    }
    
                    // I-handle ang event kapag pindot ang F3 button
                    $("#F3Button").on('click', function () {
                        // Alisin ang lahat ng rows sa table
                        $("#tableBody").empty();
                        updateOverallTotal();
                    });
    
                    // I-handle ang event kapag pindot ang F3 key
                    $(document).on('keydown', function (e) {
                        if (e.which === 114 || e.which === 113) { // F3 key codes
                            // Alisin ang lahat ng rows sa table
                            $("#tableBody").empty();
                            updateOverallTotal();
                        }
                    });