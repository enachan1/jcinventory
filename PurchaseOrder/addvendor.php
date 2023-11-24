<?php 
include "../connectdb.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // $vendor_id = mysqli_real_escape_string($sqlconn, $_POST['vendorId']);
    $vendor_name = mysqli_real_escape_string($sqlconn, $_POST['vendorName']);
    $vendor_contact = mysqli_real_escape_string($sqlconn, $_POST['vendorContact']);


    $sqlquery = "INSERT INTO vendors_db (`vendor_name`, `vendor_contact`) VALUES ('$vendor_name', $vendor_contact)";
    $query_for_rows = "SELECT COUNT(*) as count FROM `vendors_db` WHERE `vendor_name` = '$vendor_name'";

    //query for counting duplicate entry
    $qrows_result = $sqlconn->query($query_for_rows);

    //declaring variable for the count
    if ($qrows = $qrows_result->fetch_assoc()) {
        $dup_count = $qrows['count'];
    }

    if($dup_count > 0) {
        header("Location: PurchaseOrder.php?venerror=Vendor Exist");
        exit();
    }
    else {
        //query for inserting vendor
        $result = mysqli_query($sqlconn, $sqlquery);

        if($result == false) {
            header("Location: PurchaseOrder.php?error=There's something wrong");
            exit();
        }
        else {
            header("Location: PurchaseOrder.php?venmsg=Added Successfully");
            exit();
        }
    }
}
else {
    header("Location: PurchaseOrder.php");
    exit();
}




?>