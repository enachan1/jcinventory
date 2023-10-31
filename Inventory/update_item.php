<?php 
include "../connectdb.php";
if(isset($_POST['modal_sku']) || isset($_POST['modal_itemname'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_POST['modal_id']);
    $sku = validate($_POST['modal_sku']);
    $barcode = validate($_POST['modal_barcode']);
    $itemname = validate($_POST['modal_itemname']);
    $itemstocks = validate($_POST['modal_stocks']);
    $expdate = mysqli_escape_string($sqlconn, $_POST['modal_date']);
    $price = validate($_POST['modal_price']);
    $category = validate($_POST['category']);


    if(empty($itemname) || empty($sku)) {
        header("Location: Inventory.php?error=You cannot leave fields empty");
        exit();
    } 
    else {
        try {
            $sql_query = "UPDATE `items_db` SET `item_sku`='$sku', `item_barcode` = '$barcode', `item_name`='$itemname',`item_stocks`=$itemstocks,`item_expdate`='$expdate',`item_price`= $price,`item_category`='$category'
            WHERE `id` = $id";
        $sql_result = mysqli_query($sqlconn, $sql_query);

        if($sql_result) {
            header("Location: Inventory.php?msg=Update Success");
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