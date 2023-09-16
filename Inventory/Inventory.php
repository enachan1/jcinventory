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
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i></i>Jun&Cathy</div>

            
            <div class="list-group list-group-flush my-3">
                <a href="../Dashboard/Dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-home-lg-alt me-2"></i>Dashboard</a>
                <a href="../Inventory/Inventory.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-inventory me-2"></i>Inventory</a>
                <a href="../ProductMaintenance/ProductMaintenance.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-folders me-2"></i>Product Maintenance</a>
                <a href="../Reports/Reports.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-file-spreadsheet me-2"></i>Reports</a>
                <a href="../Accounts/Accounts.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fad fa-users me-2"></i>Accounts</a>
                <a href="../Notification/Notification.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-bell me-2"></i>Notification</a>
                <a href="../Settings/Settings.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="far fa-cog me-2"></i>Setting</a>                            
                <a href="../logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
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
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i><?php echo $user; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <li><a class="dropdown-item" href="Profile.html">Profile</a></li>
                   <li><a class="dropdown-item" href="Settings.html">Setting</a></li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </nav>


    <div class="container mt-5">
        <div class="row justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between rounded">
                            <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">
                                Add item
                            </button>
                            <input type="text" class="form-control search-bar" placeholder="Search">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table colorbox rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Stocks</th>
                                    <th scope="col">Exp.Date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Chicaron</td>
                            <td>125</td>
                            <td>6/20/25</td>
                            <td>7</td>
                            <td>Junk Food</td>
                            <!--Button Edit / Remove-->
                            <div class="">
                            <td><button class="btn btn-primary btn-sm btn-secondary" type="button"><i class="fas fa-edit"></i>
                                <button class="btn btn-primary btn-sm btn-danger" type="reset"><i class="fas fa-trash"></i></td>
                                </div>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Orea</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Orea</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Sardens</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Choco Choco</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Mints</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td>Kleso</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">8</th>
                            <td>Yiama</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">9</th>
                            <td>Skyflex</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">10</th>
                            <td>Doni Donat</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">11</th>
                            <td>Respa</td>
                            <td>6/20/25</td>
                        </tr>
                        <tr>
                            <th scope="row">12</th>
                            <td>Muchos</td>
                            <td>6/20/25</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
    
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-4">
        <!-- Label and Textbox -->
        <label for="skuInput" class="form-label">SKU</label>
        <input type="text" name="modal_sku" class="form-control" id="skuInput">
        <label for="itemnameInput" class="form-label">Item Name</label>
        <input type="text" name="modal_itemname" class="form-control" id="itemnameInput">
        <label for="stocksInput" class="form-label">Stocks</label>
        <input type="text" name="modal_stocks" class="form-control" id="stocksInput">
        <label for="expdateInput" class="form-label">Exp. Date</label>
        <input type="date" name="modal_date" class="form-control" id="expdateInput">
        <label for="priceInput" class="form-label">Price</label>
        <input style="margin: 0;" type="number" name="modal_price" class="form-control" id="priceInput"><br>
        <!-- Selecting UoF / Category-->
        <div class="input-group mb-4">
            <label class="input-group-text colorbox" for="uof">Unit of Measure</label>
            <select class="form-select" id="uof" name="uof">
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
        <div class="input-group mb-4">
            <label class="input-group-text colorbox" for="category">Category</label>
            <select class="form-select" id="category" name="category">
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
      <div class="modal-footer">
        <button class="btn btn-primary">Add Item</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



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
    </body>
    <?php
}
else {
    header("Location: /jcinventory/login_form.php");
    exit();
}


?>
</html>