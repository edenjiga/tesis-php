<?php

    // import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

    // array for JSON response
	$response = array();

	// We receive the values, largepassword is the password generate in sha-512
    $user = $_POST['user'];
    $email = $_POST['email'];
    $salt = $_POST['salt'];
    $largepassword = $_POST['largepassword'];

    // Check if the user exists, if the user does exist, we add to the table

    $sql = mysqli_query($connection->get_connection(),"SELECT * FROM Users WHERE name = '$user'") or die(mysql_error());

    if(mysqli_num_rows($sql)==0){

    	$sql = mysqli_query($connection->get_connection(),"INSERT INTO Users (name, email, salt, password) VALUES ('$user', '$email', '$salt', '$largepassword')");

        // verificamos que se haya podido crear el usuario para luego agregarle una recomendacion
        if($sql){
            $response["success"] = 1;
            $response["message"] = "User created correctly.";
        }else{

        $response["success"] = 0;
        $response["message"] = "User alredy exist.";

        }
    }else{

    	$response["success"] = 0;
    	$response["message"] = "User alredy exist.";

    }

    // echoing JSON response
    echo json_encode($response);

?>