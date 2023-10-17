$(document).ready(function () {
    $('#addInput').click(function(e) {
        e.preventDefault();
        $(".show_items").prepend(
        `<tr>
        <!--Table Content-->
        <th><input type="text" class="form-control" name="PO_itemname[]" required></th>
        <th><input type="number" class="form-control adjustments" name="PO_qty[]" required></th>
        <th>            
        <select class="form-select uom-dropdown" name="PO_uom[]">

        </select></th>
        <th>            
        <select class="form-select category-dropdown" name="PO_category[]">

            <!-- Many Brands -->
        </select></th>
        <!--Added Input -->
        <td><button class="btn btn-primary btn-sm btn-danger removeInput" type="button"><i class="fa fa-minus-circle"></i>
        </tr>`
    );

    // Populate UOM dropdown
    const uofDropdown = $('.uom-dropdown').first();
    fetchDropdownOptions(uofDropdown, 'uom');

    // Populate Category dropdown
    const categoryDropdown = $('.category-dropdown').first();
    fetchDropdownOptions(categoryDropdown, 'category');
    });

    $(document).on('click', '.removeInput', function(e) {
        e.preventDefault();

        let rowItem = $(this).parent().parent();
        $(rowItem).remove();
    });

    $("#formList").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "addPurchaseOrder.php",
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                $("#purchase1").modal('hide');
                $(".appended_items").remove();
                updateTableContent();
                location.reload();
            }
        });
    });


});



function fetchDropdownOptions(dropdown, type) {
    $.ajax({
        url: 'populate.php?type=' + type,
        type: 'GET',
        success: function (data) {
            dropdown.empty();
            data.forEach(function (option) {
                dropdown.append('<option value="' + option.label + '">' + option.label + '</option>');
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}


function updateTableContent() {
    $.ajax({
        url: 'refreshTable.php', // Replace with the actual URL of your refreshTable.php file
        type: 'GET',
        success: function (data) {
            $('.show_items').html(data);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}