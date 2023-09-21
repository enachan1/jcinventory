<?php
include "../connectdb.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_POST['skubarcode'])) {


    $input_sku = $_POST['skubarcode'];

    if(empty($input_sku)) {
        header("Location: POS.php?msg=Error");
        exit();
    }
    
    else {
        try {
        $select_query = "SELECT * FROM items_db WHERE item_sku = $input_sku";
        $result_query = mysqli_query($sqlconn, $select_query);
        if($result_query === false) {
            header("Location: POS.php?msg=Item not found");
            exit();
        }
        else {
            if(mysqli_num_rows($result_query) === 1) {
                $rows = mysqli_fetch_assoc($result_query);
                $itemsku = $rows['item_sku'];
                $itemname = $rows['item_name'];
                $itemprice = $rows['item_price'];


                addtoPosTable($itemsku, $itemname, $itemprice);
            }
            else {
            header("Location: POS.php");
            exit();
            }
        }
    }
    catch (Exception $e) {
        echo $e;
    }

    }
}
else {
    header("Location: POS.php");
}


function addtoPosTable($itemSkuValue,$itemNameValue, $itemPriceValue) {
    include "../connectdb.php";
    if(isset($itemSkuValue)) {
        if(empty($itemSkuValue)) {
            header("Location: POS.php?msg=Error");
            exit();
        }
        else {
        try {
        $insert_query = "INSERT INTO `purchase_db`(`p_sku`, `p_itemname`, `p_price`) VALUES ($itemSkuValue,'$itemNameValue',$itemPriceValue)";
        $result_query = mysqli_query($sqlconn, $insert_query);

        if($result_query) {
            header("Location: POS.php?msg=inserted success");
            exit();
        }
        else {
            header("Location: POS.php?error=error");
        }
        }
        catch (Exception $e) {
            echo $e;
        }
    }

    }
    else {
        header("Location: POS.php");
    }
}
?>