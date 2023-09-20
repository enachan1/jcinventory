<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="../styles.css" />
    <title>POS</title>
    <!--Style inside main Page -->
    <style>
        .colobody{
            background-color: rgb(236, 236, 236);
        }

        .colorbody{
            background-color: #fffcfc;
        }

        .table-responsive {
            position: relative;
            max-height: 470px;
            overflow-y: auto;
        }

        .table-responsive table {
            position: relative;
        }

        .table-responsive table thead th {
            position: sticky;
            top: 0;
            background-color: #b1ffa1;
        }

        .custom-btn-lg {
            padding:40px 1px; 
            font-size: 1rem; 
            margin: 3;
            font-size: larger;
        }

        .adjustment{
            padding-top: 280px;
        }

        .adjustments{
            width: 38px;
        }

        .apto-display-font {
            font-family: "Aptos Display", sans-serif;
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
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="#navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-2"></i>My name
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="/Profile/Profile.html">Profile</a></li>
                                    <li><a class="dropdown-item" href="/Settings/Settings.html">Setting</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a class="dropdown-item" href="../logout.php">Log-out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

<!-- Point of Sales Content -->
<div class="container-fluid mt-3">
    <div class="row m-1">
        <!-- Left side column -->
        <div class="col-8">
            <!-- Total Display -->
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between bg-info">
                    <h1 class="display-4 mb-0 apto-display-font">Total:</h1>
                    <h1 class="display-4 mb-0">$0.00</h1>
                </div>
            </div>

            <!-- Table -->
            <div class="card mb-4">
                <div class="card-body colobody">
                    <!-- Your content here -->
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 470px; overflow-y: auto;">
                            <table class="table colorbody rounded shadow-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>QTY</th>
                                        <th>Item Description</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Table content here -->
                                <tr>
                                    <!-- Input QTY -->
                                    <th scope="row"> <input class="adjustments" type="text" class="form-control" value="1"></th>

                                    <td>Orea qweasdqwe</td>
                                    <td>60</td>
                                    <td>5</td>       
                                </tr>
                                <tr>
                                    <!-- Pumili ka sa dalawa ano maganda Input-->
                                    <!-- Input QTY but change-->
                                    <td><input class="form-control adjustments" type="text" value="1"></td>
                                    <td>Orea qweasdqwe</td>
                                    <td>60</td>
                                    <td>5</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barcode Scanning -->
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-around colobody">
                    <div class="card-body bg-info">
                        <h3 class="mb-1">Barcode:</h3>
                    </div>
                        <input type="text" class="form-control" id="barcodeInput">
                </div>
            </div>
        </div>

        <!-- Right side column -->
        <div class="col-4 adjustment">
            <!-- Buttons for Payment, Inventory, Sales, Dashboard -->
            <div class="card colobody">
                <div class="card-body ">
                    <div class="d-grid gap-2 mx-auto ">
                    <button type="button" class="btn btn-primary custom-btn-lg">Dashboard</button>
                    <button type="button" class="btn btn-primary custom-btn-lg">Inventory</button>
                    <button type="button" class="btn btn-primary custom-btn-lg">Sales</button>
                    <button type="button" class="btn btn-primary custom-btn-lg" data-toggle="modal" data-target="#transactionModal">Payment</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Payment Modal -->
            <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="transactionModalLabel">Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <!-- ETO MODAL TO  -->
                            <form>
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="text" class="form-control" id="total">
                                </div>
                                <div class="form-group">
                                    <label for="cash">Cash</label>
                                    <input type="text" class="form-control" id="cash">
                                </div>
                                <div class="form-group">
                                    <label for="change">Change</label>
                                    <input type="text" class="form-control" id="change">
                                </div>
                            </form>
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