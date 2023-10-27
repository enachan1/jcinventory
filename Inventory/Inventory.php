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

    //get page number on table inventory
    if (isset($_GET['page_no']) && $_GET['page_no'] !== "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }
    $total_records_per_page = 10;
    $offset = ($page_no -1) * $total_records_per_page;
    $previous_page = $page_no -1;
    $next_page = $page_no + 1;

    $result_count = mysqli_query($sqlconn,"SELECT COUNT(*) as total_records FROM items_db");
    $records = mysqli_fetch_array($result_count);
    $total_records = $records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);




?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../styles.css" />
        <title>Inventory</title>
        <style>
        .search-bar {
           order: 2;
           width: 200px;
       }

       .table-container {
           order: 3;
           width: 100%;
       }

       .open-modal-button {
           order: 1;
           margin-right: auto;
       }

       @media (max-width: 767px) {
           .conntainer-fuild {
               display: block;
           }

           .sidebar {
               order: 1;
           }

           .search-bar,
           .table-container {
               order: 2;
           }

           .open-modal-button {
               order: 3;
               margin-top: 1rem;
               margin-right: 0;
           }

           .modal-dialog {
               max-width: 80%;
               margin: 1.75rem auto;
           }
       }
   </style>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
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
                   <li><a class="dropdown-item" href="Profile.html">Profile</a></li>
                   <li><a class="dropdown-item" href="Settings.html">Setting</a></li>
                   <div class="dropdown-divider"></div>
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
                    <div class="card-header">
                        <div class="d-flex justify-content-between rounded">
                            <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">
                                Add item
                            </button>
                            <input type="text" class="form-control search-bar" placeholder="Search">
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table colorbox rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="display: none;"></th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Stocks</th>
                                    <th scope="col">Exp.Date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">UOM</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $show_items_query = "SELECT * FROM items_db  LIMIT $offset , $total_records_per_page";
                        $show_result = mysqli_query($sqlconn, $show_items_query);

                        while($show_rows = mysqli_fetch_array($show_result)) {
                        
                        ?>
                        <tr>
                            <td style="display: none;"><?php echo $show_rows['id'] ?></td>
                            <td><?php echo $show_rows['item_sku'] ?></td>
                            <td><?php echo $show_rows['item_name'] ?></td>
                            <td><?php echo $show_rows['item_stocks'] ?></td>
                            <td><?php echo $show_rows['item_expdate'] ?></td>
                            <td><?php echo $show_rows['item_price'] ?></td>
                            <td><?php echo $show_rows['item_uom'] ?></td>
                            <td><?php echo $show_rows['item_category'] ?></td>
                            <!--Button Edit / Remove-->
                            <div class="">
                            <td><button type="button" class="btn btn-secondary btn-sm editbtn" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                                <a class="btn btn-primary btn-sm btn-danger" href="delete_items.php?id=<?php echo $show_rows['id']?>"><i class="fas fa-trash"></i></td></a>
                                </div>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
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
                        <strong>Page <?= $page_no; ?> of <?= $total_records_per_page; ?></strong>
                    </div>
        </div>
    </div>
</div>
    
    <!-- Add Item Modal-->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            <!-- Start Modal Body-->
            <div class="modal-body">
                <div class="mb-4">
                    <form action="add_items.php" method="post">
                    <!-- Label and Textbox -->
                    <label for="skuInput" class="form-label">SKU</label>
                    <input type="number" name="modal_sku" class="form-control" id="skuInput" required>
                    <label for="itemnameInput" class="form-label">Item Name</label>
                    <input type="text" name="modal_itemname" class="form-control" id="itemnameInput" required>
                    <label for="stocksInput" class="form-label">Stocks</label>
                    <input type="number" name="modal_stocks" class="form-control" id="stocksInput" required>
                    <label for="expdateInput" class="form-label">Exp. Date</label>
                    <input type="date" name="modal_date" class="form-control" id="expdateInput" required>
                    <label for="priceInput" class="form-label">Price</label>
                    <input style="margin: 0;" type="number" name="modal_price" class="form-control" id="priceInput" required><br>

                    <!-- Selecting Unit of measure-->
                    <div class="input-group mb-4">
                            <label class="input-group-text colorbox" for="uof">Unit of Measure</label>
                            <select class="form-select" id="update_uom" name="uom">

                        <!-- PHP Looping for fetching uom's for the dropdown list -->
                        <?php  
                            $sql_query = "SELECT * FROM uom_db";
                            $sql_res = mysqli_query($sqlconn, $sql_query);

                            while($array = mysqli_fetch_array($sql_res)) {
                        ?>
                            <option value="<?php echo $array['uom_name']; ?>"> <?php echo $array['uom_name']; ?> </option>
                        <?php 
                            }
                        ?>
                        </select>
                    </div>

                    <!-- Selecting Category -->
                    <div class="input-group mb-4">
                        <label class="input-group-text colorbox" for="category">Category</label>
                        <select class="form-select" id="update_category" name="category">

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
                <!-- End of modal body -->
                    <div class="modal-footer">
                        <button class="btn btn-primary">Add Item</button>
                    </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End of Add item modal -->


<!-- Edit item modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            <!-- Start of Modal Body -->
            <div class="modal-body">
                <div class="mb-4">
                    <form action="update_item.php" method="post">
                    <!-- Label and Textbox -->
                    <input type="hidden" name="modal_id" id="update_id">
                    <label for="skuInput" class="form-label">SKU</label>
                    <input type="number" name="modal_sku" id="sku" class="form-control">
                    <label for="itemnameInput" class="form-label">Item Name</label>
                    <input type="text" name="modal_itemname" id="itemname" class="form-control" id="itemnameInput">
                    <label for="stocksInput" class="form-label">Stocks</label>
                    <input type="number" name="modal_stocks" id="stocks" class="form-control" id="stocksInput">
                    <label for="expdateInput" class="form-label">Exp. Date</label>
                    <input type="date" name="modal_date" id="expdate" class="form-control" id="expdateInput">
                    <label for="priceInput" class="form-label">Price</label>
                    <input style="margin: 0;" type="number" name="modal_price" id="price" class="form-control" id="priceInput"><br>

                    <!-- Selecting Unit of Measure-->
                    <div class="input-group mb-4">
                        <label class="input-group-text colorbox" for="uof">Unit of Measure</label>
                        <select class="form-select" id="uom" name="uom">

                        <!-- PHP Looping for fetching uom's for the dropdown list -->
                        <?php  
                            $sql_query = "SELECT * FROM uom_db";
                            $sql_res = mysqli_query($sqlconn, $sql_query);

                            while($array = mysqli_fetch_array($sql_res)) {
                        ?>
                            <option value="<?php echo $array['uom_name']; ?>"> <?php echo $array['uom_name']; ?> </option>
                        <?php 
                            }
                        ?>
                        </select>
                    </div>

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
            <!-- End of modal body -->
                <div class="modal-footer">
                    <button  class="btn btn-primary">Update Changes</button>
                </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- End of edit modal -->

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

        <script type="text/javascript" src="update.js"></script>
    </body>
    <?php
}
else {
    header("Location: /jcinventory/login_form.php");
    exit();
}


?>
</html>