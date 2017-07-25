<?php 

    // import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

   $id_place = $_POST['id_place'];
   $id_user = $_POST['id_user'];

   $sql = mysqli_query($connection->get_connection(),"SELECT * FROM AtractivosTuristicos WHERE id = '$id_place'") or die(mysql_error());

   if(mysqli_num_rows($sql)==1){

   		$row = mysqli_fetch_array($sql);
        $response["id_place"] = utf8_encode($row["id"]);
        $response["nombre"] = utf8_encode($row["nombre"]);
        $response["municipio"] = utf8_encode($row["municipio"]); 
        $response["departamento"] = utf8_encode($row["departamento"]); 
        $response["imagenUrl"] = utf8_encode($row["imagenUrl"]); 

		$response["success"] = 1;
    	$response["message"] = "success";

	}else{
    	$response["success"] = 0;
    	$response["message"] = "Oops! A error occurred."; 
	}

		// echoing JSON response
    echo json_encode($response);
	
	// closing db connection,
        mysqli_close($connection->get_connection());


?>