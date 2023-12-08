<?php
include "../connectdb.php";
if(isset($_POST['category_name'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $category_name = validate($_POST['category_name']);


    if(empty($category_name)) {
        header("Location: ProductMaintenance.php?caterror=You cannot leave this field empty");
        exit();
    } 
    else {

        $duplicate_val = "SELECT COUNT(*) as `res_count` FROM `category_db` WHERE `category_name` = '$category_name'";
        $dup_val_result = $sqlconn->query($duplicate_val);
        if($dup_val_result) {
            $duplicate_rows = $dup_val_result->fetch_assoc();
            $rows_count = $duplicate_rows['res_count'];

            if($rows_count > 0) {
                header("Location: ProductMaintenance.php?caterror=Duplicate Entry");
                exit();
            }
            else {
                $sql_query = "INSERT INTO category_db (category_name) VALUES ('$category_name')";
                $sql_result = mysqli_query($sqlconn, $sql_query);
        
                if($sql_result) {
                    header("Location: ProductMaintenance.php?catmsg=Category Added");
                    exit();
                }
                else {
                    header("Location: ProductMaintenance.php?caterror=There's an error");
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