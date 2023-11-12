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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">

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

        .apto-display-font {
            font-family: 'Alfa Slab One', cursive;
            font-size: 62px;
        }
        .roboto-font {
            font-family: 'Roboto', sans-serif;
            font-size: 62px;
        }

        .responsive-input {
            width: 100%; 
            max-width: 300px;
            height: 80px; 
        }

        .apto-display-fonts {
            font-family: 'Alfa Slab One', cursive;
            font-size: 28px;
        }
        .custom-button {
            width: 170px; 
            height: 70px; 
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
                    <h1 class="display-4 mb-0 roboto-font">P <span id="overallTotal">0.00</span></h1>
                </div>
            </div>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert-pos-stocks" style="font-size:24px">
                                     <strong> Not Enough Stocks </strong>
                                    <button type="button" class="btn-close bt-hide" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                <!-- Table content here -->
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barcode Scanning -->
            <form action="#" id="purchaseForm" autocomplete="off">
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-around colobody">
                
                    <div class="card-body bg-info">
                        <h3 class="mb-1">Barcode:</h3>
                    </div>
                        <input type="text" class="form-control" name="skubarcode" id="barcodeInput">
                        <!-- Auto complete items -->
                        <div class="list-group" id="showlist_skuitems" style="position: absolute; z-index: 1; width: 50%; top: 90px; left: 150px;">
                       
                        </div>
                        <!-- End of auto complete items -->
                        <button style="display: none;" class="btn btn-primary" id="submitButton">btn</button>
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
                    <div class="container">
                        <div class="row g-2">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="p-3 d-flex justify-content-center"><button type="button" class="btn btn-primary w-100 btns" style="height: 100px; font-size: 24px; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#searchModal" id="F1Button"> Search Item F1</button> </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="p-3 d-flex justify-content-center"><button type="button" class="btn btn-primary w-100 btns" style="height: 100px; font-size: 24px; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#priceinquiryModal" id="F2Button"> Price Inquiry F2</button> </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="p-3 d-flex justify-content-center"><button type="button" class="btn btn-primary w-100 btns" style="height: 100px; font-size: 24px; font-weight: bold;" id="F3Button"> Void F3</button> </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="p-3 d-flex justify-content-center"><button type="button" class="btn btn-primary w-100 btns" style="height: 100px; font-size: 24px; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#paymentModal" id="F4Button"> Payment  F4</button> </div>
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
                                <div class="modal-header ">
                                    <h2 class="modal-title display-4 mb-0 apto-display-fonts" id="searchModalLabel"><strong>Search Item</strong></h2>
                                </div>
                                <div class="modal-body colobody">
                                <div class="container-fluid">
                                <form action="search_script.php" method="GET" id="searchForm" autocomplete="off">
                                        <div class=" d-flex input-group input-group-lg" style="height: 70px;">
                                            <span class="input-group-text" id="inputGroup-sizing-lg"><strong>Search:</strong></span>
                                                                                                <!-- Value for search to get item -->
                                            <input type="text" class="form-control" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                                            <button type="submit" class="btn btn-primary btn-lg custom-search-button d-none">Search</button>
                                        </div>
                                    </form>
                                    <div class="table-responsive text-center mt-4" id="searchResults">
                                        <!-- Results will be displayed here -->
                                        <table class="table table-bordered colorbody w-75 m-auto">
                                            <thead>
                                                <tr>
                                                    <th scope="col">SKU</th>
                                                    <th scope="col">Item Name</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Stocks</th>
                                                    <th scope="col">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- This section will be populated with search results using JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>

                                <!-- Modal footer goes here -->
                                <div class="modal-footer">
                                    <!-- Kapag nag enter mapupunta sa table yong item kaso wala pa function nilagay ni carlo -->
                                    <button type="button" class="btn btn-primary custom-button"><h2><strong>Enter</strong></h2></button>
                                    <button type="button" class="btn btn-secondary custom-button" data-bs-dismiss="modal"><h2><strong>Close</strong></h2></button>
                                </div>
                                <!-- Modal footer End here -->

                            </div>
                        </div>
                    </div>

            <!--End search-->



            <!-- Price Inquiry Modal -->
            <div class="modal fade" id="priceinquiryModal" tabindex="-1" aria-labelledby="priceinquiryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title display-4 mb-0 apto-display-fonts" id="priceinquiryModalLabel">Price Inquiry</h5>
                        </div>
                        <div class="modal-body colobody">
                            <div class="card-body center d-flex justify-content-between bg-info mt-2 m-4">
                                        <h1 class="display-4 px-2 apto-display-font">Price:</h1>
                                                                <!-- Display Price Display here -->
                                        <h1 class="display-4 px-5">
                                        <i class="fas fa-dollar-sign"></i>
                                            <span class="roboto-font text-end" id="priceDisplay">0.00</span>
                                        </h1>
                                    </div>
                            <div class="table-responsive text-center mt-4" id="priceResults">
                                <!-- Results will be displayed here -->
                                <table class="table table-bordered colorbody w-75 m-auto">
                                    <thead>
                                        <tr>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- This section will be populated with search results using JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Modal footer goes here -->
                        <div class="modal-footer ">
                            <div class="container-fluid">
                                <div class="row">
                                <!-- Left column for the form content -->
                                    <div class="col-md-8">
                                        <form action="price_inquiry.php" method="GET" id="priceForm" autocomplete="off">
                                        <div class="card-body d-flex justify-content-around colobody">
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text" id="inputGroup-sizing-lg"><strong>Item Name:</strong></span>
                                                                                                                    <!-- Call value form price -->
                                                <input type="text" class="form-control" name="price" required value="<?php if(isset($_GET['price'])){echo $_GET['price'];}?>">
                                                <button type="submit" class="btn btn-primary d-none">Submit</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>

                                <!-- Right column for the "Close" button -->
                                    <div class="col-md-4">
                                        <div class="d-grid m-1 gap-7 col-15 mx-auto h-50">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><h2><strong>Close</strong></h2></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer end here -->

                    </div>
                </div>
            </div>
            <!--End modal Price Inquiry-->

            <!-- Payment Modal -->
            <div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title display-4 mb-0 apto-display-fonts">Payment</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container mt-2 px-5">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert-pos" style="font-size:24px">
                                     <strong> Insufficient Cash </strong>
                                    <button type="button" class="btn-close bt-hide" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                
                                    <!--Total Input-->
                                    <div class="card-body d-flex justify-content-between bg-info">
                                        <h1 class="display-4 mb-0 apto-display-font">Total:</h1>
                                                                <!-- Display total here -->
                                        <h1 class="display-4 mb-0">
                                            <input type="text" class="form-control roboto-font text-end responsive-input" id="modalPTotal" placeholder="0.00" disabled>
                                        </h1>
                                    </div><br>
                                    <!--VAT Input-->
                                    <div class="card-body d-flex justify-content-between bg-info">
                                        <h1 class="display-4 mb-0 apto-display-font">VAT - 12%</h1>
                                                                <!-- Display total here -->
                                        <h1 class="display-4 mb-0">
                                            <input type="text" class="form-control roboto-font text-end responsive-input" id="modalPVat" placeholder="0.00" disabled>
                                        </h1>
                                    </div><br>
                                    <!--Cash Input-->
                                    <div class="card-body d-flex justify-content-between bg-info">
                                        <h1 class="display-4 mb-0 apto-display-font">Cash:</h1>
                                                                <!-- Display cash here -->
                                        <h1 class="display-4 mb-0">
                                            <input type="number" class="form-control roboto-font text-end responsive-input" step=".01" id="cash" placeholder="0.00">
                                        </h1>
                                    </div><br>
                                        
    
                                    <!--Change Input-->
                                    <div class="card-body d-flex justify-content-between bg-info">
                                        <h1 class="display-4 mb-0 apto-display-font">Change:</h1>
                                                                <!-- Display Exchange here -->
                                        <h1 class="display-4 mb-0">
                                            <input type="number" class="form-control roboto-font text-end responsive-input change-pay" step=".01" id="change" placeholder="0.00" disabled>
                                        </h1>
                                    </div><br>
    
                                    <!--Pay Button-->
                                    <div class="form-group">
                                        <button class="btn btn-secondary btn-lg" id="purchase">Pay</button>
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
    <script src="buttonPOS.js"></script>
    <script src="searchPOS.js"></script>
    <script src="priceinPOS.js"></script>
    <script src="insertitems.js"></script>
    <script src="disableinput.js"></script>

    <script>
         // Auto Focus
         $(document).ready(function () {
            $("#barcodeInput").focus();
        });

        // Call the function initially
        function updateTextSize() {
        const screenWidth = window.innerWidth;
        const buttonElements = document.querySelectorAll(".btns");
        const textSize = screenWidth <= 1440 ? "18px" : "24px"; 
    
        buttonElements.forEach((button) => {
                button.style.fontSize = textSize;
            });
        }   
    
        // Add an event listener to update text size when the window is resized
        window.addEventListener("resize", updateTextSize);
    
        // Call the function initially
        updateTextSize();

    </script>
</body>
<?php }
    else {
        header("Location: /jcinventory/login_form.php");
        exit();
    }

?>
</html>