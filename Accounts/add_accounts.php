<?php 
include "../connectdb.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim(mysqli_real_escape_string($sqlconn, $_POST['a_username']));
    $email = trim(mysqli_real_escape_string($sqlconn, $_POST['a_email']));
    $password = mysqli_real_escape_string($sqlconn, $_POST['a_password']);
    $contact = mysqli_real_escape_string($sqlconn, $_POST['a_contact']);
    $usertype = mysqli_real_escape_string($sqlconn, $_POST['user_type']);


    if(isset($username) && isset($email) && isset($password)) {

    $count = "SELECT COUNT(*) as 'Count' FROM `users__db` WHERE `user_name` = '$username'";
    $query_result = mysqli_query($sqlconn, $count);


    if($query_result == TRUE) {
        $rows = mysqli_fetch_assoc($query_result);
        $existing = $rows['Count'];

        if($existing > 0) {
            echo "Existing Username or Password";
        }
        else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sqlquery = "INSERT INTO users__db (`user_name`, `email`, `pass_word`, `contact_no`, `is_admin`) VALUES (?, ?, ?, ?, ?)";
        $result = $sqlconn->prepare($sqlquery);
        $result->bind_param('sssii', $username, $email, $hashed_password, $contact, $usertype);

        if($result == false) {
            header("Location: PurchaseOrder.php?error=There's something wrong");
            exit();
        }
        else {
            $result->execute();
            echo "Account Added Successfully";
        }
    }
}
}

}
else {
    header("Location: PurchaseOrder.php");
    exit();
}



?>