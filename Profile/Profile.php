<html>
<?php
include "../connectdb.php";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
$user = $_SESSION['user_name'];

    if(!isset($user)) {
        header("Location: login_form.php");
        exit();
    }


?>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../styles.css" />
        <title>Accounts</title>
    </head>
    

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
                        class="fas fa-bell me-2"></i>Notification</a>
                <a href="../Settings/Settings.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="far fa-cog me-2"></i>Setting</a>                            
                <a href="../logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Log-out</a>
            </div>
        </div>
    
            <!--Page Content-->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 navadjust">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left fs-4 me-3 " id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Personal Account</h2>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 dropadjust">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $user ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../Profile/Profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="../Settings/Settings.php">Setting</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="../logout.php">Log-out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                </nav>

                <div class="container mt-5 p-5">
                    <h1 class="text-center">Personal Account</h1>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Account Information</h5>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" value="kuris@gmail.com" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" value="John Pork" readonly>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Birthday:</label>
                                <input type="text" class="form-control" id="birthday" value="January 1, 1990" readonly>
                            </div>
                            <!-- You can add more information here as needed -->
                        </div>
                    </div>
                </div>











    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
            
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
            
        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
            
            
    </script>

</body>
<?php
}
else {
    header("Location: /jcinventory/login_form.php");
    exit();
}


?>
</html>
