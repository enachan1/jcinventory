<?php 
include "../connectdb.php";


$setting = "SELECT * FROM `setting_db`";
$setting_result = $sqlconn->query($setting);

if($setting_rows = $setting_result->fetch_assoc()) {
    $critical = $setting_rows['critical'];
    $average = $setting_rows['average'];
}



?>