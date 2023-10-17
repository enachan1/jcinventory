<?php
$query = "SELECT vendors_db.vendor_id, vendors_db.vendor_name as Vendor, purchase_order_db.vendor_id as item_vendorID FROM vendors_db JOIN purchase_order_db ON vendors_db.vendor_id = purchase_order_db.vendor_id";
$results = mysqli_query($sqlconn, $query);
$previous = null;

while ($rows = mysqli_fetch_assoc($results)) {
    if ($rows['Vendor'] != $previous) {
        echo '<tr>';
        echo '<td>' . $rows['Vendor'] . '</td>';
        echo '<td>';
        echo '<button type="button" class="btn btn-primary btn-sm">View Items</button>';
        echo '<a href="delete_po.php?vendorid=' . $rows['item_vendorID'] . '" class="btn btn-danger btn-sm">Delete</a>';
        echo '</td>';
        echo '<td>';
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">';
        echo '<label class="form-check-label" for="flexRadioDefault1">Delivered</label>';
        echo '</div>';
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">';
        echo '<label class="form-check-label" for="flexRadioDefault1">Bad Order</label>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
        $previous = $rows['Vendor'];
    }
}
?>