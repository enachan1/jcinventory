<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
$user = $_SESSION['user_name'];

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
        <title>Reports</title>
    </head>
    <!--
    <style>
        
        .nav-link.active {
            color: red;
        }
    </style>
    -->
    
<body>
    <!-- Sidebar -->
    <div class="d-flex" id="wrapper">
        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i></i>Jun&Cathy</div>

            
            <div class="list-group list-group-flush my-3">
                        <a href="../Dashboard/Dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-home-lg-alt me-2"></i>Dashboard</a>
                        <a href="../Inventory/Inventory.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-inventory me-2"></i>Inventory</a>
                        <a href="../ProductMaintenance/ProductMaintenance.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-folders me-2"></i>Product Maintenance</a>
                        <a href="../Reports/Reports.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-file-spreadsheet me-2"></i>Reports</a>
                        <a href="../Accounts/Accounts.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fad fa-users me-2"></i>Accounts</a>
                        <a href="../Notification/Notification.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-bell me-2"></i>Notification</a>
                        <a href="../Settings/Settings.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="far fa-cog me-2"></i>Setting</a>                            
                        <a href="../logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>

<!--Page Content-->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left fs-4 me-3 " id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Reports</h2>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i><?php echo $user; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../Profile/Profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="../Settings/Settings.php">Setting</a></li>
                            <li><a class="dropdown-item" href="/JunCathyPOSInventory/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </nav>

    <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="col-md-4">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">720</h3>
                        <p class="fs-5">Product Sold</p>
                    </div>
                    <i class="fas fa-box fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">4920</h3>
                        <p class="fs-5">Total Sales</p>
                    </div>
                    <i
                        class="fas fa-signal-alt fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">3899</h3>
                        <p class="fs-5">Total Cost</p>
                    </div>
                    <i class="fas fa-dollar-sign fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>



    <!--Tab button--->

    <div class="container mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <!-- Navigation Menu -->
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab" aria-controls="sales" aria-selected="true">
                    <i class="fas fa-chart-line"></i> Sales Report
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab" aria-controls="inventory" aria-selected="false">
                    <i class="fas fa-box"></i> Inventory Report
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">
                    <i class="fas fa-truck"></i> Delivery Report
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="badorder-tab" data-bs-toggle="tab" data-bs-target="#badorder" type="button" role="tab" aria-controls="badorder" aria-selected="false">
                    <i class="fas fa-exclamation-circle"></i> Bad Order Report
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="trackrecord-tab" data-bs-toggle="tab" data-bs-target="#trackrecord" type="button" role="tab" aria-controls="trackrecord" aria-selected="false">
                    <i class="fas fa-list-alt"></i> Transaction Record
                </a>
            </li>
        </ul>

        <!-- Tab content -->
        
        <!-- Sales Report -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Sales Report</h5>
                        <table class="table colorbox rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item No.</th>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table content here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Inventory Report -->
            <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Inventory Report</h5>
                        <table class="table colorbox rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item No.</th>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table content here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Delivery Report -->
            <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Delivery Report</h5>
                        <table class="table colorbox rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item No.</th>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table content here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bad Order Report -->
            <div class="tab-pane fade" id="badorder" role="tabpanel" aria-labelledby="badorder-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Bad Order Report</h5>
                        <table class="table colorbox rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item No.</th>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table content here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Transaction Record -->
            <div class="tab-pane fade" id="trackrecord" role="tabpanel" aria-labelledby="trackrecord-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Transaction Record</h5>
                        <table class="table colorbox rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Collect Records</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table content here -->
                            </tbody>
                        </table>
                    </div>
                </div>
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
    header("Location: /JunCathyPOSInventory/login_form.php");
    exit();
}


?>
</html>