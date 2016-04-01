<?php //Initiate the class
$db_path = '../../../../config/db/db.php';
if (file_exists($db_path)) {
    require($db_path);
    echo '<script>console.log("database connected");</script>';
} else {
        echo '<script>console.log("database is not connected in the model");</script>';
}
$database = new DB();
//OR...
$database = DB::getInstance();

$query = "select product_id, brand, product.name as name, vendor.name as vendor, size, wholesale_cost, retail_price, quantity, upc_code from product inner join vendor on(product.vendor_id = vendor.vendor_id);";
$results = $database->get_results( $query );
foreach( $results as $row ) {
    echo '  <tr>
            <td>'. $row['product_id'] .'</td>
            <td>'. $row['brand'] .'</td>
            <td>'. $row['name'] .'</td>
            <td>'. $row['vendor'] .'</td>
            <td>'. $row['size'] .'</td>
            <td>$'. $row['wholesale_cost'] .'</td>
            <td>$'. $row['retail_price'] .'</td>
            <td>'. $row['quantity'] .'</td>
            <td>'. $row['upc_code'] .'</td>
            </tr>';
}
?>