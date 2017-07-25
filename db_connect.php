<?php
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
    // constructor
    // con will hold the connection;
    private $con;
    function __construct() {
        // connecting to database
        $this->connect();
    }

    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '/db_config.php';
 
        // Connecting to mysql database
        $this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE) or die("Error in connection");

    }

    public function get_connection(){

        return $this ->con;
    }
 
}
 
?>