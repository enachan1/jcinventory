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
    <!-- data tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <title>Accounts</title>
    <!--Style inside main Page -->
    <style>
        .search-bar {
           order: 2;
           width: 200px;
       }
    </style>

</head>
<body>
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
            <!-- /#sidebar-wrapper -->
    
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left fs-4 me-4 " id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Accounts</h2>
                    </div>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 dropadjust">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="#navbarDropdown"
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

        <!-- Accounts Add-->
        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between rounded">
                        <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">
                            Add Account
                        </button>
                    </div>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-call">
                    <span id="alert-text"></span>
                    <button type="button" class="btn-close btn-clsbtn" data-bs-dismiss="alert"></button>
                </div>
                <div class="card-body">
                    <table id="account-table" class="table colorbox rounded shadow-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows here -->
                         <?php 
                         $account_fetch_query = "SELECT `id`, `user_name`, `email`, `contact_no` FROM `users__db`";
                         $result = mysqli_query($sqlconn, $account_fetch_query);
                         
                         while($rows = mysqli_fetch_assoc($result)) {
                         ?>
                            <!-- Continue adding entries here -->
                            <tr>
                                <td><?= $rows['user_name']; ?></td>
                                <td><?= $rows['email']; ?></td>
                                <td><?= $rows['contact_no']; ?></td>
                                <?php 
                                if($user == $rows['user_name']) {
                                ?>
                                <td><button class="btn btn-sm btn-danger delete-btn" disabled><i class="fas fa-trash" ></i></button></td>
                                <?php }
                                    else {
                                ?>
                                <td><button class="btn btn-sm btn-danger delete-btn" data-accid="<?= $rows['id']; ?>"><i class="fas fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      

    <!-- Add Account Modal-->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Add Account</h5>
                    <button type="button" class="btn-close mdl-tp-cls" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            <!-- Start Modal Body-->
            <div class="modal-body">
                <div class="mb-4">
                    <form method="POST" id="submit_form">
                    <!-- Label and Textbox -->
                    <label for="account_name" class="form-label">Username</label>
                    <input type="text" name="a_username" class="form-control" id="account_name" required>
                    <label for="account_email" class="form-label">Email</label>
                    <input type="text" name="a_email" class="form-control" id="account_email" required>
                    <label for="account_contact" class="form-label">Contact</label>
                    <input type="text" name="a_contact" class="form-control" id="account_contact">
                    <label for="the_password" class="form-label">Password</label>
                    <input type="password" name="a_password" class="form-control" id="the_password" required>
                    <label for="confirm_pass" class="form-label">Confirm Password</label>
                    <input style="margin-bottom: 20px;" type="password" name="a_conpassword" class="form-control" id="confirm_pass" required>

                    <div class="input-group mb-4">
                            <label class="input-group-text colorbox" for="uof">User Type</label>
                            <select class="form-select" id="user-type" name="user_type">
                            <option value="1">Admin</option>
                            <option value="0">Cashier</option>
                        </select>
                    </div>

                </div>
                <!-- End of modal body -->
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="add-acc">Add Account</button>
                    </form>
                        <button type="button" class="btn btn-secondary mdl-bt-cls" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End of Modal Add Account -->




<!-- Start of confirmation modal -->
<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="confirmation-modal-Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" id="mdl-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="mdl-yes" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Confirmation Modal -->


    </div>
  </div>

  



    <!-- Boostrap Layout -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="submit.js"></script>

    <!-- Data table Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        $(document).ready( function () {
            $('#account-table').DataTable( {
            lengthChange: false
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