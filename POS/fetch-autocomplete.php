<?php
include "../connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->query)) {
        $search_text = mysqli_real_escape_string($sqlconn, $data->query);

        $sqlquery = "SELECT * FROM `items_db` WHERE `item_barcode` LIKE '%$search_text%' OR `item_name` LIKE '%$search_text%' AND `item_stocks` > 0 ORDER BY `item_date_added` ASC LIMIT 1";

        $result = mysqli_query($sqlconn, $sqlquery);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<a href='#' class='list-group-item list-group-item-action list-group-item-secondary border-1 clickers' data-itemsku='". $row['item_barcode']. "'>" . $row['item_barcode'] . ' - ' . $row['item_name'] . "</a>";
            }
        } else {
            echo '<a href="#" class="list-group-item list-group-item-action list-group-item-secondary border-1">no record</a>';
        }
    }
} else {
    // header("Location: Inventory.php?msg=false");
}
?>