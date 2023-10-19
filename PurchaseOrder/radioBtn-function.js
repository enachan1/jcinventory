$(document).ready(function () {
    $(document).on('change', '.delivered-rbtn',  function () {
        const vendorDataId = $(this).data('itemid');
        console.log(vendorDataId);
    });

    $(document).on('change', '.badorder-rbtn',  function () {
        const vendorDataId = $(this).data('itemid');
        console.log(vendorDataId);
    });

    
});