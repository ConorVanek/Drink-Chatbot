<?php

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

function get_image($img) {
	$html = '<img class="productimg" src = "' . $img . '" width=50% height=50% ><br>';
	return $html;
}

$input = $_GET["var"];

$name = "Response: ";
//echo json_encode($foo);
$serverName = "orion\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( "Database"=>"work_area", "ConnectionPooling"=>"false");

$conn = sqlsrv_connect( $serverName, $connectionInfo);



	if($conn) {
		
    	$sql = "EXEC [findProductMatch] ?";
		$params = array($input);

		$result = sqlsrv_query( $conn, $sql, $params);
		if( $sql === false ) {
			die( print_r( sqlsrv_errors(), true));
		}
		#Fetching Data by array
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			$name = $name . $row['name'];
			$img = $row['label_url'];
			echo(get_image($img));
			echo($name);
			break;
		}
	
		
	}
	else{
		
		$name = $name . "Could not get product name";
		console_log( sqlsrv_errors());
		console_log($name);
	}
	
?>