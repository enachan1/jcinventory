$(document).ready(function () {
    $('#addInput').click(function(e) {
        e.preventDefault();
        $(".show_items").prepend(
        `<tr>
        <!--Table Content-->
        <th><input type="text" class="form-control" id="itemName" name="#" required></th>
        <th><input type="text" class="form-control adjustments" id="qtY" name="#" required></th>
        <th>            
        <select class="form-select uom-dropdown" id="uom" name="uom">
       
        </select></th>
        <th>            
        <select class="form-select category-dropdown" id="category" name="category">
        
            <!-- Many Brands -->
        </select></th>
        <!--Added Input -->
        <td><button class="btn btn-primary btn-sm btn-danger" id="removeInput" type="button"><i class="fa fa-minus-circle"></i>
        </tr>`
    );

    // Populate UOM dropdown
    const uofDropdown = $('.uom-dropdown').first();
    fetchDropdownOptions(uofDropdown, 'uom');

    // Populate Category dropdown
    const categoryDropdown = $('.category-dropdown').first();
    fetchDropdownOptions(categoryDropdown, 'category');
    });

    $(document).on('click', '#removeInput', function(e) {
        e.preventDefault();

        let rowItem = $(this).parent().parent();
        $(rowItem).remove();
    });


});



function fetchDropdownOptions(dropdown, type) {
    $.ajax({
        url: 'populate.php?type=' + type,
        type: 'GET',
        success: function (data) {
            data.forEach(function (option) {
                dropdown.append('<option value="' + option.value + '">' + option.label + '</option>');
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}