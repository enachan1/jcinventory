<?php
$con = mysqli_connect("localhost", "root", "", "juncathytest");

if (isset($_GET['search'])) {
    $filtervalues = $_GET['search'];
    $query = "SELECT * FROM items_db WHERE CONCAT(item_sku,item_name,item_category,item_stocks,item_price) LIKE '%$filtervalues%'";
    $query_run = mysqli_query($con, $query);

    foreach ($query_run as $items) {
        echo '<tr class="search-result">';
        echo '<td>' . $items['item_sku'] . '</td>';
        echo '<td>' . $items['item_name'] . '</td>';
        echo '<td>' . $items['item_category'] . '</td>';
        echo '<td>' . $items['item_stocks'] . '</td>';
        echo '<td>' . $items['item_price'] . '</td>';
        echo '</tr>';
    }
}
?>