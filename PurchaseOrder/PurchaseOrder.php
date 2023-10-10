<!DOCTYPE html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../styles.css" />
        <title>Purchase Maintenance</title>
    </head>
    <!--Style inside main Page -->
    <style>
        .search-bar {
           order: 2;
           width: 200px;
       }

       .adjustments {
        width: 65px;
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
                <h2 class="fs-2 m-0">Purchase Maintenance</h2>
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
                        <i class="fas fa-user me-2"></i>My name
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../Profile/Profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="../Settings/Settings.php">Setting</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        </nav>


    <!--Tab button--->

    <div class="container mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <!-- Navigation Menu -->
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab" aria-controls="sales" aria-selected="true">
                    <i class="fas fa-chart-line"></i> Purchase Order
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab" aria-controls="inventory" aria-selected="false">
                    <i class="fas fa-box"></i> Vendors
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">
                    <i class="fas fa-truck"></i> Delivery In
                </a>
            </li>
        </ul>


                <!-- Purchase Order -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                        <div class="card">
                            <div class="card-body colorbox">
                                <h5 class="card-title">Purchase Order</h5>
                                <!--Drop down Button Purchase Order-->
                                <div class="d-flex justify-content-between rounded">
                                    <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#purchase1">
                                        Add item
                                    </button>
                                    <!-- Search Bar-->
                                    <input type="text" class="form-control search-bar" placeholder="Search">
                                </div><br>
                                <!--Table-->
                                <table class="table bg-light rounded shadow-sm table-hover">
                                    <thead>
                                        <tr>
                                            <!-- Table content here -->
                                            <th>Working Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
        
                                        <!-- Pagination Next Tables-->
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
                        </div>
                    </div>
        
                    <!-- Vendors -->
                    <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                        <div class="card">
                            <div class="card-body colorbox">
                                <h5 class="card-title">Vendors</h5>
                                <!--Dropdown Button For Vendors-->
                                <div class="d-flex justify-content-between rounded">
                                    <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#vendor1">
                                        Add item
                                    </button>
                                      <!-- Search Bar-->
                                    <input type="text" class="form-control search-bar" placeholder="Search">
                                </div><br>
                                <!--Table-->
                                <table class="table bg-light rounded shadow-sm table-hover">
                                    <thead>
                                        <tr>
                                            <!-- Table content here -->
                                            <th>Working Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
        
                                        <!-- Pagination Next Tables-->
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
                        </div>
                    </div>
        
                    <!-- Delivery In -->
                    <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                        <div class="card">
                            <div class="card-body colorbox">
                                <h5 class="card-title">Delivery In</h5>
                                <!-- Button for Add item-->
                                <div class="d-flex justify-content-between rounded">
                                    <button type="button" class="btn colorbox btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Add item
                                    </button>
                                    <!-- Search Bar-->
                                    <input type="text" class="form-control search-bar" placeholder="Search">
                                </div><br>
                                <!--Table-->
                                <table class="table bg-light rounded shadow-sm table-hover">
                                    <thead>
                                        <tr>
                                            <!-- Table content here -->
                                            <th>Working Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
        
                                    <!-- Pagination Next Tables-->
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
                            </div>
                        </div>

                    </div>
                </div>
        <!-- End of Page Content -->

        </div>
    </div>

    
    <!-- ...Purchase Order Modal... -->

                <!-- Purchase Modal-->
                <div class="modal fade" id="purchase1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h3 class="modal-title">Purchase Order</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                            <!-- Your Purchase content goes here -->
                            <div class="container-fluid px-1">
                                <div class="mb-4">
                                    <!-- Label and Textbox -->
                                    <label for="vendorID" class="form-label">Vendor ID</label>
                                    <input type="number" class="form-control" id="vendorID" name="vendorId" required>
                                    <label for="vendorNAME" class="form-label">Vendor Name</label>
                                    <input type="text" class="form-control" id="vendorNAME" name="vendorName" required>
                                    <label for="dateTransaction" class="form-label">Date of Transaction</label>
                                    <input type="date" class="form-control" id="dateTransaction" name="dateTrans" required>
                                    <label for="expectedDelivery" class="form-label">Expected Delivery</label>
                                    <input type="date" class="form-control" id="expectedDelivery" name="expectDel" required><br>
                                </div>

                                <!-- Table for Items-->
                                <div class="row my-1">
                                    <h3 class="fs-4 mb-3">Items</h3>
                                    <div class="col">
                                        <table class="table colorbox rounded shadow-sm  table-hover" id="itemTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Item Name</th>
                                                    <th scope="col">QTY</th>
                                                    <th scope="col">UOM</th>
                                                    <th scope="col">Category</th>
                                                    <th>Add Row</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <!--Table Content-->
                                                    <th><input type="text" class="form-control" id="itemName" name="#" required></th>
                                                    <th><input type="text" class="form-control adjustments" id="qtY" name="#" required></th>
                                                    <th>            
                                                    <select class="form-select" id="uof" name="uof">
                                                        <option value="pieces">Pieces</option>
                                                        <option value="dozen">Dozen</option>
                                                        <option value="packs">Packs</option>
                                                        <option value="liters">Liters</option>
                                                    </select></th>
                                                    <th>            
                                                    <select class="form-select" id="category" name="category">
                                                        <option value="drinks">Drinks</option>
                                                        <option value="canfood">Can Food</option>
                                                        <option value="toilt">Toiletries</option>
                                                        <option value="junkfood">Junk Food</option>
                                                        <!-- Many Brands -->
                                                    </select></th>
                                                    <!--Added Input -->
                                                    <td><button class="btn btn-primary btn-sm btn-secondary" id="addItem" type="button"><i class="far fa-plus-circle"></i>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
    
                            <!-- ... Rest of your Purchase content ... -->
                        </div>
                            <!-- Modal Footer Goes here-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Add Item</button>
                              </div>

                        </div>
                        </div>
                    </div>
                </div>
                <!--End modal Purchase-->


    <!-- ...Vendors Modal... -->

                <!-- Vendor Modal-->
                <div class="modal fade" id="vendor1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h3 class="modal-title">Vendor Name</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                            <!-- Your Vendor1 content goes here -->
                            <form action="addvendor.php" method="post">
                            <div class="container-fluid px-1">
                                <div class="mb-4">
                                    <!-- Label and Textbox -->
                                    <label for="itemnameInput" class="form-label">Vendor ID</label>
                                    <input type="number" name="vendorId" class="form-control" id="itemnameInput" required>
                                    <label for="skuInput" class="form-label">Vendor Name</label>
                                    <input type="text" name="vendorName" class="form-control" id="skuInput" required>
                                    <label for="itemnameInput" class="form-label">Contact Number</label>
                                    <input type="number" class="form-control" name="vendorContact" id="itemnameInput" required>
                                </div>
    
                            <!-- ... Rest of your Vendor1 content ... -->
                        </div>
                            <!-- Modal Footer Goes here-->
                            <div class="modal-footer">
                                <button class="btn btn-primary">Add</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        </div>
                    </div>
                </div>
                <!--End modal Vendor-->

    <!-- ...Vendors Modal Ends Here... -->







        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        // Function to add a new row to the table
        function addRow() {
            const table = document.getElementById('itemTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow(table.rows.length);

            // Define the cell elements
            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            const cell3 = newRow.insertCell(2);
            const cell4 = newRow.insertCell(3);

            // Set default values or placeholders 
            // Table Purchase Order Input
            cell1.innerHTML = '<input type="text" class="form-control" id="itemName" name="#" required>';
            cell2.innerHTML = '<input type="text" class="form-control adjustments" id="qtY" name="#" required>';
            cell3.innerHTML = '<select class="form-select" id="uof" name="uof"> <option value="pieces">Pieces</option> <option value="dozen">Dozen</option> <option value="packs">Packs</option> <option value="liters">Liters</option> </select>';
            cell4.innerHTML = '<select class="form-select" id="category" name="category"> <option value="drinks">Drinks</option> <option value="canfood">Can Food</option> <option value="toilt">Toiletries</option> <option value="junkfood">Junk Food</option> </select>';
        }

        // Add an event listener to the "Add Item" button
        const addItemButton = document.getElementById('addItem');
        addItemButton.addEventListener('click', addRow);

    </script>

</body>
</html>