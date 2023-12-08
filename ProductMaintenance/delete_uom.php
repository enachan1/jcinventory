<?php

include "../connectdb.php";

if(isset($_GET['id'])) 
$id = $_GET['id'];

$sqlquery = "DELETE FROM `uom_db` WHERE `id` = $id";
try {
$sql_result = mysqli_query($sqlconn, $sqlquery);

if(!$sql_result) {
    die("Something's Wrong");
}
else {
    header("Location: ProductMaintenance.php?uommsg=Deleted Successfully");
    exit();
}
}

catch (Exception $e) {
    echo $e;
}
?>