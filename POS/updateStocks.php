<?php
include "../connectdb.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dataToUpdate = json_decode($_POST["dataToUpdate"], true);

    // Start a transaction
    mysqli_autocommit($sqlconn, FALSE);
    $success = true;
    // print_r($_POST);

    $overallQuantity = $_POST['overAllQty'];
    $overallTotal = $_POST['overallTotalVal'];

    foreach ($dataToUpdate as $datas) {
        $sku = mysqli_real_escape_string($sqlconn, $datas['sku']);
        $item_name = mysqli_real_escape_string($sqlconn, $datas['item_name']);
        $qty = mysqli_real_escape_string($sqlconn, $datas['qty']);
        $total_amount = mysqli_real_escape_string($sqlconn, $datas['totalAmount']);

        $update_query = "UPDATE items_db SET item_stocks = item_stocks - $qty WHERE item_barcode = $sku";
        $result_update = mysqli_query($sqlconn, $update_query);

        if (!$result_update) {
            $success = false;
            break; // Exit the loop if an update fails
        }

        // Insert into the sales table
        $insert_query = "INSERT INTO `sales_db`(`s_sku`, `s_item`, `s_qty`, `s_total`, `s_date`) VALUES ($sku, '$item_name', $qty, $total_amount, NOW())";
        $result_insert = mysqli_query($sqlconn, $insert_query);

        if (!$result_insert) {
            $success = false;
            break;
        }
    }

    if ($success) {
        $generate_reciept = "juncathyr" . date('YmdHis');
        $transaction_query = "INSERT INTO `transaction_db`(`reciept_no`,`transaction_date`, `total_item`, `overall_amount`) VALUES ('$generate_reciept', NOW(), $overallQuantity, $overallTotal)";
        $result_transaction = mysqli_query($sqlconn, $transaction_query);

        if($result_transaction == true) {

            $truncate_query = "TRUNCATE TABLE `purchase_db`";
            $result_truncate = mysqli_query($sqlconn, $truncate_query);

            if ($result_truncate) {
                mysqli_commit($sqlconn); // Commit the transaction if everything is successful
                header("Location: POS.php?msg=success");
                exit();
        }
    }
    }

    mysqli_rollback($sqlconn); // Rollback the transaction on failure
    header("Location: POS.php?msg=error");
    exit();
} else {
    // Handle invalid requests here
    http_response_code(400);
    echo "Bad Request";
}
