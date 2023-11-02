<?php 
include "../connectdb.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $threshold = mysqli_real_escape_string($sqlconn, $_POST['threshold-inp']);
    $markup = mysqli_real_escape_string($sqlconn, $_POST['markup']);
    $markdown = mysqli_real_escape_string($sqlconn, $_POST['markdown']);


    $update_query = "UPDATE `setting_db` SET `threshold` = $threshold, `markup` = $markup, `markdown` = $markdown";
    $update_result = mysqli_query($sqlconn, $update_query);

    if($update_result == TRUE) {
        header("Location: Settings.php?msg=Update Success");
        exit();
    }
}


?>