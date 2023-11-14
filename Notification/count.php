<?php 
include "../connectdb.php";

$query_count = "SELECT COUNT(*) as notif_count FROM `notification_db`";

$result = $sqlconn->query($query_count);


if($rows = $result->fetch_assoc()) {
    echo $rows['notif_count'];
}
?>