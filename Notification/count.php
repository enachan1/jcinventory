<?php 
include "../connectdb.php";

$query_count = "SELECT COUNT(*) as notif_count FROM `notification_db` WHERE `is_deleted` = 0";

$result = $sqlconn->query($query_count);


if($rows = $result->fetch_assoc()) {
    echo $rows['notif_count'];
}
?>