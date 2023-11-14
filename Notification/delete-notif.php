<?php
include "../connectdb.php";
if(isset($_GET['id'])) 
$id = $_GET['id'];

$sqlquery = "DELETE FROM `notification_db` WHERE `notif_id`=$id";
try {
$sql_result = mysqli_query($sqlconn, $sqlquery);

if($sql_result == true) {
    // if ($sqlconn->affected_rows > 0) {
    //     echo "Notification deleted successfully";
    // } else {
    //     echo "Notification not found or already deleted";
    // }
    echo "Deleted";
}
}
catch (Exception $e) {
    echo $e;
}

?>