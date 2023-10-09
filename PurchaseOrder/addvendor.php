<?php 
include "../connectdb.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $vendor_id = mysqli_real_escape_string($sqlconn, $_POST['vendorId']);
    $vendor_name = mysqli_real_escape_string($sqlconn, $_POST['vendorName']);
    $vendor_contact = mysqli_real_escape_string($sqlconn, $_POST['vendorContact']);


    $sqlquery = "INSERT INTO vendors_db (`vendor_id`, `vendor_name`, `vendor_contact`) VALUES ($vendor_id, '$vendor_name', $vendor_contact)";
    $result = mysqli_query($sqlconn, $sqlquery);

    if($result == false) {
        header("Location: PurchaseOrder.php?error=There's something wrong");
        exit();
    }
    else {
        header("Location: PurchaseOrder.php?msg=Added Successfully");
        exit();
    }
}
else {
    header("Location: PurchaseOrder.php");
    exit();
}




?>