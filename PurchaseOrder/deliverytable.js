$(document).ready(function () {
    // Function to fetch and append the latest delivery data
    function fetchLatestDeliveryData() {
        $.ajax({
            url: 'fetch_latest_delivery.php', // Replace with the actual URL of your PHP script
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Create a new row for the latest delivery data
                var newRow = '<tr>' +
                    '<td>' + data.Vendor + '</td>' +
                    '<td>' + data.dateOfTransaction + '</td>' +
                    '<td>' + data.expectedDel + '</td>' +
                    '<td>' +
                    '<button title="' + data.item_vendorID + '" class="btn btn-primary btn-sm view-data" data-itemid="' + data.item_vendorID + '" data-bs-toggle="modal" data-bs-target="#viewModal">View Items</button>' +
                    '<a href="delete_po.php?vendorid=' + data.item_vendorID + '" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>' +
                    '</td>' +
                    '</tr>';

                // Append the new row to the table
                $('#delivery-table tbody').append(newRow);
            },
        });
    }

    // Remove the initial call to fetchLatestDeliveryData()
    // It should be called when you want to add new delivery data

    // Example: Call this function when you add new delivery data
    // fetchLatestDeliveryData();
});