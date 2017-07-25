<?php

    // import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

    $response = array();
    
    $user= $_POST['user'];

	$sql = mysqli_query($connection->get_connection(),"SELECT * FROM Users WHERE name = '$user'") or die(mysql_error());

	if(mysqli_num_rows($sql)==1){

		$row = mysqli_fetch_array($sql);

        $response["userid"] = $row["id"];
        $response["salt"] = $row["salt"];
        $response["password"] = $row["password"]; 

		$response["success"] = 1;
    	$response["message"] = "You are login";

	}else{
    	$response["success"] = 0;
    	$response["message"] = "Oops! A error occurred."; 
	}
	
	// echoing JSON response
    echo json_encode($response);
	
	// closing db connection,
        mysqli_close($connection->get_connection());
?>