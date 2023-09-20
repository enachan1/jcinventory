<?php 
include "../connectdb.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
if($_SERVER["REQUEST_METHOD"]==="POST") {
    $dataToUpdate = json_decode($_POST["dataToUpdate"], true);

    foreach ($dataToUpdate as $datas) {
        $sku = mysqli_real_escape_string($sqlconn, $datas['sku']);
        $qty = mysqli_real_escape_string($sqlconn, $datas['qty']);

        $update_query = "UPDATE items_db SET item_stocks = item_stocks - $qty WHERE item_sku = $sku";
        $result_update = mysqli_query($sqlconn, $update_query);
    }
    if($result_update) {
        $truncate_query = "TRUNCATE TABLE `purchase_db`";
        $result_truncate = mysqli_query($sqlconn, $truncate_query);
        if ($result_truncate === true) {
            header("Location: POS.php");
            exit();
        }
        
    }
    else {
        header("Location: POS.php?msg=tanga");
        exit();
    }

}
else {
    // Handle invalid requests here
    http_response_code(400);
    echo "Bad Request";
}


?>