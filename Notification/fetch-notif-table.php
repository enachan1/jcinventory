<?php 
include "../connectdb.php";

$fetch_table = "SELECT * FROM `notification_db` WHERE `is_deleted` = 0";
$result = $sqlconn->query($fetch_table);


while($rows = $result->fetch_assoc()) {
    $tbl_data = '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
    $tbl_data .= '<div class="d-flex align-items-center">';
    $tbl_data .= '<i class="fas fa-exclamation-triangle me-2"></i>';
    $tbl_data .= '<strong>'. $rows['message'] .'</strong>';
    $tbl_data .= '</div>';
    $tbl_data .= '<button class="btn-close" data-dismiss="alert" id="btn-del" data-id="'. $rows['notif_id'] .'" aria-label="Close"><span aria-hidden="true"></button>';
    $tbl_data .= '</div>';

    echo $tbl_data;
}

mysqli_close($sqlconn);

?>