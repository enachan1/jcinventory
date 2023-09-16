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
        header("Location: ProductMaintenance.php?error=You cannot leave this field empty");
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