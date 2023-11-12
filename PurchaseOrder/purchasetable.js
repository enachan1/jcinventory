$(document).ready(function () {
    // Function to fetch and append the latest purchase data
    function fetchLatestPurchaseData() {
        $.ajax({
            url: 'fetch_latest_purchase.php', // Replace with the actual URL of your PHP script
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Create a new row for the latest purchase data
                var newRow = '<tr>' +
                    '<td>' + data.Vendor + '</td>' +
                    '<td>' + data.dateOfTransaction + '</td>' +
                    '<td>' + data.expectedDel + '</td>' +
                    '<td>' +
                    '<button title="' + data.item_vendorID + '" class="btn btn-primary btn-sm view-data" data-itemid="' + data.item_vendorID + '" data-bs-toggle="modal" data-bs-target="#viewModal">View Items</button>' +
                    '</td>' +
                    '<td>' +
                    '<button class="btn btn-primary btn-sm delivered-rbtn" id="delivered_label" value="Delivered" name="dob_' + data.item_vendorID + '" data-itemid="' + data.item_vendorID + '">Delivered</button>' +
                    '</td>' +
                    '</tr>';

                // Append the new row to the table
                $('#data-table tbody').append(newRow);
            },
        });
    }

    // Call the function to fetch and append the latest purchase data on page load
    fetchLatestPurchaseData();
});