<!DOCTYPE html>
<?php
include "../connectdb.php";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name']) && $_SESSION['is_admin'] == 1) {
$user = $_SESSION['user_name'];
$email = $_SESSION['email'];
$id = $_SESSION['id'];

    if(!isset($user)) {
        header("Location: login_form.php");
        exit();
    }
    ?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../styles.css" />
        <title>Settings</title>
    </head>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .nav-tabs .nav-item {
            border: none;
        }

        .nav-tabs .nav-link {
            border: none;
            border-radius: 0; /* Remove border-radius if applied by Bootstrap */
        }
    </style>

<body>
        <!-- Sidebar -->
    <div class="d-flex" id="wrapper">
        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">Jun&Cathy</div>
            <div class="list-group list-group-flush my-3">
                <a href="../Dashboard/Dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-home-lg-alt me-2"></i>Dashboard</a>
                <a href="../Inventory/Inventory.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-inventory me-2"></i>Inventory</a>
                <a href="../ProductMaintenance/ProductMaintenance.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-tools me-2"></i>Product Maintenance</a>
                <a href="../PurchaseOrder/PurchaseOrder.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-shopping-bag me-2"></i>Purchase Order</a>
                <a href="../Reports/Reports.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-file-spreadsheet me-2"></i>Reports</a>
                <a href="../Accounts/Accounts.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fad fa-users me-2"></i>Accounts</a>
                <a href="../Notification/Notification.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-bell me-2"></i>Notification<span class="badge badge-light num-notif top-50 start-50 translate-middle-y rounded-circle bg-danger"></span></a>
                <a href="../Settings/Settings.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="far fa-cog me-2"></i>Setting</a>                            
                <a href="../logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Log-out</a>
            </div>
        </div>



        <!--Page Content-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left fs-4 me-3 " id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Setting</h2>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav nav-tabs ms-3 border border-0" id="myTab" role="tablist">
                        <!-- Navigation Tabs -->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5" href="?tb=1" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab" aria-controls="inventory" aria-selected="true"><i class="fas fa-cog"></i><i class="fas fa-box"></i> Inventory Settings</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5" href="?tb=2" id="account-setting-tab" data-bs-toggle="tab" data-bs-target="#account-setting" type="button" role="tab" aria-controls="account-setting" aria-selected="false"><i class="fas fa-user-cog"></i> Account Setting</a>
                        </li>
                    </ul>

                    <!-- Right-aligned items -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown dropadjust">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $user; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../Settings/Settings.php">Setting</a></li>
                                <li><a class="dropdown-item" href="../logout.php">Log-out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Tab content -->

            <!--Inventory Setting Content Here -->
            <div class="container mt-4">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                            <h2 class="text-center">Inventory Settings</h2>
                            <br>
                            <?php 
                                if(isset($_GET['invmsg'])) {
                                ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?= $_GET['invmsg'] ?>
                                    <button class="btn-close" data-bs-dismiss="alert" id="removemsgBtn" aria-label="Close"></button>
                                </div>
                                <?php } 
                            
                                ?>

                                    <form action="update-inventory-setting.php" method="POST" autocomplete="off">
                                        <?php 
                                        $query_value = "SELECT * FROM `setting_db`";
                                        $result_query_value = mysqli_query($sqlconn, $query_value);


                                        while($result_rows = mysqli_fetch_array($result_query_value)) {
                                        ?>
                                        <div class="form-group">
                                            <label for="Threshold">Threshold</label>
                                            <input type="number" class="form-control" id="Threshold" value="<?= $result_rows['threshold'] ?>" name="threshold-inp">
                                        </div>
                                        <div class="form-group">
                                            <label for="critical">Critical Threshold</label>
                                            <input type="number" class="form-control" value="<?= $result_rows['critical']?>" name="critical">
                                        </div>
                                        <div class="form-group">
                                            <label for="average">Average Threshold</label>
                                            <input type="number" class="form-control" value="<?= $result_rows['average'] ?>" name="average">
                                        </div>
                                        <div class="form-group">
                                            <label for="reorder">Reorder Threshold</label>
                                            <input type="number" class="form-control" value="<?= $result_rows['reorder'] ?>" name="reorder">
                                        </div>
                                        <div class="form-group">
                                            <label for="reorder">Stable Threshold</label>
                                            <input type="number" class="form-control" value="<?= $result_rows['stable'] ?>" name="stable">
                                        </div>
                                        <div class="form-group">
                                            <label for="mark-up">Markup %</label>
                                            <input type="number" class="form-control" id="mark-up" value="<?= $result_rows['markup'] ?>" name="markup">
                                        </div>
                                            <?php } ?>
                                        <button type="submit">Save Changes</button>
                                    </form>
                        </div>
                        <!--Inventory Setting Ends here -->

                    <!-- Account Settings-->
                    <div class="tab-pane fade" id="account-setting" role="tabpanel" aria-labelledby="account-setting-tab">
                        <h2 class="text-center">Account Setting</h2>
                        <br>
                        <?php 
                            if(isset($_GET['err'])) {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?= $_GET['err'] ?>
                                <button class="btn-close" data-bs-dismiss="alert" id="removeErrorButton" aria-label="Close"></button>
                            </div>
                            <?php } 
                            
                            ?>

                            <?php 
                            if(isset($_GET['msg'])) {
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $_GET['msg'] ?>
                                <button class="btn-close" data-bs-dismiss="alert" id="removeErrorButton" aria-label="Close"></button>
                            </div>
                            <?php } ?>
                        <form action="update-user.php" method="POST" autocomplete="off">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?= $user ?>" class="form-control" placeholder="Enter your username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?= $email ?>" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Old Password</label>
                                <input type="password" id="password" name="old-password" class="form-control" placeholder="Enter your Old password" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm your password" required>
                            </div>
                            <button type="submit">Save Changes</button>
                        </form>
                    </div>
                    <!-- Accounts Setting Ends Here -->

                </div>
            </div>
            <!-- Tab Content Ends Here -->

    </div>
