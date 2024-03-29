<?php 

include "../connectdb.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER['REQUEST_METHOD'] == "POST") {
$vendor_id = mysqli_real_escape_string($sqlconn, $_POST['vendorId']);
$dateoftransaction = mysqli_real_escape_string($sqlconn, $_POST['dateTrans']);
$expectedDelivery = mysqli_real_escape_string($sqlconn, $_POST['expectDel']);

$query = "SELECT COUNT(*) as count_valid FROM purchase_order_db WHERE vendor_id = $vendor_id";
$count_result = $sqlconn->query($query);


if($count_result) {
    $sqlRows = $count_result->fetch_assoc();
    $row_count = $sqlRows['count_valid'];

    if($row_count > 0) {
        header("Location: PurchaseOrder.php?err=There is an ongoing order");
    }
    else {
        foreach ($_POST['PO_sku'] as $key => $value) {
            $sql_query = "INSERT INTO `purchase_order_db`(`po_item_sku`,`po_item_name`, `po_qty`, `po_uom`, `po_category`, `po_item_price`, `po_dot`, `po_expdelivery`, `is_delivered`, `inventory_in`, `vendor_id`) VALUES (? ,?, ?, ?, ?, ?, ?, ?, NULL, 0, ?)";
            $stmt = $sqlconn->prepare($sql_query);
            
            $stmt->bind_param("ssssssssi", $value, $_POST['PO_itemname'][$key], $_POST['PO_qty'][$key], $_POST['PO_uom'][$key], $_POST['PO_category'][$key], $_POST['PO_price'][$key], $dateoftransaction, $expectedDelivery, $vendor_id);
            
            $stmt->execute();
        }
        
        // header("Location: PurchaseOrder.php");
    }
}







}
else {
    // header("Location: PurchaseOrder.php?msg=Error");
}

?>