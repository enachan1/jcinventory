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
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../styles.css" />
        <title>Product Maintenance</title>
    </head>
    <style>
        .open-modal-button {
           order: 1;
           margin-right: auto;
       }
       .search-bar {
           order: 2;
           width: 200px;
       }
    </style>

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
                <a href="../PurchaseOrder/PurchaseOrder.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-folders me-2"></i>Purchase Order</a>
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
            <h2 class="fs-2 m-0">Product Maintenance</h2>
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
                    <li><a class="dropdown-item" href="../Profile/Profile.html">Profile</a></li>
                    <li><a class="dropdown-item" href="../Settings/Settings.html">Setting</a></li>
                    <div class="dropdown-divider"></div>
                    <li><a class="dropdown-item" href="../logout.php">Log-out</a></li>
                </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <!-- Navigation Menu -->
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="category-tab" data-bs-toggle="tab" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="true">
                    <i class="fas fa-folder"></i> Category
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="uom-tab" data-bs-toggle="tab" data-bs-target="#uom" type="button" role="tab" aria-controls="uom" aria-selected="false">
                    <i class="fas fa-ruler"></i> Unity of Measure
                </a>
            </li>
        </ul>


        <!-- Category Tab -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab">
                <div class="card">
                    <div class="card-body colorbox">
                        <h5 class="card-title">Category</h5>
                        <!--Drop down Button Purchase Order-->
                        <div class="d-flex justify-content-between rounded">
                            <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                Add Category
                            </button>
                            <!-- Search Bar-->
                            <input type="text" class="form-control search-bar" placeholder="Search">
                        </div><br>
                        <!-- Table -->
                        <table class="table bg-light rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                             <?php 
                                    $sql_query = "SELECT * FROM category_db";
                                    $sql_res = mysqli_query($sqlconn, $sql_query);

                                    while($array = mysqli_fetch_array($sql_res)) {
                                ?>
                            <tbody>
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
                            </tbody>
                            <?php 
                                }
                                ?>
                        </table>

                            <!-- Pagination Next Tables-->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
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
                            <!-- Search Bar-->
                                <input type="text" class="form-control search-bar" placeholder="Search">
                            </div><br>
                        <!-- Table -->
                        <table class="table bg-light rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Unit of Measure</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <?php 
                                $sql_query1 = "SELECT * FROM uom_db";
                                $sql_res1 = mysqli_query($sqlconn, $sql_query1);

                                while($array1 = mysqli_fetch_array($sql_res1)) {
                            ?>
                            <tbody>
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
                            </tbody>
                            <?php 
                            }
                            
                            ?>
                        </table>

                            <!-- Pagination Next Tables-->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
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


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
        <script>
            // Elements
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");

            //Sidebar Toggle
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