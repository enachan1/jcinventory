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
        <title>Product Maintenance</title>
    </head>
    <style>
        .nav-tabs .nav-item {
            border: none;
        }

        .nav-tabs .nav-link {
            border: none;
            border-radius: 0; /* Remove border-radius if applied by Bootstrap */
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
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 ">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left fs-4 me-3 " id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Product Maintenance</h2>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav nav-tabs ms-3 border border-0" id="myTab" role="tablist">
                <!-- Navigation Tabs -->
                <li class="nav-item" role="presentation">
                    <a class="nav-link fs-5" href="?tb=1" id="category-tab" data-bs-toggle="tab" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="true">
                        <i class="fas fa-folder"></i> Category
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fs-5" href="?tb=2"  id="uom-tab" data-bs-toggle="tab" data-bs-target="#uom" type="button" role="tab" aria-controls="uom" aria-selected="false">
                        <i class="fas fa-ruler"></i> Unit of Measure
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

    <div class="container mt-4">
        <!-- Category Tab -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Category</h5>
                        <!--Drop down Button Purchase Order-->
                        <div class="d-flex justify-content-between rounded">
                            <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                Add Category
                            </button>
                        </div>
                        <br>
                        <?php 
                                    if(isset($_GET['catmsg'])) {
                                    ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?= $_GET['catmsg'] ?>
                                            <button class="btn-close" data-bs-dismiss="alert" id="removeCatMsgButton" aria-label="Close"></button>
                                        </div>
                            <?php } 
                                   else if (isset($_GET['caterror'])) { 
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $_GET['caterror'] ?>
                                            <button class="btn-close" data-bs-dismiss="alert" id="removeCatErrorButton" aria-label="Close"></button>
                                        </div>
                            <?php  } ?>
                        <br>
                        <!-- Table -->
                        <table id="category-table" class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php 
                                    $sql_query = "SELECT * FROM category_db";
                                    $sql_res = mysqli_query($sqlconn, $sql_query);

                                    while($array = mysqli_fetch_array($sql_res)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $array['category_name']; ?>
                                    </td>
                                    <td>
                                        <a href="delete_category.php?id=<?php echo $array['id'];?>" class="btn btn-primary btn-sm btn-danger" type="reset">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Unit of Measure Tab -->
            <div class="tab-pane fade" id="uom" role="tabpanel" aria-labelledby="uom-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Unit of Measure</h5>
                        <!--Dropdown Button For Vendors-->
                            <div class="d-flex justify-content-between rounded">
                                <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#uomModal">
                                    Add Unit of Measure
                                </button>
                            </div>
                            <br>
                        <?php 
                                    if(isset($_GET['uommsg'])) {
                                    ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?= $_GET['uommsg'] ?>
                                            <button class="btn-close" data-bs-dismiss="alert" id="removeuomMsgButton" aria-label="Close"></button>
                                        </div>
                            <?php } 
                                   else if (isset($_GET['uomerror'])) { 
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $_GET['uomerror'] ?>
                                            <button class="btn-close" data-bs-dismiss="alert" id="removeuomErrorButton" aria-label="Close"></button>
                                        </div>
                            <?php  } ?>
                        <br>
                        <!-- Table -->
                        <table id="uom-table" class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Unit of Measure</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $sql_query1 = "SELECT * FROM uom_db";
                                $sql_res1 = mysqli_query($sqlconn, $sql_query1);

                                while($array1 = mysqli_fetch_array($sql_res1)) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $array1['uom_name']; ?>
                                    </td>
                                    <td>
                                        <a href="delete_uom.php?id= <?php echo $array1['id'] ?>" class="btn btn-primary btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                            </a>
                                    </td>
                                </tr>
                            <?php 
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
<!-- End of Page Content-->


            <!-- Category Modal -->
            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Add Category</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Form to add a new category -->
                        <form action="add_category.php" method="post">
                            <div class="modal-body">
                                <div class="container-fluid px-1">
                                    <div class="mb-3">
                                        <label for="categoryInput">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" id="categoryInput" placeholder="Enter category name">
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Add</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Unit of Measure Modal -->
                <div class="modal fade" id="uomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Add Unit of Measure</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Form to add a new Unit of Measure -->
                            <form action="add_uom.php" method="post">
                                <div class="modal-body">
                                    <div class="container-fluid px-1">
                                        <div class="mb-3">
                                            <label for="categoryInput">Unit of Measure</label>
                                            <input type="text" class="form-control" name="uom_name" id="categoryInput" placeholder="Enter Unit of Measure name">
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Add</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

        
        <!--Boostrap Layout -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Data table Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
        <script>
            // Elements Menu Toggle
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");

            //Sidebar Toggle
            toggleButton.onclick = function () {
                el.classList.toggle("toggled");
            };

            //Tab Active function
            document.addEventListener('DOMContentLoaded', function () {
            var storageKey = 'activeTabSet1';

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

            //Table function by using databases boostrap5
            $(document).ready( function () {
                $('#category-table').DataTable();
            });
            $(document).ready( function () {
                $('#uom-table').DataTable();
            });

            //removing url messages

            $('#removeCatMsgButton').on('click', function() {
                // Remove the 'err' query parameter from the URL
                var currentUrl = window.location.href;
                var updatedUrl = currentUrl.replace(/[?&]catmsg=.*&?/, '');
                history.replaceState({}, document.title, updatedUrl);
            });

            $('#removeCatErrorButton').on('click', function() {
                // Remove the 'err' query parameter from the URL
                var currentUrl = window.location.href;
                var updatedUrl = currentUrl.replace(/[?&]caterror=.*&?/, '');
                history.replaceState({}, document.title, updatedUrl);
            });

            $('#removeuomMsgButton').on('click', function() {
                // Remove the 'err' query parameter from the URL
                var currentUrl = window.location.href;
                var updatedUrl = currentUrl.replace(/[?&]uommsg=.*&?/, '');
                history.replaceState({}, document.title, updatedUrl);
            });

            $('#removeuomErrorButton').on('click', function() {
                // Remove the 'err' query parameter from the URL
                var currentUrl = window.location.href;
                var updatedUrl = currentUrl.replace(/[?&]uomerror=.*&?/, '');
                history.replaceState({}, document.title, updatedUrl);
            });

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