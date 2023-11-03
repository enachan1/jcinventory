$(document).ready(function () {
    $('#skuInput').keyup(function (e) { 
        e.preventDefault();
        var skuinput_text = $(this).val();

        console.log(skuinput_text);
        if(skuinput_text != '') {
            $.ajax({
                url: "fetch-autocomplete.php",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({ query: skuinput_text }),
                success: function (response) {
                    $("#showlist_skuitems").html(response);
                }
            });
        } else {
            $("#showlist_skuitems").html('');
        }
    });

    $(document).on('click', '.clickers', function(e) {
        var get_itemsku = $(this).data('itemsku');
        $('#skuInput').val(get_itemsku);

        $.ajax({
            url: "fetch-items.php",
                method: "POST",
                data: { v_id: get_itemsku },
                success: function (response) {
                    console.log(response);
                    fetch_data_from_input(response);
                }
            });
        

        $("#showlist_skuitems").html('');
    });
});


function fetch_data_from_input(data) {
    if (data && Array.isArray(data.itemdesc)) {
        data.itemdesc.forEach(function (item) {
            $('#itemnameInput').val(item.po_item_name);
            $('#add_category').val(item.po_category);
            $('#cpriceInput').val(item.po_item_price);
        });
    } else {
        console.error("Data or data.itemdesc is not defined or not an array.");
    }
}