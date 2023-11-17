<?php 
include "../connectdb.php";
ob_start();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// Database connection
$sqlconn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($sqlconn->connect_error) {
    die("Connection failed: " . $sqlconn->connect_error);
}

// Fetch critical and reorder levels
$setting = "SELECT * FROM `setting_db`";
$setting_result = $sqlconn->query($setting);

if ($setting_rows = $setting_result->fetch_assoc()) {
    $critical = $setting_rows['critical'];
    $reorder = $setting_rows['reorder'];
}

// Fetch existing items
$queryExistingItems = "SELECT item_name, item_sku FROM items_db";
$resultExistingItems = mysqli_query($sqlconn, $queryExistingItems);

while ($rowExistingItems = mysqli_fetch_array($resultExistingItems)) {
    $existingItems[$rowExistingItems['item_sku']] = $rowExistingItems['item_name'];
}

// Items query
$item_query = "SELECT * FROM `items_db`";
$result_itemq = $sqlconn->query($item_query);

while ($row = $result_itemq->fetch_assoc()) {
    $itemStocks = $row['item_stocks'];

    if ($itemStocks <= $critical) {
        $message = "The item " . $row['item_name'] . " with the SKU of " . $row['item_sku'] . " is in critical level";
    } elseif ($itemStocks <= $reorder) {
        $message = "The item " . $row['item_name'] . " with the SKU of " . $row['item_sku'] . " is in reorder level";
    } else {
        continue;
    }
    if (isset($existingItems[$row['item_sku']])) {
        // Check if the notification already exists
        $checkQuery = "SELECT * FROM `notification_db` WHERE `message` = '$message'";
        $checkResult = mysqli_query($sqlconn, $checkQuery);

        if (!$checkResult) {
            die("Error checking notification: " . $sqlconn->error);
        }

        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO `notification_db` (`message`) VALUES ('$message')";
            $insertResult = $sqlconn->query($insertQuery);

            if (!$insertResult) {
                die("Error inserting notification: " . $sqlconn->error);
            }

            echo "data: Inserted: $message\n\n";
            ob_flush();
        }
    }
}

mysqli_close($sqlconn); 
?>