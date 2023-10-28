$(document).ready(function () {
    $('#addInput').click(function(e) {
        e.preventDefault();
        $(".show_items").prepend(
        `<tr class="appended_items">
        <!--Table Content-->
        <th><input type="text" class="form-control" id="generateRandom" name="PO_sku[]" required></th>
        <th><input type="text" class="form-control" name="PO_itemname[]" required></th>
        <th><input type="number" class="form-control adjustments" name="PO_qty[]" required></th>
        <th>            
        <select class="form-select uom-dropdown" name="PO_uom[]">

        </select></th>
        <th>            
        <select class="form-select category-dropdown" name="PO_category[]">

            <!-- Many Brands -->
        </select></th>
        <th><input type="number" class="form-control" name="PO_price[]" required></th>
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

    var sku = generateRandomSku();
    console.log(sku);
    $("#generateRandom").val(sku);

    });

    $(document).on('click', '.removeInput', function(e) {
        e.preventDefault();

        let rowItem = $(this).parent().parent();
        $(rowItem).remove();
    });

    //auto focus the first input

    $(document).on("click", "#order-btn",function (e) { 
        $("#purchase1").on('shown.bs.modal', function() {
            $("#vendorID").focus();
            var sku = generateRandomSku();
            console.log(sku);
            $("#generateRandom").val(sku);
        })
    });

    // clear the text on the modal
    $(document).on('click', '#cls' ,function(e) {
        e.preventDefault();
        $("#purchase1").modal('hide');
        $('#vendorID').val(" ");
        $('#vendorNAME').val(" ");
        $('#dateTransaction').val(" ");
        $('#expectedDelivery').val(" ");
        $(".appended_items").remove();
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
                console.log(response);
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

function generateRandomSku() {
    var currentDate = new Date();
    var year = currentDate.getFullYear().toString().substr(-2); // Get the last two digits of the year
    var month = (currentDate.getMonth() + 1).toString().padStart(2, "0"); // Ensure two-digit month
    var day = currentDate.getDate().toString().padStart(2, "0"); // Ensure two-digit day

    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; // You can add more characters if needed
    var randomLetters = "";

    for (var i = 0; i < 3; i++) {
        randomLetters += characters.charAt(Math.floor(Math.random() * characters.length));
    }

    var sku = year + month + day + randomLetters;

    return sku;
}