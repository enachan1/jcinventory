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
        header("Location: ProductMaintenance.php?uomerror=You cannot leave this field empty");
        exit();
    } 
    else {
        $dup_query = "SELECT COUNT(*) as `duplicate_count` FROM uom_db WHERE `uom_name` = '$uom_name'";
        $dup_result = $sqlconn->query($dup_query);

        if($dup_result) {
            $dup_rows = $dup_result->fetch_assoc();
            $dup_count = $dup_rows['duplicate_count'];

            if($dup_count > 0) {
                header("Location: ProductMaintenance.php?uomerror=Duplicate Entry");
                exit();
            }
            else {
                $sql_query = "INSERT INTO uom_db (uom_name) VALUES ('$uom_name')";
                $sql_result = mysqli_query($sqlconn, $sql_query);

                if($sql_result) {
                    header("Location: ProductMaintenance.php?uommsg=UOM Added");
                    exit();
                }
                else {
                    header("Location: ProductMaintenance.php?uomerror=There's an error");
                    exit();
                }
            }
        }
    }
}
else {
    header("Location: ProductMaintenance.php");
    exit();
}


?>