<?php
include "../connectdb.php";
if(isset($_POST['modal_sku']) || isset($_POST['modal_itemname'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $get_current_date = date('Y-m-d');

    $sku = validate($_POST['modal_sku']);
    $barcode = validate($_POST['modal_barcode']);
    $itemname = validate($_POST['modal_itemname']);
    $itemstocks = validate($_POST['modal_stocks']);
    $expdate = mysqli_escape_string($sqlconn, $_POST['modal_date']);
    $price = validate($_POST['modal_price']);
    // $uom = validate($_POST['uom']);
    $category = validate($_POST['category']);


    // threshold inputs
    $sales = validate($_POST['sales']);
    $stable = validate($_POST['stable']);
    $average = validate($_POST['average']);
    $reorder = validate($_POST['reorder']);
    $critical = validate($_POST['critical']);


    if(empty($itemname) || empty($sku)) {
        header("Location: Inventory.php?error=You cannot leave fields empty");
        exit();
    } 
    else {
        try {
            $sql_query = "INSERT INTO `items_db`(`item_sku`,`item_barcode`, `item_name`, `item_stocks`, `item_expdate`, `item_price`, `item_category`,`item_date_added`, `sales`, `stable`, `average`, `reorder`, `critical`) 
            VALUES ('$sku', $barcode, '$itemname', $itemstocks, '$expdate', $price, '$category', '$get_current_date', $sales, $stable, $average, $reorder, $critical)";
        $sql_result = mysqli_query($sqlconn, $sql_query);

        if($sql_result == TRUE) {
            $remove_po = "UPDATE purchase_order_db SET `inventory_in` = 1 WHERE `po_item_sku` = '$sku'";
            $remove_res = mysqli_query($sqlconn, $remove_po);

            if($remove_res == TRUE) {
                header("Location: Inventory.php?msg=Item Added");
                exit();
            }
        }
        else {
            header("Location: Inventory.php?error=There's an error");
            exit();
        }
    }
    catch(Exception $e) {
        echo $e;
    }

    }
}
else {
    header("Location: Inventory.php");
    exit();
}


?>