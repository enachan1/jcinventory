<?php
include "../connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_vendor_id = $_POST['vendorID'];

    $query = "SELECT vendors_db.vendor_id as venddID,
                     vendors_db.vendor_name as Vendor,
                     purchase_order_db.po_item_sku as itemSku,
                     purchase_order_db.vendor_id as item_vendorID,
                     purchase_order_db.po_dot as transaction_date,
                     purchase_order_db.po_expdelivery as exp_del_date,
                     purchase_order_db.po_item_name as item_name,
                     purchase_order_db.po_qty as qty,
                     purchase_order_db.po_uom as uom,
                     purchase_order_db.po_category as category,
                     purchase_order_db.po_item_price as price
              FROM vendors_db
              JOIN purchase_order_db ON vendors_db.vendor_id = purchase_order_db.vendor_id
              WHERE vendors_db.vendor_id = $item_vendor_id";

            $result = $sqlconn->query($query);
            $po_total = "SELECT ROUND(SUM(po_item_price),2) as `po_total_price` FROM `purchase_order_db` WHERE `vendor_id` = $item_vendor_id";
            $result_total = $sqlconn->query($po_total);

    if ($result === false) {
        echo json_encode(['error' => $sqlconn->error]);
    } else {
        $data = array(); 

        while ($rows = mysqli_fetch_assoc($result)) {
            $data[] = $rows;
        }

        if($rows_total = $result_total->fetch_assoc()) {
            $result_total_po = $rows_total['po_total_price'];
        }
        
        $sqlconn->close();
        $response = ['items' => $data,
        'total' => $result_total_po];
        echo json_encode($response);
    }
} else {
    echo json_encode(['error' => 'THERE IS SOMETHING WRONG']);
}
?>
