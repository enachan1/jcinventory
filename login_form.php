<!DOCTYPE html>
<?php 
    session_start();
    if(isset($_SESSION['user_name']) && $_SESSION['is_admin'] == 1) {
        header("Location: /jcinventory/Dashboard/Dashboard.php");
        exit();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/loginstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200&display=swap" rel="stylesheet">
    <title>Log In</title>
</head>
<body>
    <form action="loginprocess.php" method="post">
    <div class="login-container">
        <h1>Jun and Cathy Grocery</h1>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']?></p>
        <?php } ?>

        <div class="input-container">
            <input type="text" name="email" id="email" class="forminput" placeholder=" " autocomplete="off">
            <label for="email" class="formlabel">Email or Username</label>
        </div>
         <div class="input-container">
            <input type="password" name="password" id="password"
            placeholder=" " class="forminput">
            <label for="password" class="formlabel">Password</label>
        </div>
        <div class="input-container">
            <input type="checkbox" for="showpass" id="checkboxPass" onclick="isChecked()">
            <label class="showPass">Show Password</label>
        </div>
        <button>Log In</button>
    </div>
</form>
<script src="showPassword.js"></script>
</body>
</html>