<?php 
include "../connectdb.php";

if(isset($_GET['delven'])) {
    $vendor_id = mysqli_real_escape_string($sqlconn, $_GET['delven']);



    $delete_vendor = "DELETE FROM vendors_db WHERE `vendor_id` = $vendor_id";
    $results = $sqlconn->query($delete_vendor);

    if($results == true) {
        header("Location: PurchaseOrder.php?vendelete=Deleted Successfully");
        exit();
    }
}


?>