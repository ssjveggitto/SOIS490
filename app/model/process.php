<?php
	$db_path = '../../config/db/db.php';
	if(file_exists($db_path)) {
		require($db_path);
		//echo '<script>console.log("database connected");</script>';
	} else {
		//echo '<script>console.log("database is not connected in the model");</script>';
	}

	$database = DB::getInstance();
	
	/*echo $_POST['staff_id']. '<br>';
	echo $_POST['customer_id']. '<br>';
	echo $_POST['date_value']. '<br>';
	echo $_POST['time_start']. '<br>';
	echo $_POST['time_end']. '<br>';
	echo $_POST['promotion_id']. '<br>';
	echo $_POST['resources']. '<br>';*/
	
	/*foreach ($_POST as $key => $value){
        echo "$key => $value<br>";
        if(is_array($value)){ //If $value is an array, print it as well!
            printArray($value);
        }  
    }*/

	$statement = '';
	$start_timestamp = $_POST['date_value'] .' '. date('H:i:s', strtotime($_POST['time_start']));
	$end_timestamp = $_POST['date_value'] .' '. date('H:i:s', strtotime($_POST['time_end']));
	$resources = $_['resources'];
	if($resources == null || $resources == "")
		$resources = 'null';
	
	if ($_POST['delete'] == 'Delete')
	{
		$statement = 'delete from appointment where appointment_id = '. $_POST['appointment_id'] .';';
	} else {
		if($_POST['sql_action'] == 'Insert')
		{
			$statement = 'insert into appointment (customer_id, end_timestamp, service_id, staff_id, start_timestamp, resources, promotion_id) values ('. $_POST['customer_id'] .',\''.  $end_timestamp .'\','. $_POST['service_id'] .','. $_POST['staff_id'] .',\''. $start_timestamp .'\','. $resources .','. $_POST['promotion_id'] .');';			
		} else if($_POST['sql_action'] == 'Update')
		{
			$statement = 'update appointment set customer_id = '. $_POST['customer_id'] .', end_timestamp = \''. $end_timestamp . '\', service_id = '. $_POST['service_id'] .', staff_id = '. $_POST['staff_id'] .', start_timestamp = \''. $start_timestamp .'\', resources = '. $resources .', promotion_id = '. $_POST['promotion_id'] .' where appointment_id = '. $_POST['appointment_id'] .';';
		}
	}
	
	
	
	
	//echo $statement;
	
	$database->query($statement);	
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);	
?>