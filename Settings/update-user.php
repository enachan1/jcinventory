<?php 
include "../connectdb.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = mysqli_real_escape_string($sqlconn, $_POST['id']);
    $username = mysqli_real_escape_string($sqlconn, $_POST['username']);
    $email = mysqli_real_escape_string($sqlconn, $_POST['email']);
    $password = mysqli_real_escape_string($sqlconn, $_POST['password']);
    $conf_password = mysqli_real_escape_string($sqlconn, $_POST['confirmPassword']);
    $old_password = mysqli_real_escape_string($sqlconn, $_POST['old-password']);
    

    $password_query = "SELECT `id`, `pass_word` FROM users__db WHERE `user_name` = '$username'";
    $pass_result = mysqli_query($sqlconn, $password_query);

    if ($pass_result == TRUE) {
        if($rows = mysqli_fetch_assoc($pass_result)) {
            $id = $rows['id'];
            $query_hashed_pass = $rows['pass_word'];

            if (!password_verify($old_password, $query_hashed_pass)) {
                header("Location: Settings.php?err=Old password don't match");
                exit();
            }
            else if($password != $conf_password) {
                header("Location: Settings.php?err=Not the same password");
                exit();
            }
            else if (strlen($password) < 6) {
                header("Location: Settings.php?err=Please input more than 6 password");
                exit();
            }
            else {
            $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $update_query = "UPDATE `users__db` SET `user_name` = '$username', `email` = '$email', `pass_word` = '$hash_password' WHERE `id` = $id";
            $update_result = mysqli_query($sqlconn, $update_query);
        
            if($update_result == TRUE) {
                header("Location: Settings.php?msg=Update Success");
                exit();
            }
            }

        }
    }


    

    
}


?>