<?php
include "../connectdb.php";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
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


     //get page number on sales report
    if (isset($_GET['page_no']) && $_GET['page_no'] !== "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }
    $total_records_per_page = 10;
    $offset = ($page_no -1) * $total_records_per_page;
    $previous_page = $page_no -1;
    $next_page = $page_no + 1;
    
    $result_count = mysqli_query($sqlconn, "SELECT COUNT(*) as total_records FROM sales_db");
    $records = mysqli_fetch_array($result_count);
    $total_records = $records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);


    // //get page number on inventory report
    // if (isset($_GET['page_num']) && $_GET['page_num'] !== "") {
    //     $page_num = $_GET['page_num'];
    // } else {
    //     $page_num = 1;
    // }

    // $total_record_per_page = 10;
    // $offsets = ($page_num -1) * $total_record_per_page;
    // $previouss_page = $page_num -1;
    // $nexts_page = $page_num + 1;
    
    // $results_count = mysqli_query($sqlconn,"SELECT COUNT(*) as total_record FROM vendors_db");
    // $recordss = mysqli_fetch_array($results_count);
    // $total_record = $recordss['total_record'];
    // $total_no_of_page = ceil($total_record / $total_record_per_page);


    // //get page number on transaction report
    // if (isset($_GET['page_s']) && $_GET['page_s'] !== "") {
    //     $page_s = $_GET["page_s"];
    // } else {
    //     $page_s = 1;
    // }
    
    // $totals_record_per_page = 10;
    // $offsetp = ($page_s - 1) * $totals_record_per_page;
    // $previous_pages = $page_s - 1;
    // $next_pages = $page_s + 1;
    
    // $pagination_query = "SELECT COUNT(*) AS totals_record FROM vendors_db JOIN purchase_order_db ON vendors_db.vendor_id = purchase_order_db.vendor_id WHERE is_delivered = 1";
    // $result_counts = mysqli_query($sqlconn, $pagination_query);
    // $record = mysqli_fetch_array($result_counts);
    // $totals_record = $record['totals_record'];
    // $totals_no_of_page = ceil($totals_record / $totals_record_per_page);

    // //get page number on slow moving
    // if (isset($_GET['page_sl']) && $_GET['page_sl'] !== "") {
    //     $page_sl = $_GET["page_sl"];
    // } else {
    //     $page_sl = 1;
    // }
    
    // $total_record_per_pagel = 10;
    // $offsetl = ($page_sl - 1) * $totals_record_per_pagel;
    // $previous_pagesl = $page_sl - 1;
    // $next_pagesl = $page_sl + 1;
    
    // $pagination_queryl = "SELECT COUNT(*) AS totals_record FROM vendors_db JOIN purchase_order_db ON vendors_db.vendor_id = purchase_order_db.vendor_id WHERE is_delivered = 1";
    // $result_countsl = mysqli_query($sqlconn, $pagination_query);
    // $recordl = mysqli_fetch_array($result_countsl);
    // $totalsl_record = $recordl['totalsl_record'];
    // $totals_no_of_pagel = ceil($totalsl_record / $totals_record_per_pagel);

    //get page number on fast moving
    if (isset($_GET['page_sf']) && $_GET['page_sf'] !== "") {
        $page_sf = $_GET["page_sf"];
    } else {
        $page_sf = 1;
    }
    
    $totals_record_per_pagef = 10;
    $offsetf = ($page_sf -1) * $totals_record_per_pagef;
    $previous_pagesf = $page_sf -1;
    $next_pagesf = $page_sf + 1;
    
    $pagination_queryf = "SELECT COUNT(*) AS totalsf_record FROM (
        SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
        FROM sales_db
        WHERE s_date >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01')
            AND s_date <= LAST_DAY(CURRENT_DATE)
        GROUP BY s_item
        HAVING SUM(s_qty) >= $threshold
    ) AS subquery";
    $result_countsf = mysqli_query($sqlconn, $pagination_queryf);
    $recordf = mysqli_fetch_array($result_countsf);
    $totalsf_record = $recordf['totalsf_record'];
    $totals_no_of_pagef = ceil($totalsf_record / $totals_record_per_pagef);


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
                        <table class="table bg-light rounded shadow-sm table-hover">
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
                                $sales_query1 = "SELECT * FROM `sales_db` ORDER BY `s_date` DESC LIMIT $offset , $total_records_per_page";
                                $result_sales_query = mysqli_query($sqlconn, $sales_query1);

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

                                <!-- Pagination -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">       
                                        <a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?>"<?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : ''; ?> tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>

                                        <?php for ($counter = 1; $counter <= $total_no_of_pages; $counter++)
                                        {?>
                                        <li class="page-item"><a class="page-link" href="?page_no= <?php echo $counter; ?>"><?php echo $counter; ?></a></li>
                                        <?php } ?>
                            

                                        <a class="page-link <?= ($page_no >= $total_no_of_pages)? 'disabled' : '';?>" <?= ($page_no < $total_no_of_pages)? 'href=?page_no=' . $next_page: '';?>>Next</a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="p-10">
                                    <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?></strong>
                                </div> 

                    </div>
                </div>
            </div>
            <!-- End Sales Report -->

            <!-- Inventory Report -->
            <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Inventory Report</h5>
                        <table class="table bg-light rounded shadow-sm table-hover">
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

                                <!-- Pagination -->
                                <!-- <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">       
                                        <a class="page-link <?= ($page_num <= 1) ? 'disabled' : ''; ?>"<?= ($page_num > 1) ? 'href=?page_num=' . $previouss_page : ''; ?> tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>

                                        <?php for ($counters = 1; $counters <= $total_no_of_page; $counters++)
                                        {?>
                                        <li class="page-item"><a class="page-link" href="?page_num= <?php echo $counters; ?>"><?php echo $counters; ?></a></li>
                                        <?php } ?>

                                        <a class="page-link <?= ($page_num >= $total_no_of_page)? 'disabled' : '';?>" <?= ($page_num < $total_no_of_page)? 'href=?page_num=' . $nexts_page: '';?>>Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            <div class="p-10">
                                <strong>Page <?= $page_num; ?> of <?= $total_no_of_page; ?></strong>
                            </div>  -->

                    </div>
                </div>
            </div>
            <!-- End Inventory Report -->


            <!-- Transaction Record -->
            <div class="tab-pane fade" id="trackrecord" role="tabpanel" aria-labelledby="trackrecord-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Transaction Record</h5>
                        <table class="table bg-light rounded shadow-sm table-hover">
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

                                    <!-- Pagination -->
                                    <!-- <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item">       
                                            <a class="page-link <?= ($page_s <= 1) ? 'disabled' : ''; ?>"<?= ($page_s > 1) ? 'href=?page_s=' . $previous_pages : ''; ?> tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>

                                            <?php for ($counterss = 1; $counterss <= $totals_no_of_page; $counterss++)
                                            {?>
                                            <li class="page-item"><a class="page-link" href="?page_s=<?php echo $counterss; ?>"><?php echo $counterss; ?></a></li>
                                            <?php } ?>

                                            <a class="page-link <?= ($page_s >= $totals_no_of_page)? 'disabled' : '';?>" <?= ($page_s < $totals_no_of_page)? 'href=?page_s=' . $next_pages: '';?>>Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                <div class="p-10">
                                    <strong>Page <?= $page_s; ?> of <?= $totals_no_of_page; ?></strong>
                                </div> -->

                    </div>
                </div>
            </div>
            <!-- End Transaction Report -->

            <!-- Slow Moving Table -->
            <div class="tab-pane fade" id="slow" role="tabpanel" aria-labelledby="slow-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Slow Moving Product</h5>
                        <table class="table bg-light rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item Barcode</th>
                                    <th>Item Name</th>
                                    <th>Total Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table content here -->
                            </tbody>
                        </table>

                                    <!-- Pagination -->
                                    <!-- <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item">       
                                            <a class="page-link <?= ($page_sl <= 1) ? 'disabled' : ''; ?>"<?= ($page_sl > 1) ? 'href=?page_s=' . $previous_pagesl : ''; ?> tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>

                                            <?php for ($counterl = 1; $counterl <= $totals_no_of_pagel; $counterl++)
                                            {?>
                                            <li class="page-item"><a class="page-link" href="?page_sl=<?php echo $counterl; ?>"><?php echo $counterl; ?></a></li>
                                            <?php } ?>

                                            <a class="page-link <?= ($page_sl >= $totals_no_of_pagel)? 'disabled' : '';?>" <?= ($page_s < $totals_no_of_pagel)? 'href=?page_sl=' . $next_pagesl: '';?>>Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                <div class="p-10">
                                    <strong>Page <?= $page_sl; ?> of <?= $totals_no_of_pagel; ?></strong>
                                </div> -->
                                
                    </div>
                </div>
            </div>
            <!-- End Slow Moving  -->

            <!-- Fast Moving Table -->
            <div class="tab-pane fade" id="fast" role="tabpanel" aria-labelledby="fast-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Fast Moving Product</h5>
                        <table class="table bg-light rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item Barcode</th>
                                    <th>Item Name</th>
                                    <th>Total Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table content here -->
                                <?php 
                                $query_fm = "SELECT s_sku, s_item, SUM(s_qty) AS total_quantity_sold
                                FROM sales_db
                                WHERE s_date >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01') -- First day of the current month
                                    AND s_date <= LAST_DAY(CURRENT_DATE) -- Last day of the current month
                                GROUP BY s_item
                                HAVING total_quantity_sold >= $threshold
                                LIMIT $offsetf, $totals_record_per_pagef";
                                
                                $result_fm = mysqli_query($sqlconn, $query_fm);


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

                                    <!-- Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item">       
                                            <a class="page-link <?= ($page_sf <= 1) ? 'disabled' : ''; ?>"<?= ($page_sf > 1) ? 'href=?page_sf=' . $previous_pagesf : ''; ?> tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>

                                            <?php for ($countersf = 1; $countersf <= $totals_no_of_pagef; $countersf++)
                                            {?>
                                            <li class="page-item"><a class="page-link" href="?page_sf=<?php echo $countersf; ?>"><?php echo $countersf; ?></a></li>
                                            <?php } ?>

                                            <a class="page-link <?= ($page_sf >= $totals_no_of_pagef)? 'disabled' : '';?>" <?= ($page_sf < $totals_no_of_pagef)? 'href=?page_sf=' . $next_pagesf: '';?>>Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                <div class="p-10">
                                    <strong>Page <?= $page_sf; ?> of <?= $totals_no_of_pagef; ?></strong>
                                </div>
                    </div>
                </div>
            </div>
            <!-- End Fast Moving  -->

        </div>
    </div>


        </div>
        </div>

        <!-- Modal goes here -->


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
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
                lastActiveTab = null;
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