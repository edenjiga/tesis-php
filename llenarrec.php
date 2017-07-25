<?php 

    // import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

   $i=15;
while ($i <= 4005) {
	# code...
    $sql = mysqli_query($connection->get_connection(),"INSERT INTO Ratings (userId, itemId, rating) VALUES (0, '$i', 3)") or die(mysql_error());		
    $i= $i+10;

}

    // echoing JSON response
    echo json_encode($response);
	
	// closing db connection,
        mysqli_close($connection->get_connection());
?>