<?php
include "../connectdb.php";
if(isset($_GET['acc'])) 
$id = $_GET['acc'];

$sqlquery = "DELETE FROM `users__db` WHERE `acc_id`=$id";
try {
$sql_result = mysqli_query($sqlconn, $sqlquery);

if(!$sql_result) {
    die("Something's Wrong");
}
else {
    echo "Deleted Successfully";
}
}

catch (Exception $e) {
    echo $e;
}

?>