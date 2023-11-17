<?php 

include "../connectdb.php";


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_sku = mysqli_real_escape_string($sqlconn,$_POST['v_id']);


    $sqlquery = "SELECT `po_item_name`, `po_category` FROM `purchase_order_db` WHERE `po_item_sku` = '$item_sku' AND `is_delivered` = 1";
    $query_result = mysqli_query($sqlconn, $sqlquery);


    if($query_result == TRUE) {
        if(mysqli_num_rows($query_result) > 0) {
            $data = array();
            while($get_rows = mysqli_fetch_assoc($query_result)) {
                $data[] = $get_rows;
            }

            
            $response = ['itemdesc' => $data];
            header('Content-Type: application/json');
            echo json_encode($response);

        }
        else {
            header("Location: Inventory.php?err=no record");
        }
    }
    else {
        header("Location: Inventory.php?err=no record");
    }

    
}
else {
    header("Location: Inventory.php?err=no record");
}


?>