<?php
include "../connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->query)) {
        $search_text = mysqli_real_escape_string($sqlconn, $data->query);

        $sqlquery = "SELECT * FROM `purchase_order_db` WHERE (`po_item_name` LIKE '%$search_text%') AND `is_delivered` = 1 AND `inventory_in` = 0";

        $result = mysqli_query($sqlconn, $sqlquery);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<a href='#' class='list-group-item list-group-item-action border-1 clickers' data-itemsku='". $row['po_item_sku']. "'>" . $row['po_item_sku'] . ' - ' . $row['po_item_name'] .  "</a>";
            }
        }
    }
} else {
    header("Location: Inventory.php?msg=false");
}
?>