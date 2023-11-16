$(document).ready(function () {
    


    $(document).on("click", "#editPObtn", function(e) { 
        var edit_data = $(this).data('vendoridtbl');
        console.log(edit_data)

        $.ajax({
            method: "POST",
            url: "fetch-data-from-vendor.php",
            data: {vendorID: edit_data},
            dataType: "json",
            success: function (response) {
                console.log(response);
                populateModal(response);
            }
           });

        });
        //populate items from the table
        function populateModal(data) {
            $('#edt-tbl-itm').empty();
        
            data.items.forEach(function(item) {
                $('#evendorID').val(item.venddID);
                $('#evendorNAME').val(item.Vendor);
                $('#edateTransaction').val(item.transaction_date);
                $('#eexpectedDelivery').val(item.exp_del_date);
        
                $('#edt-tbl-itm').append(
                    `<tr class="update-appended">
                        <td><input type="text" id="generateRandom" value="${item.itemSku}" class="form-control" name="ePO_sku[]" required></td>
                        <td><input type="text" class="form-control" value="${item.item_name}" name="ePO_itemname[]" required></td>
                        <td><input type="number" class="form-control adjustments" value="${item.qty}" name="ePO_qty[]" required></td>
                        <td>
                            <select class="form-select euom-dropdown" value="${item.uom}" name="ePO_uom[]">

                            </select>
                        </td>
                        <td>
                            <select class="form-select ecategory-dropdown" name="ePO_category[]">

                            </select>
                        </td>
                        <td><input type="number" class="form-control" value="${item.price}" name="ePO_price[]" step=".01" required></td>
                    </tr>`
                );
                // Populate UOM dropdown
                const uofDropdown = $('#edt-tbl-itm tr:last-child .euom-dropdown').first();
                fetchDropdownOptions(uofDropdown, 'uom', item.uom);

                // Populate Category dropdown
                const categoryDropdown = $('#edt-tbl-itm tr:last-child .ecategory-dropdown').first();
                fetchDropdownOptions(categoryDropdown, 'category', item.category);
            });

        }

        //responsible for populating and selecting uom and category dropdowns
        function fetchDropdownOptions(dropdown, type, selectedValue) {
            $.ajax({
                url: 'populate.php?type=' + type,
                type: 'GET',
                success: function (data) {
                    dropdown.empty();
                    data.forEach(function (option) {
                        const optionElement = $('<option>', { value: option.label, text: option.label });
        
                        if (option.label === selectedValue) {
                            optionElement.prop('selected', true);
                        }
        
                        dropdown.append(optionElement);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }


        $("#edit-po").submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "updatePurchaseOrder.php",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    // $("#purchase1").modal('hide');
                    // $(".appended_items").remove();
                    console.log(response);
                    // updateTableContent();
                    // location.reload();
                }
            });
        });
    });
