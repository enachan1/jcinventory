<?php
include "../connectdb.php";
if(isset($_GET['vendorid'])) 
$id = $_GET['vendorid'];

$sqlquery = "DELETE FROM `purchase_order_db` WHERE `vendor_id` = $id";
try {
$sql_result = mysqli_query($sqlconn, $sqlquery);

if(!$sql_result) {
    die("Something's Wrong");
}
else {
    header("Location: PurchaseOrder.php?msg=Deleted Successfully");
    exit();
}
}

catch (Exception $e) {
    echo $e;
}

?>