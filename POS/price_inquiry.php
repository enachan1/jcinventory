<?php
$con = mysqli_connect("localhost", "root", "", "juncathytest");

if (isset($_GET['price'])) {
    $filtervalues = $_GET['price'];
    $query = "SELECT * FROM items_db WHERE CONCAT(item_sku, item_name, item_category, item_price) LIKE '%$filtervalues%' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $data = [];
        while ($items = mysqli_fetch_assoc($query_run)) {
            $data[] = [
                'item_sku' => $items['item_sku'],
                'item_name' => $items['item_name'],
                'item_category' => $items['item_category'],
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