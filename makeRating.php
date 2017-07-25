<?php 

    // import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

   $id_place = $_POST['id_place'];
   $id_user = $_POST['id_user'];
   $rating = $_POST['rating'];

  // array for JSON response
  $response = array();

   $sql = mysqli_query($connection->get_connection(),"SELECT * FROM Ratings WHERE userId = '$id_user' and itemId = '$id_place' ") or die(mysql_error());

   if(mysqli_num_rows($sql)==1){


      $sql = mysqli_query($connection->get_connection(),"UPDATE Ratings SET rating = '$rating' WHERE userId = '$id_user' and itemId = '$id_place' ") or die(mysql_error());

  	     if ($sql){
     
      $response["success"] = 1;
      $response["message"] = "success"; 
  }else{

      $response["success"] = 0;
      $response["message"] = "Something wrong happen";

  }


	}else{

     $sql = mysqli_query($connection->get_connection(),"INSERT INTO Ratings (userId, itemId, rating) VALUES ('$id_user', '$id_place', '$rating')") or die(mysql_error());

     if ($sql){
     
    	$response["success"] = 1;
    	$response["message"] = "success"; 
	}else{

      $response["success"] = 0;
      $response["message"] = "Something wrong happen";

  }
}
		// echoing JSON response
    echo json_encode($response);
	
	// closing db connection,
        mysqli_close($connection->get_connection());


?>