</div>
<!-- Content Ends Here -->
                
    <!-- Boostrap Layout -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
            
    <script>
        //Element Menu Toggle
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
        
        //Sidebar Toggle
        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        $(document).ready(function() {
        $('#removeErrorButton').on('click', function() {
        // Remove the 'err' query parameter from the URL
            var currentUrl = window.location.href;
            var updatedUrl = currentUrl.replace(/[?&]err=.*&?/, '');
            history.replaceState({}, document.title, updatedUrl);
        });

        $('#removemsgBtn').on('click', function() {
        // Remove the 'invmsg' query parameter from the URL
            var currentUrl = window.location.href;
            var updatedUrl = currentUrl.replace(/[?&]invmsg=.*&?/, '');
            history.replaceState({}, document.title, updatedUrl);
        });
    });    
    
    //Tab Active function
    document.addEventListener('DOMContentLoaded', function () {
        var storageKey = 'activeTabSet4';

        // Retrieve the last active tab from sessionStorage
        var lastActiveTab = sessionStorage.getItem(storageKey);

        // If no last active tab is found, default to the "Category" tab (tab number 1)
        if (lastActiveTab === null) {
            lastActiveTab = 1;
        }

        // Add a click event listener to restore the last active tab
        var tabLink = document.querySelector('a[href="?tb=' + lastActiveTab + '"]');

        if (tabLink) {
            tabLink.click();
        }

        // Add a click event listener to save the active tab to sessionStorage
        var tabLinks = document.querySelectorAll('#myTab a.nav-link');
        tabLinks.forEach(function (tabLink) {
            tabLink.addEventListener('click', function () {
                var tabNumber = tabLink.getAttribute('href').split('=')[1];
                sessionStorage.setItem(storageKey, tabNumber);
            });
        });
    });

    </script>

    <!-- For notification script -->
    <script src="../notif-count.js"></script>
</body>
<?php
}
else {
    header("Location: /jcinventory/login_form.php");
    exit();
}


?>
</html>