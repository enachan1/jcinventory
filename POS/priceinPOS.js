
            //priceinquiry
            $(document).ready(function () {
                // Handle input event on the priceinquiry form
                $("#priceForm input[name='price']").on("input", function () {
                    var searchQuery = $(this).val();

                    // Make an AJAX request to fetch price results
                    $.ajax({
                        url: "price_inquiry.php",
                        type: "GET",
                        data: { price: searchQuery },
                        dataType: "json",
                        success: function (response) {
                            var data = response.data;
                            if (data.length > 0) {
                                var price = data[0].item_price;
                                $("#priceDisplay").text(price);

                                // Remove the "Price" column from the table
                                var modifiedData = data.map(function (item) {
                                    return {
                                        item_sku: item.item_sku,
                                        item_name: item.item_name,
                                        item_category: item.item_category,
                                        item_barcode: item.item_barcode,
                                    };
                                });

                                // Update content in the table body
                                var tableBody = $("#priceResults tbody");
                                tableBody.empty(); // Clear existing content

                                $.each(modifiedData, function (index, item) {
                                    var row = $("<tr>");
                                    row.append($("<td>").text(item.item_barcode));
                                    row.append($("<td>").text(item.item_name));
                                    row.append($("<td>").text(item.item_category));
                                    tableBody.append(row);
                                });
                            } else {
                                $("#priceDisplay").text("Wala pa ang price nito");
                                $("#priceResults tbody").empty(); // Clear table body
                            }
                        }
                    });
                });
            });
