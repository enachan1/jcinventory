<?php
include "../connectdb.php";
if(isset($_GET['id'])) 
$id = $_GET['id'];

$sqlquery = "UPDATE `notification_db` SET `is_deleted` = 1 WHERE `notif_id`=$id";
try {
$sql_result = mysqli_query($sqlconn, $sqlquery);

if($sql_result == true) {
    // $del_query = "DELETE FROM `notification_db` WHERE `notif_id`= $id AND `is_deleted` = 1";
    // $sql_result1 = mysqli_query($sqlconn, $del_query);

    // if($sql_result1) {
    //     echo "Deleted";
    // }

    echo "deleted";
}
}
catch (Exception $e) {
    echo $e;
}

?>