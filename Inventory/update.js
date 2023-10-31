$(document).ready(function() {
    $('.editbtn').on('click', function() {
        $('#editModal').modal('show');

        $tablerow = $(this).closest('tr')

        var data = $tablerow.children('td').map(function() {
            return $(this).text();
        }).get();

        console.log(data);


        $('#update_id').val(data[0]);
        $('#sku').val(data[1]);
        $('#barcode').val(data[2]);
        $('#itemname').val(data[3]);
        $('#stocks').val(data[4]);
        $('#expdate').val(data[5]);
        $('#price').val(data[6]);
        $('#category').val(data[7]);

    });
});