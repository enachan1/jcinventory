<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="../styles.css" />
    <title>POS</title>
    <!--Style inside main Page -->
    <style>
        .search-bar {
           order: 2;
           width: 200px;
       }
    </style>

</head>
<body>
    <body>
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
            <!-- /#sidebar-wrapper -->
    
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left fs-4 me-4 " id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Point of Sales</h2>
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
                                    <i class="fas fa-user me-2"></i>My name
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
                        <input type="text" class="form-control search-bar" placeholder="Search">
                    </div>
                </div>
                <div class="card-body">
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    <table class="table colorbox rounded shadow-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Account Number</th>
                                <th scope="col">Account Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows here -->
                            <tr>
                                <th scope="row">1</th>
                                <td>John Doe</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-danger btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jane Smith</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-danger btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Bob Johnson</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-danger btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Bob Johnson</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-danger btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Bob Johnson</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-danger btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Bob Johnson</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-danger btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Bob Johnson</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-danger btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Bob Johnson</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-danger btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Bob Johnson</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                    <button class="btn btn-danger btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            <!-- Continue adding entries here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
      

    </div>
  </div>

  



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };


    </script>
    
</body>
</html>