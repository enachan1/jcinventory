$(document).ready(function () {

    //iterate if there is delivered item in po's
    loadIterate();
    badorder_iterate();
    

    //for radio button delivered
    $(document).on('click','.delivered-rbtn', function () {
        const vendorDataId = $(this).data('itemid');
        
        console.log(vendorDataId);
        $('#confirmation_modal').modal('show');
        const delivered_label_text = $('#delivered_label').html();
        $('#confirmation_modal span').html(delivered_label_text);
        
        $('#confirmation_yes').off('click').on('click', function (e) { 
            e.preventDefault();
            
            $.ajax({
                method: "GET",
                url: "update-to-delivered.php?vdid="+vendorDataId,
                success: function (response) {
                    location.reload();
                    $('#confirmation_modal').modal('hide');
             }
            });
        });

        $('#confirmation_no').off('click').on('click', function (e) { 
            e.preventDefault();
            $('#confirmation_modal').modal('hide');
        });


    });
    // for radio button bad order
    $(document).on('click', '.badorder-rbtn',  function () {
        const vendorDataId = $(this).data('itemid');
        const badorder_label_text = $('#badorder_label').html();
        $('#confirmation_modal').modal('show');
        $('#confirmation_modal span').html(badorder_label_text);
        console.log(vendorDataId);



        //actions for modal buttons

        $('#confirmation_yes').off('click').on('click', function (e) { 
            e.preventDefault();
            $('#confirmation_yes').click(function (e) { 
                e.preventDefault();
                
                $.ajax({
                    method: "GET",
                    url: "update-to-badorder.php?vdid="+vendorDataId,
                    success: function (response) {
                        location.reload();
                        $('#confirmation_modal').modal('hide');
                 }
                });
            });
            
        });

        $('#confirmation_no').off('click').on('click', function (e) { 
            e.preventDefault();
            $('#confirmation_modal').modal('hide');
        });
    });


    //disable esc in keyboard for modal
    $('#confirmation_modal').modal({
        keyboard: false,
    });

});


function loadIterate() {

    $('.delivered-rbtn').each(function () {
        const deliveredRbtn = $(this);
        const vendorDataId = deliveredRbtn.data('itemid');
        const row = deliveredRbtn.closest('tr');

        // Fetch the is_delivered value via AJAX
        $.ajax({
            method: "GET",
            url: "get-delivered-status.php?vdid=" + vendorDataId,
            success: function (response) {
                // Update the radio button based on the fetched value
                if (response === '1') {
                    row.addClass('bg-success text-white');
                }
            }
        });
    });


    

}
function badorder_iterate() {
    $('.badorder-rbtn').each(function () {
        const deliveredRbtn = $(this);
        const vendorDataId = deliveredRbtn.data('itemid');
        const row = deliveredRbtn.closest('tr');

        // Fetch the is_delivered value via AJAX
        $.ajax({
            method: "GET",
            url: "get-badorder-status.php?vdid=" + vendorDataId,
            success: function (response) {
                // Update the radio button based on the fetched value
                if (response === '1') {
                    row.addClass('bg-secondary text-white');
                }
            }
        });
    });
}