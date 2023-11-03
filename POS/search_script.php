<?php
$con = mysqli_connect("localhost", "root", "", "juncathytest");

if (isset($_GET['search'])) {
    $filtervalues = $_GET['search'];
    $query = "SELECT * FROM items_db WHERE CONCAT(item_sku,item_name,item_category) LIKE '%$filtervalues%' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        foreach ($query_run as $items) {
            echo '<tr>';
            echo '<td>' . $items['item_sku'] . '</td>';
            echo '<td>' . $items['item_name'] . '</td>';
            echo '<td>' . $items['item_category'] . '</td>';
            echo '</tr>';
        }
    } 
    else {
        echo '<tr><td colspan="3"></td></tr>';
    }
}
?>