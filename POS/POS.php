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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            padding-top: 20px;
        }

        .adjustments{
            width: 65px;
        }

        .apto-display-font {
            font-family: "Aptos Display", sans-serif;
        }

        .dropadjust
        {
            padding-right: 30px;
        }

        .buttonadjust
        {
            width: 190px; 
            height: 110px;
        }

        @media (max-width: 800px) {
            .button-md {
                font-size: 16px;
                width: 100%; /* Make the buttons full width on mobile */
            }
        }
        .button-md 
        {
            font-size: 24px; 
            font-weight: bold;
        }

        .searchadjust
        {
            width: 500px;
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
                        <li><a class="dropdown-item" href="../POS/POS.php">Point of Sales</a></li>
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
        <div class="col-4">
            <!-- Image display right side -->

            <div class="card">
                <div class="card-body ">
                    <img src="Jun&CathyGrocery.png" class="img-fluid rounded mx-auto d-block" alt="imagelogo">
                </div>
            </div>
            <div class="adjustment">
                                
            <!-- Buttons for Search, Price Inquiry, Suspend, Resume, Cash out, Payment  -->
            <div class="card colobody">
                <div class="card-body ">
                    <div class="container text-center">
                        <div class="row g-2">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="p-3 d-flex justify-content-center"><button type="button" class="btn btn-primary buttonadjust button-md"  data-bs-toggle="modal" data-bs-target="#searchModal" id="F1Button"> Search F1</button> </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="p-3 d-flex justify-content-center"><button type="button" class="btn btn-primary buttonadjust button-md" data-bs-toggle="modal" data-bs-target="#priceinquiryModal" id="F2Button"> Price Inquiry F2</button> </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="p-3 d-flex justify-content-center"><button type="button" class="btn btn-primary buttonadjust button-md" data-bs-toggle="modal" data-bs-target="#transactionModal" id="F3Button"> Transaction F3</button> </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="p-3 d-flex justify-content-center"><button type="button" class="btn btn-primary buttonadjust button-md"  data-bs-toggle="modal" data-bs-target="#cashModal" id="F4Button"> Cash Out F4</button> </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="p-3 d-flex justify-content-center"><button type="button" class="btn btn-primary buttonadjust button-md" data-bs-toggle="modal" data-bs-target="#paymentModal" id="F5Button"> Payment F5</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- End of Page Content -->

                        <!-- Search Modal-->
                        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="searchModalLabel">Search</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid px-4">
                                        <div class="mb-3">
                                            <label for="searchInput" class="form-label">Search Input</label>
                                            <input type="text" class="form-control" id="searchInput">
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Item Name</th>
                                                        <th scope="col">SKU</th>
                                                        <th scope="col">Category</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Pato</td>
                                                        <td>0909</td>
                                                        <td>Animal</td>
                                                    </tr>
                                                    <!-- Add more rows as needed -->
                                                </tbody>
                                            </table>
                                        </div>
  
                            <!-- Pagination -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        
                        <!-- Modal Footer Goes here-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!--End modal Search-->


            <!-- Price Inquiry Modal-->
            <div class="modal fade" id="priceinquiryModal">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title">Price Inquiry</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
            
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- Display Box -->
                            <div class="mb-3">
                                <label for="displayBox" class="form-label">Display Box</label>
                                <input type="text" class="form-control" id="displayBox" readonly>
                            </div>
            
                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>0909</td>
                                            <td>Pato</td>
                                            <td>800</td>
                                        </tr>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
            
                        <!-- Modal Footer Goes here-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--End modal Price Inquiry-->


            <!-- Transaction Modal-->
            <div class="modal fade" id="transactionModal">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title">Transaction</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                        <!-- Your content goes here -->

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Reciept No.</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Total Item</th>
                                            <th scope="col">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>001</td>
                                            <td>2023-10-16</td>
                                            <td>16</td>
                                            <td>500</td>
                                        </tr>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        
                        <!-- Modal Footer Goes here-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--End modal Transaction History-->

            <!-- Cash out Modal-->
            <div class="modal fade" id="cashModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title">Cash Out</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                        <!-- Your Cashout content goes here -->
                        <div class="card-body d-flex justify-content-between bg-info">
                            <h1 class="display-4 mb-0 apto-display-font">Change:</h1>
                                                    <!-- Display Exchange here -->
                            <h1 class="display-4 mb-0"> <span id="change">0.00</span></h1>
                        </div>
                        
                        <!-- Modal Footer Goes here-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--End modal Cash out-->


            <!-- Payment Modal -->
            <div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Payment</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid mt-1">
                                <div class="row m-1">
                                <!-- Left side column -->
                                    <div class="col-6">
                                        <!--Total Input-->
                                        <div class="form-group mt-1">
                                            <label for="total"><div class="p-2 w-100"><h4>Total</h4></div></label>
                                            <input type="number" class="form-control" id="modalPTotal" placeholder="0.00" disabled>
                                        </div>
    
                                        <!--Cash Input-->
                                        <div class="form-group mt-2">
                                            <label for="cash"><div class="p-2 w-100"><h4>Cash</h4></div></label>
                                            <input type="text" class="form-control" id="cash" placeholder="0.00">
                                        </div>
    
                                        <!--Change Input-->
                                        <div class="form-group mt-2">
                                            <label for="change"><div class="p-2 w-100"><h4>Change</h4></div></label>
                                            <input type="text" class="form-control" id="change" readonly>
                                        </div><br>
    
                                        <!--Pay Button-->
                                        <div class="form-group">
                                            <button class="btn btn-secondary btn-lg" id="purchase">Pay</button>
                                        </div>
    
                                    </div>
                                <!-- Right side column -->
                                <div class="col-4 ms-auto">
                                    <div class="card">
                                        <div class="card-body ">

                                        <!-- Display & VAT -->
                                        <!--Total Product Display-->
                                        <div class="d-flex mt-1">
                                            <div class="p-2 w-100"><h5>Total Product:</h5></div>
                                                                                                                <!-- call id for total product-->
                                            <div class="p-2 flex-shrink-1"><h5 style="color: rgb(0, 97, 255);"><span id="totalPRODUCT">0</span></h5></div>
                                        </div>
                                        <div class="dropdown-divider"></div>

                                        <!--VAT Sale-->
                                        <div class="d-flex">
                                            <div class="p-2 w-100"><h5>VATable SALES:</h5></div>
                                                                            <!-- call id for vat sales-->
                                            <div class="p-2 flex-shrink-1"><h5><span id="vatSALES">0.00</span></h5></div>
                                        </div>
                                        <div class="dropdown-divider"></div>

                                        <!--VAT Exempt Sale-->
                                        <div class="d-flex">
                                            <div class="p-2 w-100"><h5>VAT-Exempt SALES:</h5></div>
                                                                                <!-- call id for vat Exempt-->
                                            <div class="p-2 flex-shrink-1"><h5><span id="vatEXEMPT">0.00</span></h5></div>
                                        </div>
                                        <div class="dropdown-divider"></div>

                                        <!--VAT Zero-Rated Sales-->
                                        <div class="d-flex">
                                            <div class="p-2 w-100"><h5>VAT Zero-Rated SALES:</h5></div>
                                                                                <!-- call id for vat Zero-rated-->
                                            <div class="p-2 flex-shrink-1"><h5><span id="vatZERORATED">0.00</span></h5></div>
                                        </div>
                                        <div class="dropdown-divider"></div>

                                        <!--VAT Amount-->
                                        <div class="d-flex">
                                            <div class="p-2 w-100"><h5>VAT Amount:</h5></div>
                                                                                <!-- call id for vat amount-->
                                            <div class="p-2 flex-shrink-1"><h5><span id="vatAMOUNT">0.00</span></h5></div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        
                                        </div>
                                    </div>
                                </div>
                                </div>
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
  <script src="buttonPOS.js"></script>
    <script>

        // Function Try for POS
        // Function to update the total product count
        //function updateTotalProductCount() {
        //    var totalProductCount = $("#tableBody tr").length;
        //    $("#totalProductCount").text(totalProductCount);
        //}

        // Call the function initially
        //updateTotalProductCount();

    </script>
    
</body>
<?php }
    else {
        header("Location: /jcinventory/login_form.php");
        exit();
    }

?>
</html>