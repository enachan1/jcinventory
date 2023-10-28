<?php 
include "../connectdb.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = mysqli_real_escape_string($sqlconn, $_POST['a_username']);
    $email = mysqli_real_escape_string($sqlconn, $_POST['a_email']);
    $password = mysqli_real_escape_string($sqlconn, $_POST['a_password']);
    $contact = mysqli_real_escape_string($sqlconn, $_POST['a_contact']);
    $usertype = mysqli_real_escape_string($sqlconn, $_POST['user_type']);


    if(isset($username) && isset($email) && isset($password)) {

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
    else {
        echo $sqlconn->error;
    }
}
else {
    header("Location: PurchaseOrder.php");
    exit();
}



?>