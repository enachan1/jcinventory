$(document).ready(function () {
   $(document).on("click", ".view-data", function () {
        const reciept_no = $(this).data('itemrec');
        // console.log(reciept_no);


        $.ajax({
            method: "POST",
            url: "fetch-data-transactions.php",
            data: {recieptData: reciept_no},
            dataType: "json",
            success: function (response) {
                // console.log(response);
                populateModal(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
           });
        });
    
        // Clear the table body when the modal is hidden
        $('#viewItems').on('hidden.bs.modal', function (e) {
            $('#itemTable tbody').empty();
            $('#disp-reciept, #transDate').text("");
        });

});

function populateModal(data) {
    $('#itemTable tbody').empty();

    $('#transTot').text(data.Overall);
    
    data.items.forEach(function(item) {
        $('#disp-reciept').text(item.reciept_num);
        $('#transDate').text(item.t_date);

        $('#itemTable tbody').append(
            `<tr>
                <td>${item.Barcode}</td>
                <td>${item.itemName}</td>
                <td>${item.qty}</td>
                <td>${item.total}</td>
            </tr>`
        );
    });

    // Show the modal
    $('#viewItems').modal('show');
}