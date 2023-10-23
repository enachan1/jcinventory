<?php 
include "../connectdb.php";


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $update_vendor_id = mysqli_real_escape_string($sqlconn, $_POST['uvendorId']);
    $update_vendor_name = mysqli_real_escape_string($sqlconn, $_POST['uvendorName']);
    $update_vendor_contact = mysqli_real_escape_string($sqlconn, $_POST['uvendorContact']);


    $update_vendor_query = "UPDATE `vendors_db` SET `vendor_name` = '$update_vendor_name', `vendor_contact`= $update_vendor_contact
    WHERE `vendor_id` = $update_vendor_id";

    $update_result = mysqli_query($sqlconn, $update_vendor_query);

    if($update_result == TRUE) {
        header("Location: PurchaseOrder.php?msg=Updated Success");
        exit();
    }
    else {
        echo $sqlconn->error;
    }
}

else {
    echo $sqlconn->error;
}





?>