<?php
include "../connectdb.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dataToUpdate = json_decode($_POST["dataToUpdate"], true);

    // Start a transaction
    mysqli_autocommit($sqlconn, FALSE);
    $success = true;

    $overallQuantity = $_POST['overAllQty'];
    $overallTotal = $_POST['overallTotalVal'];

    //generate reciept no
    $generate_reciept = "juncathyr" . date('YmdHis');

    //get date today
    date_default_timezone_set('Asia/Manila');
    $get_date = date("Y-m-d H:i:s");

    foreach ($dataToUpdate as $datas) {
        $sku = mysqli_real_escape_string($sqlconn, $datas['sku']);
        $item_name = mysqli_real_escape_string($sqlconn, $datas['item_name']);
        $qty = mysqli_real_escape_string($sqlconn, $datas['qty']);
        $total_amount = mysqli_real_escape_string($sqlconn, $datas['totalAmount']);

        // Check if requested quantity is greater than available stock
        $select_stock_query = "SELECT item_stocks FROM items_db WHERE item_barcode = $sku ORDER BY `item_date_added` ASC LIMIT 1";
        $result_stock = mysqli_query($sqlconn, $select_stock_query);

        if (!$result_stock || mysqli_num_rows($result_stock) !== 1) {
            $success = false;
            break; // Exit the loop on error
        }

        $row = mysqli_fetch_assoc($result_stock);
        $availableStock = $row['item_stocks'];

        if ($qty > $availableStock) {
            $success = false;
            break; // Exit the loop if requested quantity exceeds available stock
        }

        $update_query = "UPDATE items_db SET item_stocks = item_stocks - $qty WHERE item_barcode = $sku ORDER BY `item_date_added` ASC LIMIT $qty";
        $result_update = mysqli_query($sqlconn, $update_query);

        if (!$result_update) {
            $success = false;
            break; // Exit the loop if an update fails
        }

        // Insert into the sales table
        $insert_query = "INSERT INTO `sales_db`(`s_sku`, `s_item`, `s_qty`, `s_total`, `s_date`, `reciept_no`) VALUES ($sku, '$item_name', $qty, $total_amount, '$get_date', '$generate_reciept')";
        $result_insert = mysqli_query($sqlconn, $insert_query);

        if (!$result_insert) {
            $success = false;
            break;
        }
    }

    if ($success) {
        $transaction_query = "INSERT INTO `transaction_db`(`reciept_no`,`transaction_date`, `total_item`, `overall_amount`) VALUES ('$generate_reciept', '$get_date', $overallQuantity, $overallTotal)";
        $result_transaction = mysqli_query($sqlconn, $transaction_query);

        if ($result_transaction == true) {
            mysqli_commit($sqlconn); // Commit the transaction if everything is successful
            echo "true";
        }
    }

    mysqli_rollback($sqlconn); // Rollback the transaction on failure
    echo "false";
} else {
    // Handle invalid requests here
    http_response_code(400);
    echo "Bad Request";
}
