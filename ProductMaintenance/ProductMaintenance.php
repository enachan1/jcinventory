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
                <a href="../POS/POS.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-usd-circle me-2"></i>Point of Sales</a>
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
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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
            <!-- Category List Card -->
        <div class="container-fluid px-4">
            <div class="row justify-content-center mt-5">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between rounded">
                                <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Add Category
                                </button>
                                <input type="text" class="form-control search-bar" placeholder="Search">
                            </div>
                        </div>
                        <?php if(isset($_GET['catmsg'])) {?>
                                <div class="alert alert-success" role="alert">
                                <?php echo $_GET['catmsg']; ?>
                                </div>
                                <?php } ?>
                        <div class="card-body colorbox">
                            <h5 class="card-title">Category</h5>
                            <div class="table-responsive">
                                <table class="table colorbox rounded shadow-sm table-hover">
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
                                                <!-- Buttons for Edit and Remove -->
                                                <button class="btn btn-primary btn-sm btn-secondary" type="button">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-primary btn-sm btn-danger" type="reset">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php 
                                        }
                                        ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
            <!-- Category Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Form to add a new category -->
                        <form action="add_category.php" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="categoryInput">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="categoryInput" placeholder="Enter category name">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Unit of Measure -->

            <div class="container-fluid px-4">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between rounded">
                                    <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#uomModal">
                                        Add Unit of Measure
                                    </button>
                                    <input type="text" class="form-control search-bar" placeholder="Search">
                                </div>
                            </div>
                            <?php if(isset($_GET['uommsg'])) {?>
                                <div class="alert alert-success" role="alert">
                                <?php echo $_GET['uommsg']; ?></div>
                                <?php } ?>
                            <div class="card-body colorbox">
                                <h5 class="card-title">Unit of Measure</h5>
                                <div class="table-responsive">
                                    <table class="table colorbox rounded shadow-sm table-hover">
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
                                                    <!-- Buttons for Edit and Remove -->
                                                    <button class="btn btn-primary btn-sm btn-secondary" type="button">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-primary btn-sm btn-danger" type="reset">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php 
                                        }
                                        
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Unit of Measure Modal -->
                <div class="modal fade" id="uomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Unit of Measure</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                <!-- Form to add a new Unit of Measure -->
                            <form action="add_uom.php" method="post">
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="categoryInput">Unit of Measure</label>
                                        <input type="text" class="form-control" name="uom_name" id="categoryInput" placeholder="Enter Unit of Measure name">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

<!-- Selecting Brand -->

<div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="col-md-3">
                <div class="card shadow-sm">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded" >
                    <div>
                        <h3 class="fs-2">720</h3>
                        <p class="fs-5">Drinks</p>
                    </div>
                    <i class="fas fa-glass-whiskey fs-1 primary-text border rounded-full secondary-bg p-3" id="drinks-icon"></i>
                </div>
            </div>
        </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">4920</h3>
                        <p class="fs-5">Junk Food</p>
                    </div>
                    <i
                        class="fas fa-cookie-bite fs-1 primary-text border rounded-full secondary-bg p-3" id="junkfood-icon"></i>
                </div>
            </div>
        </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">3899</h3>
                        <p class="fs-5">Can Food</p>
                    </div>
                    <i class="fas fa-utensils fs-1 primary-text border rounded-full secondary-bg p-3" id="canfood-icon"></i>
                </div>
            </div>
        </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">3899</h3>
                        <p class="fs-5">Toiletries</p>
                    </div>
                    <i class="fad fa-truck fs-1 primary-text border rounded-full secondary-bg p-3" id="toiletries-icon"></i>
                </div>
            </div>
        </div>


            <div class="col-md-3">
                <div class="card shadow-sm">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">3899</h3>
                        <p class="fs-5">Toiletries</p>
                    </div>
                    <i class="fad fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
        </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">3899</h3>
                        <p class="fs-5">Toiletries</p>
                    </div>
                    <i class="fad fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
        </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">3899</h3>
                        <p class="fs-5">Toiletries</p>
                    </div>
                    <i class="fad fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
        </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">3899</h3>
                        <p class="fs-5">Toiletries</p>
                    </div>
                    <i class="fad fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
        </div>
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

            // JavaScript function to add a new category
            //function addCategory() {
            //    const categoryInput = document.getElementById('categoryInput').value;
            //    if (categoryInput.trim() === '') {
            //       alert('Please enter a category name.');
            //        return;
            //    }
            
            // Create a new table row for the category
            //const categoryList = document.getElementById('categoryList');
            //const newRow = document.createElement('tr');
            //newRow.innerHTML = `
            //    <td>${categoryInput}</td>
            //    <td>
            //        <!-- Buttons for Edit and Remove -->
            //        <button class="btn btn-primary btn-sm btn-secondary" type="button">
            //            <i class="fas fa-edit"></i>
            //        </button>
            //        <button class="btn btn-primary btn-sm btn-danger" type="button" onclick="removeCategory(this)">
            //            <i class="fas fa-trash"></i>
            //        </button>
            //    </td>
            //`;
            
            // Append the new row to the category list
            //categoryList.appendChild(newRow);
            
            // Clear the input field and close the modal
            //document.getElementById('categoryInput').value = '';
            //    $('#myModal').modal('hide');
            //}
        
            // JavaScript function to remove a category
            //function removeCategory(button) {
            //    f (confirm("Are you sure you want to remove this category?")) 
            //        const row = button.parentElement.parentElement;
            //        row.remove();
                
            //}
        
            // Attach the addCategory function to the "Add" button
            //document.getElementById('addCategoryBtn').addEventListener('click', addCategory);
    
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