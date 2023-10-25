<!DOCTYPE html>
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
        <title>Purchase Maintenance</title>
    </head>
    <!--Style inside main Page -->
    <style>
        .search-bar {
           order: 2;
           width: 200px;
       }

       .adjustments {
        width: 65px;
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
                <h2 class="fs-2 m-0">Purchase Maintenance</h2>
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
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        </nav>


    <!--Tab button--->

    <div class="container-fluid mt-4 px-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <!-- Navigation Menu -->
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab" aria-controls="sales" aria-selected="true">
                    <i class="fas fa-shopping-cart"></i> Purchase Order
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab" aria-controls="inventory" aria-selected="false">
                    <i class="fas fa-building"></i> Vendors
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">
                    <i class="fas fa-truck"></i> Delivery In
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="badorder-tab" data-bs-toggle="tab" data-bs-target="#badorder" type="button" role="tab" aria-controls="badorder" aria-selected="false">
                    <i class="fas fa-exclamation-circle"></i> Bad Order
                </a>
            </li>
        </ul>

        <!-- Tab-Content here -->

                <!-- Purchase Order -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                        <div class="card">
                            <div class="card-body colorbox">
                                <h5 class="card-title">Purchase Order</h5>
                                <!--Drop down Button Purchase Order-->
                                <div class="d-flex justify-content-between rounded">
                                    <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#purchase1">
                                        Add Order
                                    </button>
                                    <!-- Search Bar-->
                                    <input type="text" class="form-control search-bar" placeholder="Search">
                                </div><br>
                                <!--Table-->
                                <table class="table bg-light rounded shadow-sm table-hover">
                                    <thead>
                                        <tr>
                                            <!-- Table content here -->
                                            <th>Vendor Name</th>
                                            <th>Action</th>
                                            <th>Mark as</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = " SELECT
                                            vendors_db.vendor_id,
                                            vendors_db.vendor_name as Vendor,
                                            purchase_order_db.vendor_id as item_vendorID
                                        FROM vendors_db
                                        JOIN purchase_order_db ON vendors_db.vendor_id = purchase_order_db.vendor_id";
                    
                                        $results = mysqli_query($sqlconn, $query);
                                        $previous = null;
                                        $unique_identifier = 0;
                                        
                                        while ($rows = mysqli_fetch_assoc($results)) {
                                        ?>
                                        <tr>
                                            <?php if($rows['Vendor'] != $previous) { ?>
                                            <td><?php echo $rows['Vendor']; 
                                            $previous = $rows['Vendor'];
                                            ?></td>
                                            <td>
                                                <button title="<?php echo $rows['item_vendorID']; ?>" class="btn btn-primary btn-sm view-data" data-itemid="<?php echo $rows['item_vendorID'];?>" data-bs-toggle="modal" data-bs-target="#viewModal">View Items</button>
                                                <a href="delete_po.php?vendorid=<?php echo $rows['item_vendorID'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                            <td>
                                            <button class="btn btn-primary btn-sm delivered-rbtn" id="delivered_label" value="Delivered" name="dob_<?php echo $rows['item_vendorID']; ?>" data-itemid="<?php echo $rows['item_vendorID']; ?>">Delivered</button>
                                            <button class="btn btn-danger btn-sm badorder-rbtn" id="badorder_label" value="badOrder" name="dob_<?php echo $rows['item_vendorID']; ?>" data-itemid="<?php echo $rows['item_vendorID']; ?>">Bad Order</button>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
        
                                        <!-- Pagination Next Tables-->
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                                            <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                            </li>
                                             </ul>
                                        </nav>
                            </div>
                        </div>
                    </div>
        
                    <!-- Vendors -->
                    <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                        <div class="card">
                            <div class="card-body colorbox">
                                <h5 class="card-title">Vendors</h5>
                                <!--Dropdown Button For Vendors-->
                                <div class="d-flex justify-content-between rounded">
                                    <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#vendor1">
                                        Add Vendor
                                    </button>
                                      <!-- Search Bar-->
                                    <input type="text" class="form-control search-bar" placeholder="Search">
                                </div><br>
                                <!-- Missing bs form data-bs-dimiss this should work now "if you read this remove comment"-->
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <!--Table-->
                                <table class="table bg-light rounded shadow-sm table-hover">
                                    <thead>
                                        <tr>
                                            <!-- Table content here -->
                                            <th>Vendor ID</th>
                                            <th>Vendor Name</th>
                                            <th>Contact No.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php  
                                    $sql_query = "SELECT * FROM vendors_db";
                                    $sql_res = mysqli_query($sqlconn, $sql_query);

                                    while($array = mysqli_fetch_array($sql_res)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $array['vendor_id'] ?></td>
                                            <td><?php echo $array['vendor_name'] ?></td>
                                            <td><?php echo $array['vendor_contact'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm edit-vendor-btn" data-bs-toggle="modal" data-bs-target="#edit-vendor"><i class="fas fa-edit"></i></button>
                                                <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
        
                                        <!-- Pagination Next Tables-->
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                                            <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                            </li>
                                             </ul>
                                        </nav>
                            </div>
                        </div>
                    </div>
        
                    <!-- Delivery In -->
                    <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                        <div class="card">
                            <div class="card-body colorbox">
                                <h5 class="card-title">Delivery In</h5>
                                <!-- Button for Add item-->
                                <div class="d-flex justify-content-end mt-2">
                                    <!-- Search Bar-->
                                    <input type="text" class="form-control search-bar" style="height: 49px; max-width: 300px;"" placeholder="Search">
                                </div><br>
                                <!--Table-->
                                <table class="table bg-light rounded shadow-sm table-hover">
                                    <thead>
                                        <tr>
                                            <!-- Table content here -->
                                            <th>Vendor Name</th>                                          
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query_deliveryin = "SELECT
                                            vendors_db.vendor_id,
                                            vendors_db.vendor_name as Vendor
                                        FROM vendors_db
                                        JOIN purchase_order_db ON vendors_db.vendor_id = purchase_order_db.vendor_id
                                        WHERE purchase_order_db.is_delivered = 1 AND purchase_order_db.isBadOrder = 0";
                                        
                                        $results_deliveryin = mysqli_query($sqlconn, $query_deliveryin);
                                        $previous_deliverIn = null;
                                        
                                        while ($rows_deliveryin = mysqli_fetch_assoc($results_deliveryin)) {
                                        
                                        ?>
                                        <tr>
                                        <?php if($rows_deliveryin['Vendor'] != $previous_deliverIn) { ?>
                                            <td><?php echo $rows_deliveryin['Vendor']; 
                                            $previous_deliverIn = $rows_deliveryin['Vendor'];
                                            ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm">View Data</button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    <?php  } ?>
                                    </tbody>
                                </table>
        
                                    <!-- Pagination Next Tables-->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center">
                                                <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                        </li>
                                        </ul>
                                    </nav>
                                </div>             
                            </div>
                        </div>

                    <!--Bad Order -->
                    <div class="tab-pane fade" id="badorder" role="tabpanel" aria-labelledby="badorder-tab">
                        <div class="card">
                            <div class="card-body colorbox">
                                <h5 class="card-title">Bad Order</h5>
                                <!-- Button for Add item-->
                                <div class="d-flex justify-content-end mt-2">
                                    <!-- Search Bar-->
                                    <input type="text" class="form-control search-bar" style="height: 49px; max-width: 300px;"" placeholder="Search">
                                </div><br>
                                <!--Table-->
                                <table class="table bg-light rounded shadow-sm table-hover">
                                    <thead>
                                        <tr>
                                            <!-- Table content here -->
                                            <th>Vendor Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query_badorder = "SELECT
                                            vendors_db.vendor_id,
                                            vendors_db.vendor_name as Vendor
                                        FROM vendors_db
                                        JOIN purchase_order_db ON vendors_db.vendor_id = purchase_order_db.vendor_id
                                        WHERE purchase_order_db.is_delivered = 0 AND purchase_order_db.isBadOrder = 1";
                                        
                                        $results_badorder = mysqli_query($sqlconn, $query_badorder);
                                        $previous_badorder = null;
                                        
                                        while ($rows_badorder = mysqli_fetch_assoc($results_badorder)) {
                                        
                                        ?>
                                        <tr>
                                        <?php if($rows_badorder['Vendor'] != $previous_badorder) { ?>
                                            <td><?php echo $rows_badorder['Vendor']; 
                                            $previous_badorder = $rows_badorder['Vendor'];
                                            ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm">View Data</button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    <?php  } ?>
                                    </tbody>
                                </table>
        
                                    <!-- Pagination Next Tables-->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center">
                                                <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                        </li>
                                        </ul>
                                    </nav>
                                </div>             
                            </div>
                        </div>

                    </div>
                </div>
                
                <!--End of Tab-Content-->
        <!-- End of Page Content -->
        </div>
    </div>

    
    <!-- ...Purchase Order Modal... -->

                <!-- Purchase Modal-->
                <div class="modal fade" id="purchase1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h3 class="modal-title">Purchase Order</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                            <!-- Your Purchase content goes here -->
                            <div class="container-fluid px-1">
                            <form method="POST" id="formList">
                                <div class="mb-4">
                                    <!-- Label and Textbox -->
                                    <label for="vendorID" class="form-label">Vendor ID</label>
                                    <input type="number" class="form-control" id="vendorID" name="vendorId" required>
                                    <div class="list-group" id="showlist_vendorid" style="position: absolute; z-index: 1; width: 30%;">

                                    </div>
                                    <label for="vendorNAME" class="form-label">Vendor Name</label>
                                    <input type="text" class="form-control" id="vendorNAME" name="vendorName" disabled>
                                    <label for="dateTransaction" class="form-label">Date of Transaction</label>
                                    <input type="date" class="form-control" id="dateTransaction" name="dateTrans" required>
                                    <label for="expectedDelivery" class="form-label">Expected Delivery</label>
                                    <input type="date" class="form-control" id="expectedDelivery" name="expectDel" required><br>
                                </div>

                                <!-- Table for Items-->
                                <div class="row my-1">
                                    <h3 class="fs-4 mb-3">Items</h3>
                                    <div class="col">
                                        <table class="table colorbox rounded shadow-sm  table-hover" id="addPurchaseItems">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Item Name</th>
                                                    <th scope="col">QTY</th>
                                                    <th scope="col">UOM</th>
                                                    <th scope="col">Category</th>
                                                    <th>Add Row</th>
                                                </tr>
                                            </thead>
                                            <tbody class="show_items">
                                                <tr>
                                                    <!--Table Content-->
                                                    <th><input type="text" class="form-control" name="PO_itemname[]" required></th>
                                                    <th><input type="number" class="form-control adjustments"  name="PO_qty[]" required></th>
                                                    <th>            
                                                    <select class="form-select" name="PO_uom[]">
                                                    <?php  
                                                         $sql_query = "SELECT * FROM uom_db";
                                                        $sql_res = mysqli_query($sqlconn, $sql_query);

                                                        while($array = mysqli_fetch_array($sql_res)) {
                                                    ?>
                                                        <option value="<?php echo $array['uom_name']; ?>"> <?php echo $array['uom_name']; ?> </option>
                                                    <?php 
                                                        }
                                                    ?>
                                                    </select></th>
                                                    <th>            
                                                    <select class="form-select" name="PO_category[]">
                                                    <?php  
                                                        $sql_query1 = "SELECT * FROM category_db";
                                                        $sql_res1 = mysqli_query($sqlconn, $sql_query1);

                                                        while($array1 = mysqli_fetch_array($sql_res1)) {
                                                        ?>
                                                        <option value="<?php echo $array1['category_name']; ?>"><?php echo $array1['category_name']; ?></option>
                                                    <?php 
                                                        }
                                                    ?>
                                                        <!-- Many Brands -->
                                                    </select></th>
                                                    <!--Added Input -->
                                                    <td><button class="btn btn-primary btn-sm btn-secondary" id="addInput" type="button"><i class="far fa-plus-circle"></i>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
    
                            <!-- ... Rest of your Purchase content ... -->
                        </div>
                            <!-- Modal Footer Goes here-->
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Add" id="addBtn">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                              </form>
                        </div>
                        </div>
                    </div>
                </div>

    <!-- ...Purchase Modal Ends Here... -->


        <!-- ...View Modal ... -->
                <div class="modal fade" id="viewModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h3 class="modal-title" id="dispVendorName"></h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="col-6 px-3 py-2">

                                <!-- Date Current -->
                                <div class="d-flex">
                                    <div class="p-2 w-50"><h5>Date:</h5></div>
                                                                    <!-- Display Date js-->
                                    <div class="p-2 flex-shrink-1"><h5 id="currentDate"></h5></div>
                                </div>
                                <div class="dropdown-divider"></div>

                                <!-- Date Delivery Expected -->
                                <div class="d-flex">
                                    <div class="p-2 w-50"><h5>Date Expected:</h5></div>
                                                                    <!-- Display Date js-->
                                    <div class="p-2 flex-shrink-1"><h5 id="expectedDate"></h5></div>
                                </div>
                                     

                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <!-- Table Content Display Goes Here -->
                                <div class="container-fluid px-4">
                                    <div class="table-responsive">
                                        <table class="table colorbox rounded shadow-sm table-hover" id="itemTable">
                                            <thead>
                                            <tr>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">QTY</th>
                                                <th scope="col">UOM</th>
                                                <th scope="col">Category</th>
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


    <!-- ...Vendors Modal... -->

                <!-- Vendor Modal-->
                <div class="modal fade" id="vendor1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h3 class="modal-title">Add Vendor</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                            <!-- Your Vendor1 content goes here -->
                            <form action="addvendor.php" method="post">
                            <div class="container-fluid px-1">
                                <div class="mb-4">
                                    <!-- Label and Textbox -->
                                    <label for="itemnameInput" class="form-label">Vendor ID</label>
                                    <input type="number" name="vendorId" class="form-control" id="itemnameInput" required>
                                    <label for="skuInput" class="form-label">Vendor Name</label>
                                    <input type="text" name="vendorName" class="form-control" id="skuInput" required>
                                    <label for="itemnameInput" class="form-label">Contact Number</label>
                                    <input type="number" class="form-control" name="vendorContact" id="itemnameInput" required>
                                </div>
    
                            <!-- ... Rest of your Vendor1 content ... -->
                        </div>
                            <!-- Modal Footer Goes here-->
                            <div class="modal-footer">
                                <button class="btn btn-primary">Add</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        </div>
                    </div>
                </div>

    <!-- ...Vendors Modal Ends Here... -->


    <!-- ...Edit Vendors Modal... -->

                <!-- Vendor Modal-->
                <div class="modal fade" id="edit-vendor">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Vendor</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                            <!-- Your Vendor1 content goes here -->
                            <div class="container-fluid px-1">
                                <div class="mb-4">
                                <form action="update-vendor.php" method="post">
                                    <!-- Label and Textbox -->
                                    <input type="hidden" name="uvendorId" class="form-control" id="update-vendor-id">
                                    <label for="skuInput" class="form-label">Vendor Name</label>
                                    <input type="text" name="uvendorName" class="form-control" id="update-vendor-name" required>
                                    <label for="itemnameInput" class="form-label">Contact Number</label>
                                    <input type="number" class="form-control" name="uvendorContact" id="update-vendor-contact" required>
                                </div>
    
                            <!-- ... Rest of your Vendor1 content ... -->
                        </div>
                            <!-- Modal Footer Goes here-->
                            <div class="modal-footer">
                                <button class="btn btn-primary">Update</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        </div>
                    </div>
                </div>

    <!-- ... Edit Vendors Modal Ends Here... -->



 <!-- confirmation Modal here -->
        <div class="modal fade" tabindex="-1" role="dialog" id="confirmation_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" id="close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to mark as <span></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirmation_yes" class="btn btn-primary">Yes</button>
                        <button type="button" id="confirmation_no" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
<!-- ends here -->









        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="cloneInputs.js"></script>
    <script src="autocomplete.js"></script>
    <script src="radioBtn-function.js"></script>
    <script src="po-view-item.js"></script>
    <script src="update-vendor.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        
    </script>
<?php } ?>
</body>
</html>