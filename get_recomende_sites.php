<?php

    // import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

    // array for JSON response
	$response = array();

    $user = $_POST['user'];

    $response["sitios"] = array();


    $sql = mysqli_query($connection->get_connection(),"SELECT * FROM sitios LIMIT 0,5") or die(mysql_error());

    if(mysqli_num_rows($sql)!=0){

        while ($row = mysqli_fetch_array($sql)) {
        // temp user array
        $sitio = array();
        $sitio["id"] = utf8_encode($row["id"]);
        $sitio["nombre"] = utf8_encode($row["nombre"]);
        $sitio["rating"] = utf8_encode($row["rating"]);
        $sitio["ulr"] = utf8_encode($row["url"]);
 
        // push single product into final response array
        array_push($response["sitios"], $sitio);
    }

    	if($sql){

    		$response["success"] = 1;
    		$response["message"] = "User created correctly.";
    	
    	}else{

    		$response["success"] = 0;
    		$response["message"] = "Oops! A error occurred.";
    	}


    }else{

    	$response["success"] = 0;
    	$response["message"] = "User alredy exist.";

    }

    // echoing JSON response
    echo json_encode($response);

     // closing db connection,
    mysqli_close($connection->get_connection());

?>