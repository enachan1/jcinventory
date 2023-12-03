<?php
include "../connectdb.php";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name']) && $_SESSION['is_admin'] == 1) {
$user = $_SESSION['user_name'];

    if(!isset($user)) {
        header("Location: login_form.php");
        exit();
    }
    //for fast moving table threshold
    $threshold_query = "SELECT * FROM `setting_db`";
    $threshold_query_result = mysqli_query($sqlconn, $threshold_query);

    if($rows = mysqli_fetch_assoc($threshold_query_result)) {
        $threshold = $rows['threshold'];
        $critical = $rows['critical'];
        $reorder = $rows['reorder'];
        $average = $rows['average'];
        $stable = $rows['stable'];
    }

?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../styles.css" />
        <!-- data tables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
        <title>Reports</title>
    </head>
    <style>
        .nav-tabs .nav-item {
            border: none;
        }

        .nav-tabs .nav-link {
            border: none;
            border-radius: 0; /* Remove border-radius if applied by Bootstrap */
        }
        .icon-container {
            position: relative;
        }

        .icon-container::before {
            content: "₱"; 
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 26px;
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
                        class="fad fa-users me-2"></i>User Accounts</a>
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
            <h2 class="fs-2 m-0">Reports</h2>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav nav-tabs ms-3 border border-0" id="myTab" role="tablist">
                <!-- Navigation Menu -->
                <li class="nav-item" role="presentation">
                    <a class="nav-link fs-5" href="?tb=1" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab" aria-controls="sales" aria-selected="true">
                        <i class="fas fa-chart-line"></i> Sales Report
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fs-5" href="?tb=2" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab" aria-controls="inventory" aria-selected="false">
                        <i class="fas fa-box"></i> Inventory Report
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fs-5" href="?tb=3" id="trackrecord-tab" data-bs-toggle="tab" data-bs-target="#trackrecord" type="button" role="tab" aria-controls="trackrecord" aria-selected="false">
                        <i class="fas fa-list-alt"></i> Transaction Record
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fs-5" href="?tb=4" id="slow-tab" data-bs-toggle="tab" data-bs-target="#slow" type="button" role="tab" aria-controls="slow" aria-selected="false">
                        <i class="fas fa-arrow-down"></i> Slow Moving
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fs-5" href="?tb=5" id="fast-tab" data-bs-toggle="tab" data-bs-target="#fast" type="button" role="tab" aria-controls="fast" aria-selected="false">
                        <i class="fas fa-arrow-up"></i> Fast Moving
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fs-5" href="?tb=6" id="close-tab" data-bs-toggle="tab" data-bs-target="#closing" type="button" role="tab" aria-controls="fast" aria-selected="false">
                        <i class="fas fa-store" style="position: relative; color: inherit;">
                            <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; font-size: 26px;">/</span>
                        </i>
                        Daily Closing Sales
                    </a>
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

    <div class="container-fluid px-3">
        <div class="row g-3 my-2">
            <div class="col-md-6">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                    <?php
                        // Get total products sold count
                        $total_sales_qty_query = "SELECT COUNT(*) as total_qty FROM sales_db";
                        $total_sales_qty_result = mysqli_query($sqlconn, $total_sales_qty_query);

                        if ($total_qty_count = mysqli_fetch_array($total_sales_qty_result)) {
                        ?>
                            <h3 class="fs-2"><?php echo $total_qty_count['total_qty'] ?></h3>
                        <?php } ?>
                        <p class="fs-5">Products Sold</p>
                    </div>
                    <i class="fas fa-check fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                    <?php
                        // Get total sales amount for the current month
                        $total_sales_month_query = "SELECT ROUND(SUM(`s_total`), 2) as total_monthly_sales
                                                FROM `sales_db`
                                                WHERE MONTH(`s_date`) = MONTH(CURDATE()) AND YEAR(`s_date`) = YEAR(CURDATE())";
                        $total_sales_month_result = mysqli_query($sqlconn, $total_sales_month_query);

                        if ($total_monthly_sales = mysqli_fetch_array($total_sales_month_result)) {
                        ?>
                            <h3 class="fs-2">₱ <?php echo $total_monthly_sales['total_monthly_sales'] ?></h3>
                        <?php } ?>
                        <p class="fs-5">Monthly Total Sales</p>
                    </div>
                    <span class="icon-container">
                        <i class="fas fa-sack fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                    </span>
                </div>
            </div>

    <!--Tab button--->
    <div class="container mt-3">
        <!-- Tab content -->
        
        <!-- Sales Report -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Sales Report</h5>
                         <!-- Drop down -->
                         <div class="d-flex justify-content-end bd-highlight">
                         <div class="p-2 bd-highlight">
                         <form action="" method="GET">
                            <select class="form-select mb-3 form-select-sm" name="filter" aria-label="Default select example">
                            <!-- <option selected value="" disabled="">Open this select menu</option> -->
                                <option selected value="">--Select Filter--</option>
                                <option value="Monthly"<?=isset($_GET['filter']) == TRUE ? ($_GET['filter'] == 'Monthly' ? 'selected': ''): '' ?>>Monthly</option>
                                <option value="Weekly" <?=isset($_GET['filter']) == TRUE ? ($_GET['filter'] == 'Weekly' ? 'selected': ''): '' ?>>Weekly</option>
                                <option value="Daily" <?=isset($_GET['filter']) == TRUE ? ($_GET['filter'] == 'Daily' ? 'selected': ''): '' ?>>Daily</option>
                            </select>
                         </div>
                         <div class="p-2 bd-highlight">
                         <button class="btn btn-primary btn-sm">Filter</button>
                         </div>
                         
                         </div>
                         </form>
                        <!-- end Drop down -->
                        <table id="sales-table" class="table bg-white rounded shadow-sm table-hover">
                            <div id="btnwrapper"></div>
                            <thead>
                                <tr>
                                    <th>Item Barcode</th>
                                    <th>Item Name</th>
                                    <th>Item Quantity</th>
                                    <th>Price Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>


                                <!-- Table content here -->
                                <?php 
                                if(isset($_GET['filter']) == TRUE && $_GET['filter'] != "") {
                                    $filter = mysqli_real_escape_string($sqlconn, $_GET['filter']);

                                    if($filter == "Monthly") {
                                        $sales_query1 = "SELECT * FROM `sales_db` 
                                        WHERE s_date >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01') 
                                        AND s_date <= LAST_DAY(CURRENT_DATE)
                                        ORDER BY `s_date` DESC";
                                        $result_sales_query = mysqli_query($sqlconn, $sales_query1);
                                    }
                                    elseif($filter == "Weekly") {
                                        $sales_query1 = "SELECT * FROM `sales_db` 
                                        WHERE s_date >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
                                        AND s_date < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 7 DAY)
                                        ORDER BY `s_date` DESC";
                                        $result_sales_query = mysqli_query($sqlconn, $sales_query1);
                                    }
                                    elseif($filter == "Daily") {
                                        $sales_query1 = "SELECT * FROM `sales_db` WHERE DATE(s_date) = CURDATE() ORDER BY `s_date` DESC";
                                        $result_sales_query = mysqli_query($sqlconn, $sales_query1);
                                    } 
                                }
                                else {
                                    $sales_query1 = "SELECT * FROM `sales_db` ORDER BY `s_date` DESC";
                                    $result_sales_query = mysqli_query($sqlconn, $sales_query1);
                                }
                                

                                while($rows = mysqli_fetch_assoc($result_sales_query)) {
                                
                                ?>
                                <tr>
                                    <td><?=$rows['s_sku']?></td>
                                    <td><?=$rows['s_item']?></td>
                                    <td><?=$rows['s_qty']?></td>
                                    <td><?=$rows['s_total']?></td>
                                    <td><?=$rows['s_date']?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>                
                    </div>
                </div>
            </div>
            <!-- End Sales Report -->

            <!-- Inventory Report -->
            <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Inventory Report</h5>
                        <!-- Drop down -->
                        <div class="d-flex justify-content-end bd-highlight">
                        <div class="p-2 bd-highlight">
                            <form action="" method="GET">
                        <select class="form-select mb-3 form-select-sm" name="invlev" id="dropdown-val" aria-label="Default select example">
                            <option value="Fast"<?=isset($_GET['invlev']) == TRUE ? ($_GET['invlev'] == 'Fast' ? 'selected': ''): '' ?>>Fast</option>
                            <option value="Slow" <?=isset($_GET['invlev']) == TRUE ? ($_GET['invlev'] == 'Slow' ? 'selected': ''): '' ?>>Slow</option>
                        </select>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-primary btn-sm">Filter</button>
                                </form>
                        </div>
                        </div>
                        <!-- end Drop down -->
                        <table id="invetoryr-table" class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item Barcode</th>
                                    <th>Item Name</th>
                                    <th>Item Catogory</th>
                                    <th>Item Stocks</th>
                                    <th>Stock Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($_GET['invlev']) == TRUE && $_GET['invlev'] != "") {
                                    $filter = mysqli_real_escape_string($sqlconn, $_GET['invlev']);

                                    if($filter == "Fast") {
                                        $inventory_level_query = "SELECT `item_barcode`, `item_name`, `item_category`, `item_stocks`, `stock_status`
                                    FROM (
                                        SELECT item.`item_barcode`, item.`item_name`, item.`item_category`, item.`item_stocks`,
                                            CASE 
                                                WHEN item.`item_stocks` > $stable THEN 'Stable'
                                                WHEN item.`item_stocks` <= $critical THEN 'Critical'
                                                WHEN item.`item_stocks` <= $reorder THEN 'Reorder'
                                                WHEN item.`item_stocks` <= $average OR item.`item_stocks` < $stable THEN 'Average'
                                            END AS `stock_status`,
                                            ROW_NUMBER() OVER (PARTITION BY item.`item_barcode` ORDER BY item.`item_date_added` ASC) as row_num
                                        FROM `items_db` item
                                        JOIN (
                                            SELECT sales.`s_sku` as sales_barcode
                                            FROM `sales_db` sales
                                            WHERE
                                                sales.`s_date` >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01')
                                            AND sales.`s_date` <= LAST_DAY(CURRENT_DATE)
                                            GROUP BY
                                                `s_item`
                                            HAVING SUM(sales.`s_qty`) >= $threshold
                                        ) fm ON item.`item_barcode` = fm.`sales_barcode`
                                    ) subquery
                                    WHERE row_num = 1";
                                            $result = $sqlconn->query($inventory_level_query);
                                    }

                                    elseif ($filter == "Slow") {
                                        $inventory_level_query = "SELECT `item_barcode`, `item_name`, `item_category`, `item_stocks`, `stock_status`
                                        FROM (
                                            SELECT item.`item_barcode`, item.`item_name`, item.`item_category`, item.`item_stocks`,
                                                CASE 
                                                    WHEN item.`item_stocks` > $stable THEN 'Stable'
                                                    WHEN item.`item_stocks` <= $critical THEN 'Critical'
                                                    WHEN item.`item_stocks` <= $reorder THEN 'Reorder'
                                                    WHEN item.`item_stocks` <= $average OR item.`item_stocks` < $stable THEN 'Average'
                                                END AS `stock_status`,
                                                ROW_NUMBER() OVER (PARTITION BY item.`item_barcode` ORDER BY item.`item_date_added` ASC) as row_num
                                            FROM `items_db` item
                                            JOIN (
                                                SELECT sales.`s_sku` as sales_barcode
                                                FROM `sales_db` sales
                                                WHERE
                                                    sales.`s_date` >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01')
                                                AND sales.`s_date` <= LAST_DAY(CURRENT_DATE)
                                                GROUP BY
                                                    `s_item`
                                                HAVING SUM(sales.`s_qty`) <= $threshold
                                            ) fm ON item.`item_barcode` = fm.`sales_barcode`
                                        ) subquery
                                        WHERE row_num = 1";

                                        $result = $sqlconn->query($inventory_level_query);
                                    }

                                    
                                }
                                else {
                                    $inventory_level_query = "SELECT `item_barcode`, `item_name`, `item_category`, `item_stocks`, `stock_status`
                                    FROM (
                                        SELECT item.`item_barcode`, item.`item_name`, item.`item_category`, item.`item_stocks`,
                                            CASE 
                                                WHEN item.`item_stocks` > $stable THEN 'Stable'
                                                WHEN item.`item_stocks` <= $critical THEN 'Critical'
                                                WHEN item.`item_stocks` <= $reorder THEN 'Reorder'
                                                WHEN item.`item_stocks` <= $average OR item.`item_stocks` < $stable THEN 'Average'
                                            END AS `stock_status`,
                                            ROW_NUMBER() OVER (PARTITION BY item.`item_barcode` ORDER BY item.`item_date_added` ASC) as row_num
                                        FROM `items_db` item
                                        JOIN (
                                            SELECT sales.`s_sku` as sales_barcode
                                            FROM `sales_db` sales
                                            WHERE
                                                sales.`s_date` >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01')
                                            AND sales.`s_date` <= LAST_DAY(CURRENT_DATE)
                                            GROUP BY
                                                `s_item`
                                            HAVING SUM(sales.`s_qty`) >= $threshold
                                        ) fm ON item.`item_barcode` = fm.`sales_barcode`
                                    ) subquery
                                    WHERE row_num = 1";
                                $result = $sqlconn->query($inventory_level_query);
                                }
                                while($rows = mysqli_fetch_assoc($result)) {
                                ?>
                                <!-- Table content here -->
                                <tr>
                                    <td><?= $rows['item_barcode'] ?></td>
                                    <td><?= $rows['item_name'] ?></td>
                                    <td><?= $rows['item_category'] ?></td>
                                    <td><?= $rows['item_stocks'] ?></td>
                                    <td><?= $rows['stock_status'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Inventory Report -->


            <!-- Transaction Record -->
            <div class="tab-pane fade" id="trackrecord" role="tabpanel" aria-labelledby="trackrecord-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Transaction Record</h5>
                        <!-- Drop down -->
                        <div class="d-flex justify-content-end bd-highlight">
                        <div class="p-2 bd-highlight">
                        <form action="" method="GET">
                        <select class="form-select mb-3 form-select-sm" name="filter_transaction" id="dropdown-val" aria-label="Default select example">
                                <option selected value="">--Select Filter--</option>
                                <option value="Monthly"<?=isset($_GET['filter_transaction']) == TRUE ? ($_GET['filter_transaction'] == 'Monthly' ? 'selected': ''): '' ?>>Monthly</option>
                                <option value="Weekly" <?=isset($_GET['filter_transaction']) == TRUE ? ($_GET['filter_transaction'] == 'Weekly' ? 'selected': ''): '' ?>>Weekly</option>
                                <option value="Daily" <?=isset($_GET['filter_transaction']) == TRUE ? ($_GET['filter_transaction'] == 'Daily' ? 'selected': ''): '' ?>>Daily</option>
                        </select>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-primary btn-sm">Filter</button>
                                </form>
                        </div>
                        </div>
                        <!-- end Drop down -->
                        <table id="transaction-table" class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Reciept No.</th>
                                    <th>Transaction Date</th>
                                    <th>Overall Amount</th>
                                    <th>Total Item</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Transaction Filter
                                if(isset($_GET['filter_transaction']) == TRUE && $_GET['filter_transaction'] != "") {
                                    $filter = mysqli_real_escape_string($sqlconn, $_GET['filter_transaction']);

                                    if($filter == "Monthly") {
                                        $transaction_query1 = "SELECT * FROM `transaction_db` 
                                        WHERE transaction_date >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01') 
                                        AND transaction_date <= LAST_DAY(CURRENT_DATE)
                                        ORDER BY `transaction_date` DESC";
                                        $result_transaction = mysqli_query($sqlconn, $transaction_query1);
                                    }
                                    elseif($filter == "Weekly") {
                                        $transaction_query1 = "SELECT * FROM `transaction_db` 
                                        WHERE transaction_date >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
                                        AND transaction_date < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 7 DAY)
                                        ORDER BY `transaction_date` DESC";
                                        $result_transaction = mysqli_query($sqlconn, $transaction_query1);
                                    }
                                    elseif($filter == "Daily") {
                                        $transaction_query1 = "SELECT * FROM `transaction_db` WHERE DATE(transaction_date) = CURDATE() ORDER BY `transaction_date` DESC";
                                        $result_transaction = mysqli_query($sqlconn, $transaction_query1);
                                    } 
                                }
                                else {
                                    $transaction_query1 = "SELECT * FROM `transaction_db` ORDER BY `transaction_date` DESC";
                                    $result_transaction = mysqli_query($sqlconn, $transaction_query1);
                                }

                                

                                while($t_row = mysqli_fetch_assoc($result_transaction)) {
                                ?>
                                <tr>
                                    <td><?= $t_row['reciept_no'] ?></td>
                                    <td><?= $t_row['transaction_date'] ?></td>
                                    <td><?= $t_row['overall_amount'] ?></td>
                                    <td><?= $t_row['total_item'] ?></td>
                                    <td><button class="btn btn-primary btn-sm view-data" data-itemrec="<?php echo $t_row['reciept_no'];?>" data-bs-toggle="modal" data-bs-target="#viewItems">View Items</button></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Transaction Report -->

            <!-- Slow Moving Table -->
            <div class="tab-pane fade" id="slow" role="tabpanel" aria-labelledby="slow-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Slow Moving Product</h5>
                        <!-- Drop down -->
                        <div class="d-flex justify-content-end bd-highlight">
                        <div class="p-2 bd-highlight">
                            <form action="" method="GET">
                        <select class="form-select mb-3 form-select-sm" name="filter_sm" id="dropdown-val" aria-label="Default select example">
                            <option selected value="">--Select Filter--</option>
                            <option value="Monthly"<?=isset($_GET['filter_sm']) == TRUE ? ($_GET['filter_sm'] == 'Monthly' ? 'selected': ''): '' ?>>Monthly</option>
                            <option value="Weekly" <?=isset($_GET['filter_sm']) == TRUE ? ($_GET['filter_sm'] == 'Weekly' ? 'selected': ''): '' ?>>Weekly</option>
                            <option value="Daily" <?=isset($_GET['filter_sm']) == TRUE ? ($_GET['filter_sm'] == 'Daily' ? 'selected': ''): '' ?>>Daily</option>
                        </select>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-primary btn-sm">Filter</button>
                                </form>
                        </div>
                        </div>
                        <!-- end Drop down -->
                        <table id="slow-table" class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item Barcode</th>
                                    <th>Item Name</th>
                                    <th>Total Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //filter slow moving
                            if(isset($_GET['filter_sm']) == TRUE && $_GET['filter_sm'] != "") {
                                $filter = mysqli_real_escape_string($sqlconn, $_GET['filter_sm']);

                                if($filter == "Monthly") {
                                    $query_fm = "SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
                                    FROM sales_db
                                    WHERE s_date >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01') -- First day of the current month
                                    AND s_date <= LAST_DAY(CURRENT_DATE) -- Last day of the current month
                                    GROUP BY s_item
                                    HAVING total_quantity_sold < $threshold";
                                    $result_fm = mysqli_query($sqlconn, $query_fm);
                                }
                                elseif($filter == "Weekly") {
                                    $query_fm = "SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
                                    FROM sales_db 
                                    WHERE s_date >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
                                    AND s_date < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 7 DAY)
                                    GROUP BY s_item
                                    HAVING total_quantity_sold < $threshold";
                                    $result_fm = mysqli_query($sqlconn, $query_fm);
                                }
                                elseif($filter == "Daily") {
                                    $query_fm = "SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
                                    FROM sales_db  
                                    WHERE DATE(s_date) = CURDATE() 
                                    GROUP BY s_item
                                    HAVING total_quantity_sold < $threshold";
                                    $result_fm = mysqli_query($sqlconn, $query_fm);
                                } 
                            }
                            else {
                                $query_fm = "SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
                                FROM sales_db
                                WHERE s_date >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01') -- First day of the current month
                                    AND s_date <= LAST_DAY(CURRENT_DATE) -- Last day of the current month
                                GROUP BY s_item
                                HAVING total_quantity_sold < $threshold";
                                
                                $result_fm = mysqli_query($sqlconn, $query_fm);
                            }


                                while($fm_rows = mysqli_fetch_assoc($result_fm)) {
                                ?>
                                <tr>
                                    <td><?= $fm_rows['s_sku'] ?></td>
                                    <td><?= $fm_rows['s_item'] ?></td>
                                    <td><?= $fm_rows['total_quantity_sold'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Slow Moving  -->

            <!-- Fast Moving Table -->
            <div class="tab-pane fade" id="fast" role="tabpanel" aria-labelledby="fast-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Fast Moving Product</h5>
                        <!-- Drop down -->
                        <div class="d-flex justify-content-end bd-highlight">
                         <div class="p-2 bd-highlight">
                            <form action="" method="GET">
                        <select class="form-select mb-3 form-select-sm" name="filter_fm" id="dropdown-val" aria-label="Default select example">
                            <option selected value="">--Select Filter--</option>
                            <option value="Monthly"<?=isset($_GET['filter_fm']) == TRUE ? ($_GET['filter_fm'] == 'Monthly' ? 'selected': ''): '' ?>>Monthly</option>
                            <option value="Weekly" <?=isset($_GET['filter_fm']) == TRUE ? ($_GET['filter_fm'] == 'Weekly' ? 'selected': ''): '' ?>>Weekly</option>
                            <option value="Daily" <?=isset($_GET['filter_fm']) == TRUE ? ($_GET['filter_fm'] == 'Daily' ? 'selected': ''): '' ?>>Daily</option>
                        </select>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-primary btn-sm">Filter</button>
                                </form>
                        </div>
                        </div>
                        <!-- end Drop down -->
                        <table id="fast-table" class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item Barcode</th>
                                    <th>Item Name</th>
                                    <th>Total Sold</th>
                                </tr>
                            </thead>
                            <tbody id="table-fm">
                                <!-- Table content here -->
                                <?php 
                                if(isset($_GET['filter_fm']) == TRUE && $_GET['filter_fm'] != "") {
                                    $filter = mysqli_real_escape_string($sqlconn, $_GET['filter_fm']);
    
                                    if($filter == "Monthly") {
                                        $query_fm = "SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
                                        FROM sales_db
                                        WHERE s_date >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01') -- First day of the current month
                                        AND s_date <= LAST_DAY(CURRENT_DATE) -- Last day of the current month
                                        GROUP BY s_item
                                        HAVING total_quantity_sold >= $threshold";
                                        $result_fm = mysqli_query($sqlconn, $query_fm);
                                    }
                                    elseif($filter == "Weekly") {
                                        $query_fm = "SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
                                        FROM sales_db 
                                        WHERE s_date >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
                                        AND s_date < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 7 DAY)
                                        GROUP BY s_item
                                        HAVING total_quantity_sold >= $threshold";
                                        $result_fm = mysqli_query($sqlconn, $query_fm);
                                    }
                                    elseif($filter == "Daily") {
                                        $query_fm = "SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
                                        FROM sales_db  
                                        WHERE DATE(s_date) = CURDATE() 
                                        GROUP BY s_item
                                        HAVING total_quantity_sold >= $threshold";
                                        $result_fm = mysqli_query($sqlconn, $query_fm);
                                    } 
                                }
                                else {
                                    $query_fm = "SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
                                    FROM sales_db
                                    WHERE s_date >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01') -- First day of the current month
                                        AND s_date <= LAST_DAY(CURRENT_DATE) -- Last day of the current month
                                    GROUP BY s_item
                                    HAVING total_quantity_sold >= $threshold";
                                    
                                    $result_fm = mysqli_query($sqlconn, $query_fm);
                                }


                                while($fm_rows = mysqli_fetch_assoc($result_fm)) {
                                ?>
                                <tr>
                                    <td><?= $fm_rows['s_sku'] ?></td>
                                    <td><?= $fm_rows['s_item'] ?></td>
                                    <td><?= $fm_rows['total_quantity_sold'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Fast Moving  -->


            <!-- Daily Closing Sales -->
            <div class="tab-pane fade" id="closing" role="tabpanel" aria-labelledby="close-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Daily Closing Sales</h5>
                        <table id="cls-sales" class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Cashier Name</th>
                                    <th>Number of Transaction</th>
                                    <th>Total Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $closing_report_query = "SELECT u.user_name as Name,
                                COALESCE(t.Transactions, 0) as Transactions,
                                COALESCE(s.TotalSales, 0) as TotalSales
                            FROM users__db u
                            LEFT JOIN (
                                SELECT acc_id, COUNT(reciept_no) as Transactions
                                FROM transaction_db
                                WHERE DATE(transaction_date) = CURDATE()
                                GROUP BY acc_id
                            ) t ON t.acc_id = u.acc_id
                            LEFT JOIN (
                                SELECT acc_id, ROUND(SUM(s_total), 2) as TotalSales
                                FROM sales_db
                                WHERE DATE(s_date) = CURDATE()
                                GROUP BY acc_id
                            ) s ON s.acc_id = u.acc_id
                            WHERE u.is_admin = 0  -- Selecting non-admin users
                            AND s.acc_id IS NOT NULL; -- Ensuring there are sales associated
                            ";

                                $close_query_result = $sqlconn->query($closing_report_query);

                                while($close_rows = $close_query_result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $close_rows['Name'] ?></td>
                                    <td><?= $close_rows['Transactions'] ?></td>
                                    <td><?= $close_rows['TotalSales'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- ...View Modal ... -->
     <div class="modal fade" id="viewItems">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h3 class="modal-title" id="disp-reciept"></h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="col-6 px-3 py-2">

                                <!-- Date Current -->
                                <div class="d-flex">
                                    <div class="p-2 w-50"><h5>Transaction Date:</h5></div>
                                                                    <!-- Display Date js-->
                                    <div class="p-2 flex-shrink-1"><h5 id="transDate"></h5></div>
                                </div>

                                <!-- Total -->
                                <div class="d-flex">
                                    <div class="p-2 w-50"><h5>Total</h5></div>
                                                                    <!-- Display Date js-->
                                    <div class="p-2 flex-shrink-1"><h5 id="transTot"></h5></div>
                                </div>

                                <div class="d-flex">
                                    <div class="p-2 w-50"><h5>Total Including VAT</h5></div>
                                                                    <!-- Display Date js-->
                                    <div class="p-2 flex-shrink-1"><h5 id="incl-vat"></h5></div>
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <!-- Total Including -->

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <!-- Table Content Display Goes Here -->
                                <div class="container-fluid px-4">
                                    <div class="table-responsive">
                                        <table class="table colorbox rounded shadow-sm table-hover" id="itemTable">
                                            <thead>
                                            <tr>
                                                <th scope="col">Barcode</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">QTY</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                        </tbody>
                                        </table>
                                    </div>

                                <!-- Modal Footer Goes here-->
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Print Recipt</button> -->
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- ...View Modal Ends Here... -->


        </div>
        </div>

        <!-- Modal goes here -->

        <!--Boostrap Layout-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Data table Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        
        <!-- JS Scripts that is created -->
        <script src="transact-view-item.js"></script>

        <script>
        //Table function by using databases boostrap5
        $(document).ready( function () {
            $('#sales-table').DataTable( {
                lengthChange: false
            });

            $('#invetoryr-table').DataTable( {
                lengthChange: false
            });

            $('#transaction-table').DataTable( {
                lengthChange: false
            });

            $('#slow-table').DataTable( {
                lengthChange: false
            });

            $('#fast-table').DataTable({
                lengthChange: false
            });
            $('#cls-sales').DataTable({
                lengthChange: false
            });
        });


</script>
        <script>
        //Element Menu Toggle
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
    
        //Sidebar Toggle
        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };


        //Tab Active function
        document.addEventListener('DOMContentLoaded', function () {
            var storageKey = 'activeTabSet3';

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
    header("Location: /JunCathyPOSInventory/login_form.php");
    exit();
}


?>
</html>