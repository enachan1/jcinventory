$(document).ready(function () {
    const delivered = $('#delivered');
    const badorder = $('#bad_order');

    delivered.on('change', function () {
        if (delivered.prop('checked')) {
            const vendorItemID = $(this).data('itemid');
            console.log(vendorItemID);
        }
    });

    badorder.on('change', function () {
        if (badorder.prop('checked')) {
            const vendorItemID = $(this).data('itemid');
            console.log(vendorItemID);
        }
    });
});