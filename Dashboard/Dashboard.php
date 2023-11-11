<!DOCTYPE html>
<?php
include "../connectdb.php";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name']) && $_SESSION['is_admin'] == 1) {
$user = $_SESSION['user_name'];

    if(!isset($user)) {
        header("Location: login_form.php");
        exit();
    }


?>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="../styles.css" />
    <script type="text/javascript">
        window.history.forward();
    </script>
    <title>Dashboard</title>
</head>

<body>
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
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left fs-4 me-3 " id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
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
                                <i class="fas fa-user me-2"></i><?php echo $user; ?>
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

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-4">
                        <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php
                                $total_sales_today = "SELECT COUNT(*) as total_count FROM items_db";
                                $total_result_day = mysqli_query($sqlconn, $total_sales_today);
                                if ($rows_count = mysqli_fetch_array($total_result_day)) {
                                ?>
                                
                                
                                <h3 class="fs-2"><?php echo $rows_count['total_count'] ?></h3>
                                <p class="fs-5">Products</p>
                                <?php }?>
                            </div>
                            <i class="fas fa-box fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                $total_sales_today = "SELECT ROUND(SUM(`s_total`),2) as today_sales FROM sales_db
                                    WHERE DATE(s_date) = CURDATE()";
                                $total_result_day = mysqli_query($sqlconn, $total_sales_today);
                                if ($rows_count = mysqli_fetch_array($total_result_day)) {
                                    if(!isset($rows_count['today_sales'])) {
                                ?>
                                <h3 class="fs-2">₱ 0</h3>
                                <?php }
                                else {
                                    ?>
                                    <h3 class="fs-2">₱ <?php echo $rows_count['today_sales'] ?></h3>
                                <?php }
                                }
                                ?>
                                <p class="fs-5">Today Sales</p>
                            </div>
                            <i
                                class="fas fa-sack-dollar fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                $total_sales_today = "SELECT COUNT(*) as delivered_items FROM purchase_order_db
                                    WHERE `is_delivered` = 1";
                                $total_result_day = mysqli_query($sqlconn, $total_sales_today);
                                if ($rows_count = mysqli_fetch_array($total_result_day)) {
                                ?>
                                
                                
                                <h3 class="fs-2"><?php echo $rows_count['delivered_items'] ?></h3>
                                <?php }?>
                                <p class="fs-5">Delivered</p>
                            </div>
                            <i class="fad fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Expiration Date</h3>
                    <div class="col">
                        <table class="table colorbox rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Chicaron</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Orea</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Orea</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Sardens</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Choco Choco</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Mints</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Kleso</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>Yiama</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>Skyflex</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>Doni Donat</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">11</th>
                                    <td>Respa</td>
                                    <td>6/20/25</td>
                                </tr>
                                <tr>
                                    <th scope="row">12</th>
                                    <td>Muchos</td>
                                    <td>6/20/25</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

        <!-- /#page-content-wrapper -->

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

