$(document).ready(function() {


    $('.edit-vendor-btn').on('click', function() {
        $('#edit-vendor').modal('show');

        $tablerow = $(this).closest('tr')

        var data = $tablerow.children('td').map(function() {
            return $(this).text();
        }).get();


        $('#update-vendor-id').val(data[0]);
        $('#update-vendor-name').val(data[1]);
        $('#update-vendor-contact').val(data[2]);

    });
});