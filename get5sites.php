<?php

    // import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

    // array for JSON response
	$response = array();

    $id_user = $_POST['user'];

    $response["sitios"] = array();


    $sql = mysqli_query($connection->get_connection(),"SELECT * FROM 
        (Select Ratings.itemId, AVG(rating) as avg
        FROM Ratings
        Group By Ratings.itemId) t1,
        UserRecommend,
        AtractivosTuristicos
        WHERE UserRecommend.userId = '$id_user' and AtractivosTuristicos.id = UserRecommend.itemId and t1.itemId = AtractivosTuristicos.id ORDER BY score LIMIT 0,5") or die(mysql_error());

    if(mysqli_num_rows($sql)!=0){

        while ($row = mysqli_fetch_array($sql)) {
        // temp user array
        $sitio = array();
        $sitio["id"] = utf8_encode($row["id"]);
        $sitio["nombre"] = utf8_encode($row["nombre"]);
        $sitio["avg"] = utf8_encode($row["avg"]);
        $sitio["url"] = utf8_encode($row["imagenUrl"]);
 
        // push single product into final response array
        array_push($response["sitios"], $sitio);
        }
    }else{
        // en caso que no se hayan encontrado sitios por que no ha recomendado
        $sql = mysqli_query($connection->get_connection(),"SELECT * FROM 
        (Select Ratings.itemId, AVG(rating) as avg
        FROM Ratings
        Group By Ratings.itemId) t1,
        UserRecommend,
        AtractivosTuristicos
        WHERE UserRecommend.userId = 0 and AtractivosTuristicos.id = UserRecommend.itemId and t1.itemId = AtractivosTuristicos.id ORDER BY score LIMIT 0,5") or die(mysql_error());

        if(mysqli_num_rows($sql)!=0){

            while ($row = mysqli_fetch_array($sql)) {
            // temp user array
            $sitio = array();
            $sitio["id"] = utf8_encode($row["id"]);
            $sitio["nombre"] = utf8_encode($row["nombre"]);
            $sitio["avg"] = utf8_encode($row["avg"]);
            $sitio["url"] = utf8_encode($row["imagenUrl"]);
     
            // push single product into final response array
            array_push($response["sitios"], $sitio);
            }
        }

    }

	if($sql!=0){

		$response["success"] = 1;
		$response["message"] = "Sitios encontrados";
	
	}else{

		$response["success"] = 0;
		$response["message"] = "Oops! A error occurred.";
	}

    // echoing JSON response
    echo json_encode($response);

     // closing db connection,
    mysqli_close($connection->get_connection());

?>