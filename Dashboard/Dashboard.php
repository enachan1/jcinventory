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


    $query_get_critical = "SELECT * FROM `setting_db`";
    $result = $sqlconn->query($query_get_critical);

    if($setting_row = $result->fetch_assoc()) {
        $critical = $setting_row['critical'];
        $average = $setting_row['average'];
        $reorder = $setting_row['reorder'];
        $stable = $setting_row['stable'];
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
    <style>
        .scrollable-table {
            max-height: 300px; /* Set the maximum height */
            overflow-y: auto; /* Enable vertical scrolling */
        }
        .icon-container {
            position: relative;
        }

        .icon-container::before {
            content: "₱"; /* Unicode character for the peso sign */
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 26px;
        }
    </style>
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
                        class="fad fa-users me-2"></i>User Accounts</a>
                <a href="../Notification/Notification.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-bell me-2"></i>Notification<span class="badge badge-light num-notif top-50 start-50 translate-middle-y rounded-circle bg-danger"></span></a>
                <a href="../Settings/Settings.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="far fa-cog me-2"></i>Setting</a>                            
                <a href="../logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Log-out</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 navadjust">
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
                        <!-- Help Icon -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-placement="bottom" data-bs-target="#helpModal" title="Help">
                                <i class="fas fa-question-circle"></i>
                            </a>
                        </li> -->
                        <li class="nav-item dropdown">
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
                            <span class="icon-container">
                                <i class="fas fa-sack fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </span>
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
                        <div class="col">
                            <h3 class="fs-4 mb-3">Expiring Items</h3>
                                <div class="table-responsive scrollable-table">
                                <table class="table colorbox rounded shadow-sm table-hover">
                                    <!-- Table Header -->
                                    <thead>
                                        <tr>
                                            <th scope="col">Item SKU</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        <?php 
                                        $expiring_query = "SELECT `item_sku`, `item_name`, `item_expdate` FROM `items_db`
                                            WHERE `item_expdate` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

                                        $result = $sqlconn->query($expiring_query);


                                        $expiring_count = "SELECT COUNT(`item_sku`) as `exp_count` FROM `items_db`
                                        WHERE `item_expdate` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

                                        $exp_query = $sqlconn->query($expiring_count);
                                        $exprow = $exp_query->fetch_assoc();
                                        $expCount = $exprow['exp_count'];

                                        if($expCount <= 0) {
                                        ?>
                                            <tr><td colspan="3" class="text-center">NO ITEMS</td></tr>
                                        <?php }
                                        
                                        else {
                                            while($rows = $result->fetch_assoc()) {?>
                                        <tr>
                                            <td><?= $rows['item_sku'] ?></td>
                                            <td><?= $rows['item_name'] ?></td>
                                            <td><?= $rows['item_expdate'] ?></td>
                                        </tr>
                                        <?php 
                                        }
                                    }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col">
                        <h3 class="fs-4 mb-3">Low Stock Items</h3>
                            <div class="table-responsive scrollable-table"> 
                                <table class="table colorbox rounded shadow-sm table-hover">
                                    <!-- Table Header -->
                                    <thead>
                                        <tr>
                                            <th scope="col">Item SKU</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Remaining Quantity</th>
                                            <th scope="col">Stock Status</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                    <?php 
                                            $running_out_query = "SELECT `item_sku`, `item_name`, `item_stocks`,
                                            CASE 
                                                WHEN `item_stocks` <= $critical THEN 'Critical'
                                                WHEN `item_stocks` <= $reorder THEN 'Reorder'
                                                WHEN `item_stocks` <= $average OR `item_stocks` < $stable THEN 'Average'
                                            END AS `stock_status`
                                             FROM `items_db`
                                                WHERE `item_stocks` <= $critical OR `item_stocks` <= $average"; // Adjust the condition as needed

                                            $result_running_out = $sqlconn->query($running_out_query);

                                            // Get the count of rows
                                            $count_query = "SELECT COUNT(`item_sku`) as `count` FROM `items_db`
                                                WHERE `item_stocks` <= $critical OR `item_stocks` <= $average";
                                            $result_count = $sqlconn->query($count_query);
                                            $count_rows = $result_count->fetch_assoc();
                                            $number_of_rows = $count_rows['count'];

                                            if ($number_of_rows <= 0) {
                                                ?>
                                                <td colspan="4" class="text-center">NO ITEMS</td>
                                                <?php
                                            } else {
                                                while ($rows_running_out = $result_running_out->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $rows_running_out['item_sku'] ?></td>
                                                        <td><?= $rows_running_out['item_name'] ?></td>
                                                        <td><?= $rows_running_out['item_stocks'] ?></td>
                                                        <td><?= $rows_running_out['stock_status'] ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    </div>


    <!-- Modal Goes Here -->
    
        <!-- Modal Help -->
        <!-- <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="helpModalLabel">Help</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> -->
                <!--Content Goes here-->
                <!-- <h1>Bullsheatiy Tortorial</h1>
                <img src="..." class="img-thumbnail" alt="...">
                <h5>qweasdqwrasdqrzxqw</h5>
                <p class="text-start">Start aligned text on all viewport sizes.</p>
                <p class="text-center">Center aligned text on all viewport sizes.</p>
                <p class="text-end">End aligned text on all viewport sizes.</p>

                <p class="text-sm-end">End aligned text on viewports sized SM (small) or wider.</p>
                </div> -->
                <!--Modal Footer Goes here-->
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div> -->
        <!-- End modal help -->


        <!-- /#page-content-wrapper -->

    <!--Boostrap Layout-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };


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

