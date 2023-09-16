<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../styles.css" />
        <title>Setting</title>
    </head>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
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
                        <a href="../Reports/Reports.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-file-spreadsheet me-2"></i>Reports</a>
                        <a href="../Accounts/Accounts.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fad fa-users me-2"></i>Accounts</a>
                        <a href="../Notification/Notification.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-bell me-2"></i>Notification</a>
                        <a href="../Settings/Settings.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="far fa-cog me-2"></i>Setting</a>                            
                        <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                class="fas fa-power-off me-2"></i>Logout</a>
                    </div>
                </div>



        <!--Page Content-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left fs-4 me-3 " id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Setting</h2>
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
                            <i class="fas fa-user me-2"></i>My name
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../Profile/Profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="../Settings/Settings.php">Setting</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            </nav>

            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid mt-3">
                    <!-- Navigation Menu -->
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="notification-tab" data-bs-toggle="tab" href="#notification" role="tab" aria-controls="notification" aria-selected="true"><i class="fas fa-bell"></i> Notification</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="inventorysetting-tab" data-bs-toggle="tab" href="#inventorysetting" role="tab" aria-controls="inventorysetting" aria-selected="false"><i class="fas fa-box-full"></i> Inventory Setting</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="account-setting-tab" data-bs-toggle="tab" href="#account-setting" role="tab" aria-controls="account-setting" aria-selected="false"><i class="fas fa-cog"></i> Account Setting</a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Inside tab content -->
            <div class="container">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                            <h1 class="text-center">Notification Settings</h1>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Email Notifications</h5>
                                    <form>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="enableNotifications" checked>
                                            <label class="form-check-label" for="enableNotifications">Enable Email Notifications</label>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Notification Settings-->
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">Notification Preferences</h5>
                                    <form>
                                        <div class="form-group">
                                            <label for="outOfStock">Out of Stock:</label>
                                            <select class="form-control" id="outOfStock">
                                                <option value="on">Turn On</option>
                                                <option value="off">Turn Off</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="fullyStocked">Fully Stocked:</label>
                                            <select class="form-control" id="fullyStocked">
                                                <option value="on">Turn On</option>
                                                <option value="off">Turn Off</option>
                                            </select>
                                        </div>
                                        <!-- Add more notification preferences as needed -->
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Inventoroy Settings? -->
                    <div class="tab-pane fade" id="inventorysetting" role="tabpanel" aria-labelledby="inventorysetting-tab">
                        <h2>Inventory System Settings</h2>
                        <form>
                            <div class="form-group">
                                <label for="inventoryName">Inventory Name</label>
                                <input type="text" id="inventoryName" name="inventoryName" placeholder="Enter inventory name">
                            </div>
                            <div class="form-group">
                                <label for="currency">Currency</label>
                                <select id="currency" name="currency">
                                    <option value="yen">YEN - Japanese Yen</option>
                                    <option value="php">PHP - Philippine Peso</option>
                                    <option value="usd">USD - United States Dollar</option>
                                    <option value="eur">EUR - Euro</option>
                                    <option value="gbp">GBP - British Pound</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="timezone">Timezone</label>
                                <select id="timezone" name="timezone">
                                    <option value="est">EST - Eastern Standard Time</option>
                                    <option value="pst">PST - Pacific Standard Time</option>
                                    <option value="gmt">GMT - Greenwich Mean Time</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gamemode">Game mode</label>
                                <select id="gamemode" name="gamemode">
                                    <option value="Prd">Unli products</option>
                                    <option value="orders">Unli orders</option>
                                    <option value="pop">Unli pop</option>
                                </select>
                            </div>
                
                            <button type="submit">Save Settings</button>
                        </form>
                    </div>

                    <!-- Account Settings-->
                    <div class="tab-pane fade" id="account-setting" role="tabpanel" aria-labelledby="account-setting-tab">
                        <h2>Account Setting</h2>
                        <form>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" placeholder="Enter your username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Enter your password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select id="country" name="country">
                                    <option value="ph">Pilepens</option>
                                    <option value="ch">tsana</option>
                                    <option value="tw">tayone</option>
                                    <option value="hk">kangkong</option>
                                    <option value="jp">japanudes</option>
                                </select>
                            </div>
                            <button type="submit">Save Changes</button>
                        </form>
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
</html>