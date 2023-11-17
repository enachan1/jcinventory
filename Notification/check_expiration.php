<?php
include "../connectdb.php";
ob_start();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$currentDate = time();
$existingItems = array();

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

$query = "SELECT * FROM items_db";
$result = mysqli_query($sqlconn, $query);

while ($row = mysqli_fetch_array($result)) {
    $expDate = strtotime($row['item_expdate']);
    $itemStocks = $row['item_stocks'];
    $dateDifference = $expDate - $currentDate;

    if ($dateDifference <= 0) {
        $message = "The item " . $row['item_name'] . " with the SKU of " . $row['item_sku'] . " is expired";
    } elseif ($dateDifference <= 1296000) { 
        $message = "The item " . $row['item_name'] . " with the SKU of " . $row['item_sku'] . " is about to expire";
    }
    elseif ($itemStocks <= $critical) {
        $message = "The item " . $row['item_name'] . " with the SKU of " . $row['item_sku'] . " is in critical level";
    } elseif ($itemStocks <= $reorder) {
        $message = "The item " . $row['item_name'] . " with the SKU of " . $row['item_sku'] . " is in reorder level";
    } else {
        continue;
    }

    // Check if the item still exists in the list of existing items
    if (isset($existingItems[$row['item_sku']])) {
        // Check if the notification already exists
        $checkQuery = "SELECT * FROM `notification_db` WHERE `message` = '$message'";
        $checkResult = mysqli_query($sqlconn, $checkQuery);

        if (mysqli_num_rows($checkResult) == 0) {
            $insertQuery = "INSERT INTO `notification_db` (`message`) VALUES ('$message')";
            $sqlconn->query($insertQuery);
            echo "data: Inserted: $message\n\n";
            ob_flush();
        }
    }
}

mysqli_close($sqlconn);
?>
