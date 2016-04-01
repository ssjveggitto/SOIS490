<?php //Initiate the class
$path = '../../../../config/db/db.php';
if (file_exists($path)) {
    require($path);
    echo '<script>console.log("database connected");</script>';
} else {
        echo '<script>console.log("database is not connected");</script>';
}
$database = new DB();
//OR...
$database = DB::getInstance();
/**
 * Filter all post data
 */
$_POST['name'] = 'This database class is "super awesome" & whatnots';
if( isset( $_POST ) )
{
    foreach( $_POST as $key => $value )
    {
        $_POST[$key] = $database->filter( $value );
    }
}
echo '<pre>';
print_r($_POST);
echo '</pre>';
/**
 * Auto filter an entire array
 */
$array = array(
    'name' => array( 'first' => '"Super awesome"' ), 
    'email' => '%&&<stuff', 
    'something_else' => "'single quotes are awesome'"
);
$array = $database->filter( $array );
echo '<pre>';
print_r($array);
echo '</pre>';
/**
 * Retrieve results of a standard query
 */
$query = "SELECT group_name FROM example_phpmvc";
$results = $database->get_results( $query );
foreach( $results as $row )
{
    echo $row['group_name'] .'<br />';
}
/**
 * Retrieving a single row of data
 */
$query = "SELECT group_id, group_name, group_parent FROM example_phpmvc WHERE group_name LIKE '%Awesome%'";
if( $database->num_rows( $query ) > 0 )
{
    list( $id, $name, $parent ) = $database->get_row( $query );
    echo "<p>With an ID of $id, $name has a parent of $parent</p>";
}
else
{
    echo 'No results found for a group name like &quot;production&quot;';
}
/**
 * Inserting data
 */
//The fields and values to insert
$names = array(
    'group_parent' => 18,
    'group_name' => mt_rand(0, 500) //Random thing to insert
);
$add_query = $database->insert( 'example_phpmvc', $names );
if( $add_query )
{
    echo '<p>Successfully inserted &quot;'. $names['group_name']. '&quot; into the database.</p>';
}
$last = $database->lastid();
/**
 * Insert multiple records in single query
 */
//Field names
$fields = array(
    'group_parent', 
    'group_name'
);
//Values to insert
$records = array(
    array(
        9, 'Record 9'
    ), 
    array(
        7, 'Record 7'
    ), 
    array(
        7, 'Nick', 'nick@nick.com', 1, 'This will not be added'
    ), 
    array(
        2, 'This is awesome'
    )
);
$inserted = $database->insert_multi( 'example_phpmvc', $fields, $records );
if( $inserted )
{
    echo '<p>'.$inserted .' records inserted</p>';
}
/**
 * Updating data
 */
//Fields and values to update
$update = array(
    'group_name' => md5( mt_rand(0, 500) ), 
    'group_parent' => 91
);
//Add the WHERE clauses
$where_clause = array(
    'group_id' => $last
);
$updated = $database->update( 'example_phpmvc', $update, $where_clause, 1 );
if( $updated )
{
    echo '<p>Successfully updated '.$where_clause['group_id']. ' to '. $update['group_name'].'</p>';
}
/**
 * Deleting data
 */
//Run a query to delete rows from table where id = 3 and name = Awesome, LIMIT 1
$delete = array(
    'group_id' => 15,
    'group_name' => 'Production Tools (updated)'
);
$deleted = $database->delete( 'example_phpmvc', $delete, 1 );
if( $deleted )
{
    echo '<p>Successfully deleted '.$delete['group_name'] .' from the database.</p>';
}
/**
 * Checking to see if a value exists
 */
$check_column = 'group_id';
$check_for = array( 'group_name' => 'Resources' );
$exists = $database->exists( 'example_phpmvc', $check_column,  $check_for );
if( $exists )
{
    echo '<p>Bennett DOES exist!</p>';
}
/**
 * Checking to see if a table exists
 */
if( !$database->table_exists( 'example_phpmvc' ) )
{
    //Run a table install, the table doesn't exist
}
/**
 * Truncating tables
 * Commented out intentionally (just in case!)
 */
//Truncate a single table, no output display
//$truncate = $database->truncate( array('example_phpmvc') );
//Truncate multiple tables, display number of tables truncated
//echo $database->truncate( array('example_phpmvc', 'my_other_table') );
/**
 * List the fields in a table
 */
$fields = $database->list_fields( "SELECT * FROM example_phpmvc" );
echo '<pre>';
print_r( $fields );
echo '</pre>';
/**
 * Output the number of fields in a table
 */
echo $database->num_fields( "SELECT * FROM example_phpmvc" );
/**
 * Display the number of queries performed by the class
 * Applies across multiple instances of the DB class
 */
echo '<hr />' . $database->total_queries();

?>
<hr>
<h1>Test Area</h1>
<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Vendor</th>
            <th>Size</th>
            <th>Wholesale Cost</th>
            <th>Retail Price</th>
            <th>Quantity</th>
            <th>UPC</th>
        </tr>
    </thead>
    <tbody>
<?php 
$query = "select product_id, brand, product.name as name, vendor.name as vendor, size, wholesale_cost, retail_price, quantity, upc_code from product inner join vendor on(product.vendor_id = vendor.vendor_id);";
$results = $database->get_results( $query );
foreach( $results as $row ) {
    echo '  <tr>
            <td>'. $row['product_id'] .'</td>
            <td>'. $row['brand'] .'</td>
            <td>'. $row['name'] .'</td>
            <td>'. $row['vendor'] .'</td>
            <td>'. $row['size'] .'</td>
            <td>'. $row['wholesale_cost'] .'</td>
            <td>'. $row['retail_price'] .'</td>
            <td>'. $row['quantity'] .'</td>
            <td>'. $row['upc_code'] .'</td>
            </tr>';
}
?>
</tbody>        