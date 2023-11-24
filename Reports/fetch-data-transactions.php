<?php
include "../connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reciept = $_POST['recieptData'];

    $query = "SELECT sales_db.s_sku as Barcode,
                     sales_db.s_item as itemName,
                     sales_db.s_qty as qty,
                     sales_db.s_total as total,
                     transaction_db.reciept_no as reciept_num,
                     transaction_db.transaction_date as t_date
                    
              FROM transaction_db
              JOIN sales_db ON transaction_db.reciept_no = sales_db.reciept_no
              WHERE transaction_db.reciept_no = '$reciept'";

    $result = $sqlconn->query($query);

    $querySum = "SELECT ROUND(SUM(s_total), 2) as Overall,
     ROUND(SUM(s_total) + SUM(s_total) * 0.12, 2) as TotalVat 
    FROM sales_db 
    WHERE reciept_no = '$reciept'";

    $resultSum = $sqlconn->query($querySum);

    if ($result === false && $resultSum === false) {
        echo json_encode(['error' => $sqlconn->error]);
    } else {
        $data = array(); 

        while ($rows = mysqli_fetch_assoc($result)) {
            $data[] = $rows; 
        }

        if($total_rows = mysqli_fetch_assoc($resultSum)) {
            $sum = $total_rows['Overall'];
            $withVat = $total_rows['TotalVat'];

        }
        
        $sqlconn->close();
        $response = [
                    'items' => $data,
                    'Overall' => $sum,
                    'Vat' => $withVat
                    ];
        echo json_encode($response);
    }
} else {
    echo json_encode(['error' => 'THERE IS SOMETHING WRONG WITH YOUR CODE']);
}
?>
