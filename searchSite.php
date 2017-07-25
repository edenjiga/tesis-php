<?php 

  
  // import database connection variables
  require_once __DIR__ . '/db_connect.php';

  $connection = new DB_CONNECT();

  // array for JSON response
  $response = array();

  $name = $_POST['name'];


  // Array for Sitios
  $response["sitios"] = array();
  
  $sql = mysqli_query($connection->get_connection(),"SELECT * FROM AtractivosTuristicos WHERE nombre LIKE '%$name%' LIMIT 5") or die(mysql_error());

    if((mysqli_num_rows($sql))!=0 && (mysqli_num_rows($sql)<=5)){

      while ($row = mysqli_fetch_array($sql)) {
        // temp user array
        $sitio = array();
        $sitio["id"] = utf8_encode($row["id"]);
        $sitio["nombre"] = utf8_encode($row["nombre"]);
        // push single product into final response array
        array_push($response["sitios"], $sitio);
      }


        $response["success"] = 1;
    }else{
        $response["success"] = 0; 
    }

  
  // Response in json code
  echo json_encode($response, JSON_UNESCAPED_UNICODE);
  // closing db connection,
  mysqli_close($connection->get_connection());



?>