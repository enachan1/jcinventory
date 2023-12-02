<?php 
include "../connectdb.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $threshold = mysqli_real_escape_string($sqlconn, $_POST['threshold-inp']);
    $critical = mysqli_real_escape_string($sqlconn, $_POST['critical']);
    $reorder = mysqli_real_escape_string($sqlconn, $_POST['reorder']);
    $average = mysqli_real_escape_string($sqlconn, $_POST['average']);
    $stable = mysqli_real_escape_string($sqlconn, $_POST['stable']);



    $update_query = "UPDATE `setting_db` SET `threshold` = $threshold, `reorder` = $reorder, `average` = $average, `critical` = $critical, `stable` = $stable";
    $update_result = mysqli_query($sqlconn, $update_query);

    if($update_result == TRUE) {
        header("Location: Settings.php?invmsg=Update Success");
        exit();
    }
}


?>