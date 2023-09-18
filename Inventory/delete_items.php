<?php
include "../connectdb.php";
if(isset($_GET['id'])) 
$id = $_GET['id'];

$sqlquery = "DELETE FROM `items_db` WHERE `id`=$id";
try {
$sql_result = mysqli_query($sqlconn, $sqlquery);

if(!$sql_result) {
    die("Something's Wrong");
}
else {
    header("Location: Inventory.php?msg=Deleted Successfully");
    exit();
}
}

catch (Exception $e) {
    echo $e;
}

?>