<?php

// import database connection variables
    require_once __DIR__ . '/db_connect.php';

    $connection = new DB_CONNECT();

    // array for JSON response
	$response = array();

    $caracteristica = $_POST['texto']; // Texto a buscar 

    $response["sitios"] = array();

    $sql = mysqli_query($connection->get_connection(),"SELECT *, AVG(Ratings.rating) as avg FROM AtractivosTuristicos, ItemTags, Ratings WHERE ItemTags.tag = '$caracteristica' AND AtractivosTuristicos.id = ItemTags.itemId and Ratings.itemId = AtractivosTuristicos.id 
           GROUP BY AtractivosTuristicos.id") or die(mysql_error());

        if(mysqli_num_rows($sql)!=0){

		    while ($row = mysqli_fetch_array($sql)) {
			    // temp user array
			    $sitio = array();
			    $sitio["id"] = utf8_encode($row["id"]);
			    $sitio["nombre"] = utf8_encode($row["nombre"]);
			    $sitio["url"] = utf8_encode($row["imagenUrl"]);
			    $sitio['avg'] = utf8_encode($row["avg"]);

			    // push single product into final response array
			    array_push($response["sitios"], $sitio);
    		}

    	$response["success"] = 1;
    	$response["message"] = "Sitios Encontrados";


        }else{

    	$response["success"] = 0;
    	$response["message"] = "Sitios no encontrados";

    }

    
    // echoing JSON response
    echo json_encode($response);

     // closing db connection,
    mysqli_close($connection->get_connection());


?>