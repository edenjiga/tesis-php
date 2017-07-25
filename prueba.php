<?php 

    // import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

    // array for JSON response
	$response = array();

	//Recibe the dates

	$userid = $_POST['userid'];
	$rarestring = $_POST['rarestring']; // rare String
	$largepassword = $_POST['largepassword']; // new password
	$nuevasalt= $_POST['nuevasalt'];


	$sql = mysqli_query($connection->get_connection(),"SELECT * FROM Users WHERE id = '$userid'") or die(mysql_error());

	if(mysqli_num_rows($sql)==1){


		 $sql = mysqli_query($connection->get_connection(),"UPDATE Users SET salt = '$nuevasalt', password = '$largepassword' WHERE id = '$userid'") or die(mysql_error());


		 if($sql){
		 	   $response["success"] = 1;
     		   $response["message"] = "success";
		 }else{
		 	      $response["success"] = 0;
     			  $response["message"] = "Something wrong happen";
		 }

    }else{         $response["success"] = 0;         $response["message"] =
"Oops! A error occurred.";

	}

    // echoing JSON response
    echo json_encode($response);
    // closing db connection,
  	mysqli_close($connection->get_connection());
?>