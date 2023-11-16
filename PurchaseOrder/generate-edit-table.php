<?php 
include "../connectdb.php";

if(isset($_GET['vendorid']) && $_SERVER['REQUEST_METHOD'] == "GET") {
    $vendor_id = mysqli_real_escape_string($sqlconn, $_GET['vendorid']);
    print_r($vendor_id);


    $query = "SELECT vendors_db.vendor_id as vendId,
                    vendors_db.vendor_name as Vendor,
                    purchase_order_db.vendor_id as item_vendorID,
                    purchase_order_db.po_dot as dateOfTransaction,
                    purchase_order_db.po_expdelivery as expectedDel
                    FROM vendors_db
                    JOIN purchase_order_db ON vendors_db.vendor_id = purchase_order_db.vendor_id
                    WHERE purchase_order_db.vendor_id = $vendor_id";

            $results = $sqlconn->query($query);



            while ($rows = $results->fetch_assoc()) {
                

                $generate_info = '<form method="POST" id="formList">';
                $generate_info .= '<div class="mb-4">';
                $generate_info .= '<div class="mb-4">';
                $generate_info .= '<label for="vendorID" class="form-label">Vendor ID</label>' .
                                    '<input type="number" class="form-control"  value="'.$rows['vendId'].'"id="vendorID" name="vendorId" required>' . 
                                    '<label for="vendorNAME" class="form-label">Vendor Name</label>'.
                                    '<input type="text" class="form-control" value="'.$rows['Vendor'].'" id="vendorNAME" name="vendorName" disabled>'.
                                    '<label for="dateTransaction" class="form-label">Date of Transaction</label>'.
                                    '<input type="date" class="form-control" value="<?= date("Y-m-d")?>" id="dateTransaction" name="dateTrans" readonly>'.
                                    '<label for="expectedDelivery" class="form-label">Expected Delivery</label>'.
                                    '<input type="date" class="form-control" value="'. $rows['expectedDel'] .'" id="expectedDelivery" name="expectDel" required><br>'
                
            }

}






?>