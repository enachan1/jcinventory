<?php
include "../connectdb.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['vdid'])) {
    $vendor_id = mysqli_real_escape_string($sqlconn, $_GET['vdid']);

    // Perform a database query to fetch the is_delivered status
    $sql_query = "SELECT isBadOrder FROM purchase_order_db WHERE vendor_id = $vendor_id";
    $sql_result = mysqli_query($sqlconn, $sql_query);

    if ($sql_result) {
        $row = mysqli_fetch_assoc($sql_result);

        // Check if a record was found and return the is_delivered value
        if ($row) {
            echo $row['isBadOrder'];
        } else {
            echo "0"; // Return 0 if no record was found
        }
    } else {
        echo "0"; // Return 0 on database error
    }
} else {
    echo "0"; // Return 0 for invalid request
}
?>
