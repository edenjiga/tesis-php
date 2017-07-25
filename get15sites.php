<?php

    // import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

    // array for JSON response
	$response = array();

    $id_user = $_POST['userid'];

    $response["sitios"] = array();


    $sql = mysqli_query($connection->get_connection(),"SELECT * FROM AtractivosTuristicos , UserRecommend WHERE UserRecommend.userId = '$id_user' and AtractivosTuristicos.id = UserRecommend.itemId  ORDER BY score LIMIT 6,20") or die(mysql_error());

    if(mysqli_num_rows($sql)!=0){

        while ($row = mysqli_fetch_array($sql)) {
        // temp user array
        $sitio = array();
        $sitio["id"] = utf8_encode($row["id"]);
        $sitio["nombre"] = utf8_encode($row["nombre"]);
        $sitio["url"] = utf8_encode($row["imagenUrl"]);
 
        // push single product into final response array
        array_push($response["sitios"], $sitio);
        }
    }else{
         $sql = mysqli_query($connection->get_connection(),"SELECT * FROM AtractivosTuristicos , UserRecommend WHERE UserRecommend.userId = 0 and AtractivosTuristicos.id = UserRecommend.itemId  ORDER BY score LIMIT 6,20") or die(mysql_error());
             if(mysqli_num_rows($sql)!=0){

                while ($row = mysqli_fetch_array($sql)) {
                // temp user array
                $sitio = array();
                $sitio["id"] = utf8_encode($row["id"]);
                $sitio["nombre"] = utf8_encode($row["nombre"]);
                $sitio["url"] = utf8_encode($row["imagenUrl"]);
         
                // push single product into final response array
                array_push($response["sitios"], $sitio);
                }
            }   
        }

    	if($sql!=0){

    		$response["success"] = 1;
    		$response["message"] = "Sitios encontrados.";
    	
    	}else{

    		$response["success"] = 0;
    		$response["message"] = "Oops! A error occurred.";
    	}

    // echoing JSON response
    echo json_encode($response);

     // closing db connection,
    mysqli_close($connection->get_connection());

?>