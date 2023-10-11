<?php
include "../connectdb.php";

$options = array();

if ($_GET['type'] === 'uom') {
    $sql_query = "SELECT * FROM uom_db";
} elseif ($_GET['type'] === 'category') {
    $sql_query = "SELECT * FROM category_db";
}

$sql_res = mysqli_query($sqlconn, $sql_query);

while ($array = mysqli_fetch_array($sql_res)) {
    $value = $array['id'];
    $label = ($_GET['type'] === 'uom') ? $array['uom_name'] : $array['category_name'];
    
    $options[] = array('value' => $value, 'label' => $label);

}

header('Content-Type: application/json');
echo json_encode($options);
?>