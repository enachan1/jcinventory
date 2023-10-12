<?php
include "../connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->query)) {
        $search_text = mysqli_real_escape_string($sqlconn, $data->query);

        $sqlquery = "SELECT `vendor_id` FROM `vendors_db` WHERE `vendor_id` LIKE '%$search_text%'";

        $result = mysqli_query($sqlconn, $sqlquery);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<a href='#' class='list-group-item list-group-item-action border-1 clickers'>" . $row['vendor_id'] . "</a>";
            }
        } else {
            echo '<a href="#" class="list-group-item list-group-item-action border-1">no record</a>';
        }
    }
} else {
    header("Location: PurchaseOrder.php?gag=hhoho");
}
?>