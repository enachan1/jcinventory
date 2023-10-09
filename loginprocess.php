<?php
include "connectdb.php";
session_start();

if(isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $hash = password_hash($pass, PASSWORD_DEFAULT);


    if(empty($email)) {
        header("Location: login_form.php?error=You cannot leave fields empty");
        exit();
    }
    else if(empty($pass)) {
        header("Location: login_form.php?error=You cannot leave fields empty");
        exit();
    }
    else {
        $sqlquery = "SELECT * FROM users__db WHERE email = '$email'";
        $sqlconquery = mysqli_query($sqlconn, $sqlquery) or die("error");


        if(mysqli_num_rows($sqlconquery) === 1) {
            $rows = mysqli_fetch_assoc($sqlconquery);
            $hashed_fromDB = $rows['pass_word'];

            if($rows['email'] === $email && password_verify($pass, $hashed_fromDB)) {
                $_SESSION['id'] = $rows['id'];
                $_SESSION['user_name'] = $rows['user_name'];
                $_SESSION['is_admin'] = $rows['is_admin'];

                if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                    header("Location: /jcinventory/Dashboard/Dashboard.php");
                    #header("Location: Dashboard.php");
                    exit();
                }
                else if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0) {
                    header("Location: /jcinventory/POS/POS.php");
                    #echo 'not admin';
                    exit();
                }
                else {
                    header("Location: login_form.php?error=An Error Occured");
                    exit();
                    }
            }
            else {
                header("Location: login_form.php?error=Incorrect Email or Password");
                exit();
            }
        }
        else {
            header("Location: login_form.php?error=Incorrect Email or Password");
            exit();
        }
    }
}
else {
    header('Location: login_form.php?res=hehs');
    exit();
}


?>