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
    $threshold_query = "SELECT `threshold` FROM `setting_db`";
    $threshold_query_result = mysqli_query($sqlconn, $threshold_query);

    if($rows = mysqli_fetch_assoc($threshold_query_result)) {
        $threshold = $rows['threshold'];
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

    <div class="container-fluid px-3">
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
    <div class="container mt-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <!-- Navigation Menu -->
            <li class="nav-item" role="presentation">
                <a class="nav-link " href="?tb=1" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab" aria-controls="sales" aria-selected="true">
                    <i class="fas fa-chart-line"></i> Sales Report
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="?tb=2" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab" aria-controls="inventory" aria-selected="false">
                    <i class="fas fa-box"></i> Inventory Report
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="?tb=3" id="trackrecord-tab" data-bs-toggle="tab" data-bs-target="#trackrecord" type="button" role="tab" aria-controls="trackrecord" aria-selected="false">
                    <i class="fas fa-list-alt"></i> Transaction Record
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="?tb=4" id="slow-tab" data-bs-toggle="tab" data-bs-target="#slow" type="button" role="tab" aria-controls="slow" aria-selected="false">
                    <i class="fas fa-arrow-down"></i> Slow Moving
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="?tb=5" id="fast-tab" data-bs-toggle="tab" data-bs-target="#fast" type="button" role="tab" aria-controls="fast" aria-selected="false">
                    <i class="fas fa-arrow-up"></i> Fast Moving
                </a>
            </li>
        </ul>

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
                        <table id="sales-table" class="table bg-light rounded shadow-sm table-hover">
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
                        <select class="form-select mb-3 form-select-sm" id="dropdown-val" aria-label="Default select example">
                            <option selected value="">--Select Filter--</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Daily">Daily</option>
                        </select>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-primary btn-sm">Filter</button>
                        </div>
                        </div>
                        <!-- end Drop down -->
                        <table id="invetoryr-table" class="table bg-light rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item No.</th>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table content here -->
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
                        <table id="transaction-table" class="table bg-light rounded shadow-sm table-hover">
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
                        <table id="slow-table" class="table bg-light rounded shadow-sm table-hover">
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
                        <table id="fast-table" class="table bg-light rounded shadow-sm table-hover">
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
                                <div class="dropdown-divider"></div>
                            </div>

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
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Print Recipt</button>
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
        });


</script>
        <script>
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");
    
            toggleButton.onclick = function () {
                el.classList.toggle("toggled");
            };

            document.addEventListener('DOMContentLoaded', function () {
            // Retrieve the last active tab from sessionStorage
            var lastActiveTab = sessionStorage.getItem('activeTab');
    
            // If no last active tab is found, default to the "Sales Report" tab (tab number 1)
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
                    sessionStorage.setItem('activeTab', tabNumber);
                });
            });
        });
    
    
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