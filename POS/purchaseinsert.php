<?php
include "../connectdb.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_POST['skubarcode'])) {

    $input_sku = $_POST['skubarcode'];

    if(!empty($input_sku)) {
        try {
            $select_query = "SELECT * FROM items_db WHERE item_barcode = $input_sku ORDER BY `item_date_added` ASC LIMIT 1";
            $result_query = mysqli_query($sqlconn, $select_query);
            if($result_query === false) {
                echo $conn->error;
            }
            else {
                if(mysqli_num_rows($result_query) === 1) {
                    $rows = mysqli_fetch_assoc($result_query);
                    $itemsku = $rows['item_barcode'];
                    $itemname = $rows['item_name'];
                    $itemprice = $rows['item_price'];
                    $itemStocks = $rows['item_stocks'];
                    if($itemStocks <= 0) {
                        $table_row = "<tr>";
                        $table_row .= '<td><input class="form-control adjustments qty" type="number" value="1"></td>';  
                                        
                                        $table_row .='<td colspan="4">No Stocks</td>';
                                        $table_row .= '<td><button class="btn btn-primary btn-sm btn-danger del-row"><i class="fas fa-trash"></i></button></td>';
                        $table_row .= '</tr>';
    
                        echo $table_row;
                    }
                    else {
                        // addtoPosTable($itemsku, $itemname, $itemprice);
                        $table_row = "<tr>";
                        $table_row .= '<td><input class="form-control adjustments qty" type="number" value="1"></td>';  
                                        
                                        $table_row .='<td class="sku">'. $itemsku . '</td>';
                                        $table_row .= '<td class="item-name">' . $itemname .'</td>';
                                        $table_row .= '<td class="price">'. $itemprice .'</td>';
                                        $table_row .= '<td class="totalPrice">' . $itemprice . '</td>';
                                        $table_row .= '<td><button class="btn btn-primary btn-sm btn-danger del-row"><i class="fas fa-trash"></i></button></td>';
                        $table_row .= '</tr>';
    
                        echo $table_row;
                    }
                }
            }
        }
        catch (Exception $e) {
            echo $e;
        }
    }
    

}


?>