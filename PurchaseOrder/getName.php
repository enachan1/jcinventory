<?php 

include "../connectdb.php";


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vendor_name = mysqli_real_escape_string($sqlconn,$_POST['v_name']);


    $sqlquery = "SELECT `vendor_id` FROM vendors_db WHERE `vendor_name` = '$vendor_name'";
    $query_result = mysqli_query($sqlconn, $sqlquery);


    if($query_result == TRUE) {
        if(mysqli_num_rows($query_result) > 0) {
            $get_rows = mysqli_fetch_array($query_result);

            $vendor_nm = $get_rows['vendor_id'];

            echo $vendor_nm;
        }
        else {
            header("Location: PurchaseOrder.php?err=no record");
        }
    }
    else {
        header("Location: PurchaseOrder.php?err=no record");
    }

    
}
else {
    header("Location: PurchaseOrder.php?err=no record");
}


?>