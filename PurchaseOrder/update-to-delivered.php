<?php 
include "../connectdb.php";
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $vendor_id = mysqli_real_escape_string($sqlconn,$_GET['vdid']);

    $sql_query = "UPDATE `purchase_order_db` SET `is_delivered`= 1, `inventory_in`= 0
            WHERE `vendor_id` = $vendor_id";
        $sql_result = mysqli_query($sqlconn, $sql_query);

        if($sql_result == TRUE) {
            echo "Success";
            header("Location: PurchaseOrder.php");
        }
        else {
            echo "Not scuccess";
        }
}
else {
    echo "there's an error";
}



?>