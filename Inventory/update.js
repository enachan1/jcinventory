$(document).ready(function() {
    $('.editbtn').on('click', function() {
        $('#editModal').modal('show');

        $tablerow = $(this).closest('tr')

        var data = $tablerow.children('td').map(function() {
            return $(this).text();
        }).get();


        $('#update_id').val(data[0]);
        $('#sku').val(data[1]);
        $('#barcode').val(data[2]);
        $('#itemname').val(data[3]);
        $('#stocks').val(data[4]);
        $('#expdate').val(data[5]);
        $('#upriceInput').val(data[6]);
        $('#category').val(data[7]);
        $('#e-sales').val(data[8]);
        $('#e-stable').val(data[9]);
        $('#e-average').val(data[10]);
        $('#e-reorder').val(data[11]);
        $('#e-critical').val(data[12]);

    });

    $(document).on("click", "#edit-close-btn", function(e) {
        $("#edt-cpriceInput").val("");
        $("#edt-mark-up").val("");
    })
});