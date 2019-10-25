<?php

    define("SERVER", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DBNAME", "ENTER_DB_NAME");

    // Connect to MySQL DB
    $db = mysqli_connect(SERVER, USER, PASSWORD, DBNAME) or die("Failed to connect");

?>