<?php
include "../connectdb.php";
if(isset($_POST['uom_name'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $uom_name = validate($_POST['uom_name']);


    if(empty($uom_name)) {
        header("Location: ProductMaintenance.php?error=You cannot leave this field empty");
        exit();
    } 
    else {
        $sql_query = "INSERT INTO uom_db (uom_name) VALUES ('$uom_name')";
        $sql_result = mysqli_query($sqlconn, $sql_query);

        if($sql_result) {
            header("Location: ProductMaintenance.php?msg=uom Added");
            exit();
        }
        else {
            header("Location: ProductMaintenance.php?error=There's an error");
            exit();
        }
    }
}
else {
    header("Location: ProductMaintenance.php");
    exit();
}


?>