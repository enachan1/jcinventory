<?php 
include "../connectdb.php";



// print_r($_POST);


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $vendor_id = mysqli_real_escape_string($sqlconn, $_POST['vendorId']);
    $exp_del = mysqli_real_escape_string($sqlconn, $_POST['expectDel']);

    print_r($_POST);


    try {
        foreach($_POST['ePO_sku'] as $key => $value) {
            $update_query = "UPDATE `purchase_order_db` SET `po_item_name` = ?, `po_qty` = ?, `po_uom` = ?, `po_category` = ?, `po_item_price` = ?, `po_expdelivery` = ? WHERE `vendor_id` = ? AND `po_item_sku` = ?";
            $result = $sqlconn->prepare($update_query);
            
    
            $result->bind_param("ssssisss", $_POST['ePO_itemname'][$key], $_POST['ePO_qty'][$key], $_POST['ePO_uom'][$key], $_POST['ePO_category'][$key], $_POST['ePO_price'][$key], $exp_del, $vendor_id, $PO_sku);
            $PO_sku = $_POST['ePO_sku'][$key];
    
            $result->execute();
        }
    } catch(Exception $e) {
        print_r($e);
    }
    header("Location: PurchaseOrder.php");
    
}
?>