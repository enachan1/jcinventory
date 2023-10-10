<!DOCTYPE html>
<html>
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
            width: 65px;
        }

        .apto-display-font {
            font-family: "Aptos Display", sans-serif;
        }

    </style>

</head>
<body>
    <body>
    <!--Page Content-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-2 px-4">
            <h2 class="fs-2 m-0">Point of Sales</h2>

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
                        <li><a class="dropdown-item" href="POSother.html">Point of Sales</a></li>
                        <li><a class="dropdown-item" href="Profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="Setting.html">Setting</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
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
                    <h1 class="display-4 mb-0">P <span id="overallTotal">0.00</span></h1>
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
                                        <th>SKU</th>
                                        <th>Item Description</th>
                                        <th>Price</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                <!-- Table content here -->
                                <?php
                                $select_query = "SELECT * FROM purchase_db";
                                $result_query = mysqli_query($sqlconn, $select_query);
                                
                                while($row = mysqli_fetch_array($result_query)) {
                                ?>
                                <tr>
                                    <!-- Pumili ka sa dalawa ano maganda Input-->
                                    <!-- Input QTY but change-->
                                    <td><input class="form-control adjustments qty" type="number" value="1"></td>
                                    <td class="sku"><?php echo $row['p_sku']; ?></td>
                                    <td><?php echo $row['p_itemname']; ?></td>
                                    <td class="price"><?php echo $row['p_price']; ?></td>
                                    <td class="totalPrice"></td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barcode Scanning -->
            <form action="purchaseinsert.php" method="post">
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-around colobody">
                
                    <div class="card-body bg-info">
                        <h3 class="mb-1">Barcode:</h3>
                    </div>
                        <input type="text" class="form-control" name="skubarcode" id="barcodeInput">
                        <button style="display: none;" class="btn btn-primary">btn</button>
                </div>
                </form>
        </div>
        </div>
        <!-- Right side column -->
        <div class="col-4 adjustment">
            <!-- Buttons for Payment, Inventory, Sales, Dashboard -->
            <div class="card colobody">
                <div class="card-body ">
                    <div class="d-grid gap-2 mx-auto ">
                    <button type="button" class="btn btn-primary custom-btn-lg" data-bs-toggle="modal" data-bs-target="#dashboardModal"> Dashboard</button>
                    <button type="button" class="btn btn-primary custom-btn-lg" data-bs-toggle="modal" data-bs-target="#inventoryModal"> Inventory</button>
                    <button type="button" class="btn btn-primary custom-btn-lg" data-bs-toggle="modal" data-bs-target="#salesModal"> Sales</button>
                    <button type="button" class="btn btn-primary custom-btn-lg" data-bs-toggle="modal" data-bs-target="#transactionModal"> Payment</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Page Content -->

              <!-- Dashboard Modal-->
              <div class="modal fade" id="dashboardModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title">Dashboard</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                        <!-- Your Dashboard content goes here -->
                        <div class="container-fluid px-4">
                            <div class="row g-3 my-2">
                                <div class="col-md-4">
                                    <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                                        <div>
                                            <h3 class="fs-2">720</h3>
                                            <p class="fs-5">Products</p>
                                        </div>
                                        <i class="fas fa-box fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                                    </div>
                                </div>
            
                                <div class="col-md-4">
                                    <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                                        <div>
                                            <h3 class="fs-2">4920</h3>
                                            <p class="fs-5">Sales</p>
                                        </div>
                                        <i
                                            class="fas fa-sack-dollar fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                                    </div>
                                </div>
            
                                <div class="col-md-4">
                                    <div class="p-3 colorbox shadow-sm d-flex justify-content-around align-items-center rounded">
                                        <div>
                                            <h3 class="fs-2">3899</h3>
                                            <p class="fs-5">Delivery</p>
                                        </div>
                                        <i class="fad fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                                    </div>
                                </div>

                        <!-- ... Rest of your Dashboard content ... -->
                        <div class="row my-5">
                            <h3 class="fs-4 mb-3">Expiration Date</h3>
                            <div class="col">
                                <table class="table colorbox rounded shadow-sm  table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Chicaron</td>
                                            <td>6/20/25</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                        <!-- Modal Footer Goes here-->

                    </div>
                    </div>
                </div>
            </div>
            <!--End modal Dashboard-->

            <!-- Inventory Modal-->
            <div class="modal fade" id="inventoryModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title">Inventory</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                        <!-- Your Inventory content goes here -->

                        <!-- //// -->
                        
                        <!-- Modal Footer Goes here-->

                        </div>
                    </div>
                </div>
            </div>
            <!--End modal Inventory-->

            <!-- Sales Modal-->
            <div class="modal fade" id="salesModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title">Sales</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                        <!-- Your Sales content goes here -->

                        <!-- /// -->
                        
                        <!-- Modal Footer Goes here-->

                        </div>
                    </div>
                </div>
            </div>
            <!--End modal Sales-->

            <!-- Payment Modal -->
            <div class="modal fade" id="transactionModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title">Payment</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                        <!-- Your Dashboard content goes here -->
                                <!--Total Input-->
                                <div class="form-group mt-1">
                                    <label for="total"><h3 class="fs-5">Total</h3></label>
                                    <input type="text" class="form-control" id="total" placeholder="0.00">
                                </div>

                                <!--Cash Input-->
                                <div class="form-group mt-2">
                                    <label for="cash"><h3 class="fs-5">Cash</h3></label>
                                    <input type="text" class="form-control" id="cash" placeholder="0.00">
                                </div>

                                <!--Change Input-->
                                <div class="form-group mt-2">
                                    <label for="change"><h3 class="fs-5">Change</h3></label>
                                    <input type="text" class="form-control" id="change">
                                </div><br>

                                <!--Pay Button-->
                                <div class="form-group">
                                    <button class="btn btn-secondary btn-lg" id="purchase">Pay</button>
                                </div>
                        
                            <!-- Modal Footer Goes here-->

                        </div>
                    </div>
                </div>
            </div>
            <!--End modal Payment-->


  



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="postUpdate.js"></script>
  <script src="calculateItems.js"></script>
    <script>
        /*
        // Sample data for demonstration
        const barcodeData = [
            { barcode: '4800010075069', description: 'Cream-O' },
            // Add more data as needed
        ];

        barcodeInput.addEventListener('input', () => {
            const searchTerm = barcodeInput.value.trim();

            // Clear the table body
            barcodeTableBody.innerHTML = '';

            // Filter data based on the input
            const filteredData = barcodeData.filter(item => item.barcode.includes(searchTerm));

            // Populate the table with filtered data
            filteredData.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.barcode}</td>
                    <td>${item.description}</td>
                `;
                barcodeTableBody.appendChild(row);
            });
        });

        */
    </script>
    
</body>
<?php }
    else {
        header("Location: /jcinventory/login_form.php");
        exit();
    }

?>
</html>