<?php
$con = mysqli_connect("localhost", "root", "", "juncathytest");

if (isset($_GET['price'])) {
    $filtervalues = $_GET['price'];
    $query = "SELECT * FROM items_db WHERE CONCAT(item_barcode, item_name, item_category, item_stocks, item_price) LIKE '%$filtervalues%' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $data = [];
        while ($items = mysqli_fetch_assoc($query_run)) {
            $data[] = [
                'item_barcode' => $items['item_barcode'],
                'item_name' => $items['item_name'],
                'item_category' => $items['item_category'],
                'item_stocks' => $items['item_stocks'],
                'item_price' => $items['item_price']
            ];
        }
        $response = [
            'data' => $data,
        ];

        echo json_encode($response);
    } else {
        $response = [
            'data' => [],
        ];

        echo json_encode($response);
    }
}
?>