<?php 
include "../connectdb.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $threshold = mysqli_real_escape_string($sqlconn, $_POST['threshold-inp']);
    $markup = mysqli_real_escape_string($sqlconn, $_POST['markup']);
    $critical = mysqli_real_escape_string($sqlconn, $_POST['critical']);
    $reorder = mysqli_real_escape_string($sqlconn, $_POST['reorder']);
    $average = mysqli_real_escape_string($sqlconn, $_POST['average']);



    $update_query = "UPDATE `setting_db` SET `threshold` = $threshold, `markup` = $markup, `reorder` = $reorder, `average` = $average, `critical` = $critical";
    $update_result = mysqli_query($sqlconn, $update_query);

    if($update_result == TRUE) {
        header("Location: Settings.php?invmsg=Update Success");
        exit();
    }
}


?>