<?php
include "../connectdb.php";
if(isset($_POST['modal_sku']) || isset($_POST['modal_itemname'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $sku = validate($_POST['modal_sku']);
    $itemname = validate($_POST['modal_itemname']);
    $itemstocks = validate($_POST['modal_stocks']);
    $expdate = mysqli_escape_string($sqlconn, $_POST['modal_date']);
    $price = validate($_POST['modal_price']);
    $uom = validate($_POST['uom']);
    $category = validate($_POST['category']);


    if(empty($itemname) || empty($sku)) {
        header("Location: Inventory.php?error=You cannot leave fields empty");
        exit();
    } 
    else {
        try {
            $sql_query = "INSERT INTO `items_db`(`item_sku`, `item_name`, `item_stocks`, `item_expdate`, `item_price`, `item_uom`, `item_category`) 
            VALUES ($sku, '$itemname', $itemstocks, '$expdate', $price, '$uom', '$category')";
        $sql_result = mysqli_query($sqlconn, $sql_query);

        if($sql_result) {
            header("Location: Inventory.php?msg=Item Added");
            exit();
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