$(document).ready(function () {
    $(document).on('click', '.view-data', function () {
        const vendorItemID = $(this).data('itemid');

       $.ajax({
        method: "POST",
        url: "fetch-data-from-vendor.php",
        data: {vendorID: vendorItemID},
        dataType: "json",
        success: function (response) {
            populateModal(response);
        }
       });
    });

    // Clear the table body when the modal is hidden
    $('#viewModal').on('hidden.bs.modal', function (e) {
        $('#itemTable tbody').empty();
        $('#dispVendorName, #currentDate #expectedDate').text("");
    });

});

function populateModal(data) {
    $('#itemTable tbody').empty();

    $('#po-total-price').text("₱ " + parseFloat(data.total));

    data.items.forEach(function(item) {
        $('#dispVendorName').text(item.Vendor);
        $('#currentDate').text(item.transaction_date);
        $('#expectedDate').text(item.exp_del_date);

        $('#itemTable tbody').append(
            `<tr>
                <td>${item.itemSku}</td>
                <td>${item.item_name}</td>
                <td>${item.qty}</td>
                <td>${item.uom}</td>
                <td>${item.category}</td>
                <td>${item.price}</td>
            </tr>`
        );
    });

    // Show the modal
    $('#viewModal').modal('show');
}
