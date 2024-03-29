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
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../styles.css" />
        <!-- data tables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
        <style>
        </style>


        <title>Inventory</title>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 navadjust">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left fs-4 me-3 " id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Inventory</h2>
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
                    <li><a class="dropdown-item" href="../Settings/Settings.php">Setting</a></li>
                    <li><a class="dropdown-item" href="../logout.php">Log-out</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </nav>

    <!-- Inventory -->

    <!-- Add Item -->
    <div class="container-fuild mt-3 px-4">
                <div class="card">
                    <div class="card-body colorbox">
                        <div class="d-flex justify-content-between rounded mb-4">
                            <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">
                                Add item
                            </button>
                        </div>
                    <!-- Table Content -->
                        <table id="inv-table" class="table bg-white rounded shadow-sm table-hover w-100">
                            <thead>
                                <tr>
                                    <th scope="col" style="display: none;"></th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Stocks</th>
                                    <th scope="col">Exp.Date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Category</th>
                                    <th style="display: none;" scope="col">sales</th>
                                    <th style="display: none;" scope="col">stable</th>
                                    <th style="display: none;" scope="col">average</th>
                                    <th style="display: none;" scope="col">reorder</th>
                                    <th style="display: none;" scope="col">critical</th>
                                    <th scope="col">Action</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $show_items_query = "SELECT * FROM items_db";
                        $show_result = mysqli_query($sqlconn, $show_items_query);

                        while($show_rows = mysqli_fetch_array($show_result)) {
                            // Calculate the difference between the expiration date and the current date
                            $expdate_nString = $show_rows['item_expdate'];
                            $expDate = strtotime($show_rows['item_expdate']);
                            $currentDate = time();
                            $dateDifference = $expDate - $currentDate;

                            // Determine the row class based on the date difference
                            $rowClass = '';
                        if($expdate_nString != '0000-00-00') {
                            if ($dateDifference < 0) {
                                $rowClass = 'expired'; // Expired
                            }elseif ($dateDifference < 2592000) {  //a month before notifying
                                $rowClass = 'close-to-expiration'; // Close to expiration
                            }
                        }
                        ?>
                        <tr class="<?= $rowClass?>">
                            <td style="display: none;"><?php echo $show_rows['id'] ?></td>
                            <td><?= $show_rows['item_sku'] ?></td>
                            <td><?php echo $show_rows['item_barcode'] ?></td>
                            <td><?php echo $show_rows['item_name'] ?></td>
                            <td><?php echo $show_rows['item_stocks'] ?></td>
                                <?php if($expdate_nString == '0000-00-00') { ?>
                                    <td>N/A</td>
                                <?php }
                                else {
                                ?>
                                    <td><?php echo $show_rows['item_expdate'] ?></td>
                                <?php } ?>
                            <td><?php echo $show_rows['item_price'] ?></td>
                            <td><?php echo $show_rows['item_category'] ?></td>
                            <td style="display: none;"><?php echo $show_rows['sales'] ?></td>
                            <td style="display: none;"><?php echo $show_rows['stable'] ?></td>
                            <td style="display: none;"><?php echo $show_rows['average'] ?></td>
                            <td style="display: none;"><?php echo $show_rows['reorder'] ?></td>
                            <td style="display: none;"><?php echo $show_rows['critical'] ?></td>
                            <!--Button Edit / Remove-->
                            <td><button type="button" class="btn btn-secondary btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                                <a class="btn btn-primary btn-sm btn-danger" href="delete_items.php?id=<?php echo $show_rows['id']?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>

</div>
</div>

    
<!-- Add Item Modal-->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Add Item</h5>
                <button type="button" class="btn-close" id="closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Start Modal Body-->
            <div class="modal-body">
                <div class="container">
                    <div class="row g-2">
                        <!-- Left side column -->
                        <div class="col-6">
                            <div class="p-3">
                                <form action="add_items.php" method="post" autocomplete="off">
                                <!-- Label and Textbox -->
                                <label for="skuInput" class="form-label">SKU</label>
                                <div class="d-flex flex-row">
                                    <input type="text" name="modal_sku" class="form-control me-1" id="skuInput" required readonly>
                                    <input type="button" id="generate" value="Generate SKU" class="btn btn-secondary btn-sm">
                                </div>
                                <label for="skuInput" class="form-label">Barcode</label>
                                <input type="number" name="modal_barcode" class="form-control" id="barcodeInput" required>
                                <label for="itemnameInput" class="form-label">Item Name</label>
                                <input type="text" name="modal_itemname" class="form-control" id="itemnameInput" required>
                                <!-- Auto complete items -->
                                <div class="list-group" id="showlist_skuitems" style="position: absolute; z-index: 1; width: 70%;">
                                        
                                </div>
                                <!-- End of auto complete items -->
                                <label for="stocksInput" class="form-label">Stocks</label>
                                <input type="number" name="modal_stocks" class="form-control" id="stocksInput" required>
                                <label for="expdateInput" class="form-label">Exp. Date</label>
                                <input type="date" name="modal_date" class="form-control" id="expdateInput">
                                <label for="cpriceInput" class="form-label">Mark Up %</label>
                                <input style="margin: 0;" type="number" name="modal_markup" class="form-control" id="mark-up">
                                <label for="cpriceInput" class="form-label">Selling Price</label>
                                <input style="margin: 0;" type="number" name="modal_cp" class="form-control" step=".01" id="cpriceInput" required>
                                <label for="priceInput" class="form-label">Total Price</label>
                                <input style="margin: 0;" type="number" name="modal_price" class="form-control" id="priceInput" step=".01" readonly><br>

                                <!-- Selecting Category -->
                                <div class="input-group mb-4">
                                    <label class="input-group-text colorbox" for="category">Category</label>
                                    <select class="form-select" id="add_category" name="category">

                                    <!-- PHP Looping for fetching uom's for the dropdown list -->
                                    <?php  
                                            $sql_query1 = "SELECT * FROM category_db";
                                            $sql_res1 = mysqli_query($sqlconn, $sql_query1);

                                            while($array1 = mysqli_fetch_array($sql_res1)) {
                                        ?>
                                            <option value="<?php echo $array1['category_name']; ?>"><?php echo $array1['category_name']; ?></option>
                                        <?php 
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End left side column -->
                            
                            <!-- Right side column -->
                            <div class="col-6">
                                <div class="p-3">
                                    <!-- Label and Textbox -->
                                    <label for="sales_threshold" class="form-label">Sales Threshold</label>
                                    <input type="number" name="sales" class="form-control" id="sales_threshold" required>
                                    <label for="stable_threshold" class="form-label">Stable Threshold</label>
                                    <input type="number" name="stable" class="form-control" id="stable_threshold" required>
                                    <label for="average_threshold" class="form-label">Average Threshold</label>
                                    <input type="number" name="average" class="form-control" id="average_threshold" required>
                                    <label for="reorder_threshold" class="form-label">Reorder Threshold</label>
                                    <input type="number" name="reorder" class="form-control" id="reorder_threshold" required>
                                    <label for="critical_threshold" class="form-label">Critical Threshold</label>
                                    <input type="number" name="critical" class="form-control" id="critical_threshold" required><br>
                                    </div>
                                    </div>
                            <!-- End right side column -->
                                </div>
                            </div>
                                <!-- End of modal body -->
                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Add Item</button>
                                    </form>
                                        <button type="button" class="btn btn-secondary" id="closeBtn" data-bs-dismiss="modal">Close</button>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- End of Add item modal -->


<!-- Edit item modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" id="edit-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Start of Modal Body -->
                <div class="modal-body">
                    <div class="container">
                        <div class="row g-2">
                            <!-- Left side column -->
                            <div class="col-6">
                                <div class="p-3">
                                <form action="update_item.php" method="post">
                                <!-- Label and Textbox -->
                                <input type="hidden" name="modal_id" id="update_id">
                                <label for="skuInput" class="form-label">SKU</label>
                                <input type="text" name="modal_sku" id="sku" class="form-control" readonly>
                                <label for="itemnameInput" class="form-label">Barcode</label>
                                <input type="text" name="modal_barcode" id="barcode" class="form-control" id="ubarcodeInput">
                                <label for="itemnameInput" class="form-label">Item Name</label>
                                <input type="text" name="modal_itemname" id="itemname" class="form-control" id="uitemnameInput">
                                <label for="stocksInput" class="form-label">Stocks</label>
                                <input type="number" name="modal_stocks" id="stocks" class="form-control" id="ustocksInput">
                                <label for="expdateInput" class="form-label">Exp. Date</label>
                                <input type="date" name="modal_date" id="expdate" class="form-control" id="uexpdateInput">
                                <label for="edt-mark-up" class="form-label">Mark Up</label>
                                <input style="margin: 0;" type="number" name="modal_markup" class="form-control" id="edt-mark-up">
                                <label for="cpriceInput" class="form-label">Selling Price</label>
                                <input style="margin: 0;" type="number" name="modal_cp" class="form-control" step=".01" id="edt-cpriceInput">
                                <label for="priceInput" class="form-label">Price</label>
                                <input style="margin: 0;" type="number" name="modal_price" step=".01" class="form-control" id="upriceInput" readonly><br>

                                <!-- Selecting Category-->
                                <div class="input-group mb-4">
                                    <label class="input-group-text colorbox" for="category">Category</label>
                                    <select class="form-select" id="category" name="category">

                                    <!-- PHP Looping for fetching uom's for the dropdown list -->
                                    <?php  
                                        $sql_query1 = "SELECT * FROM category_db";
                                        $sql_res1 = mysqli_query($sqlconn, $sql_query1);

                                        while($array1 = mysqli_fetch_array($sql_res1)) {
                                    ?>
                                        <option value="<?php echo $array1['category_name']; ?>"><?php echo $array1['category_name']; ?></option>
                                    <?php 
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End left side column -->
                            
                                <!-- Right side column -->
                                <div class="col-6">
                                    <div class="p-3">
                                        <!-- Label and Textbox -->
                                        <label for="e-sales" class="form-label">Sales Threshold</label>
                                        <input type="number" name="sales" class="form-control" id="e-sales" required>
                                        <label for="e-stable" class="form-label">Stable Threshold</label>
                                        <input type="text" name="stable" class="form-control" id="e-stable" required>
                                        <label for="e-average" class="form-label">Average Threshold</label>
                                        <input type="number" name="average" class="form-control" id="e-average" required>
                                        <label for="e-reorder" class="form-label">Reorder Threshold</label>
                                        <input type="number" name="reorder" class="form-control" id="e-reorder" required>
                                        <label for="e-critical" class="form-label">Critical Threshold</label>
                                        <input type="number" name="critical" class="form-control" id="e-critical" required><br>
                                    </div>
                                </div>
                            <!-- End right side column -->
                                </div>
                            </div>
                    <div class="modal-footer">
                        <button  class="btn btn-primary">Update Changes</button>
                    </form>
                        <button type="button" class="btn btn-secondary" id="edit-close-btn" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End of edit modal -->


    <!-- Boostrap scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- For script made-->
    <script src="../notif-count.js"></script>
    <script src="autocomplete.js"></script>
    <script src="calculate-price.js"></script>
    <script type="text/javascript" src="update.js"></script>
 
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
    
        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

    $(document).ready( function () {
        $('#inv-table').DataTable( {
            "drawCallback": function(settings) {
            $('tbody tr').each(function() {
                var row = $(this);
                    if (row.hasClass("expired")) {
                        row.css("background-color", "#FF7276");
                    } else if (row.hasClass("close-to-expiration")) {
                        row.css("background-color", "#FCD299");
                    }
                });
            }
        });
    });

    $(document).ready(function() {   
        $("tr").each(function() {
            var row = $(this);
            if (row.hasClass("expired")) {
                row.css("background-color", "#FF7276");
            } else if (row.hasClass("close-to-expiration")) {
                row.css("background-color", "#FCD299");
            }

            //when add item modal opens, it will focus on the barcode input

            $('#myModal').on('shown.bs.modal', function() {
                $('#barcodeInput').focus();
            });


            $(document).on('keydown', '#barcodeInput', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    $('#itemnameInput').focus();
            }
            });
        });
    });
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