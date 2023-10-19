<?php
include "../connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_vendor_id = $_POST['vendorID'];

    $query = "SELECT vendors_db.vendor_id,
                     vendors_db.vendor_name as Vendor,
                     purchase_order_db.vendor_id as item_vendorID,
                     purchase_order_db.po_dot as transaction_date,
                     purchase_order_db.po_expdelivery as exp_del_date,
                     purchase_order_db.po_item_name as item_name,
                     purchase_order_db.po_qty as qty,
                     purchase_order_db.po_uom as uom,
                     purchase_order_db.po_category as category
              FROM vendors_db
              JOIN purchase_order_db ON vendors_db.vendor_id = purchase_order_db.vendor_id
              WHERE vendors_db.vendor_id = $item_vendor_id";

    $result = $sqlconn->query($query);

    if ($result === false) {
        echo json_encode(['error' => $sqlconn->error]);
    } else {
        $data = array(); 

        while ($rows = mysqli_fetch_assoc($result)) {
            $data[] = $rows; 
        }

        
        $sqlconn->close();
        $response = ['items' => $data];
        echo json_encode($response);
    }
} else {
    echo json_encode(['error' => 'THERE IS SOMETHING WRONG WITH YOUR CODE DUMBASS']);
}
?>
