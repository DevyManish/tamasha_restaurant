<?php

    //Starat Session
    session_start();

    //Create constrants to store non repeating values
    define('SITEURL','http://localhost/tamasha_restaurant/');
    // Pratyush Database

    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'restaurant');

    // online Database
    // define('LOCALHOST', 'bepvfzrf1hb8tfsaowuc-mysql.services.clever-cloud.com');
    // define('DB_USERNAME', 'uwwxerkfhuyaqpkr');
    // define('DB_PASSWORD', 'eqbOEeedQ6EyPiLiRdPB');
    // define('DB_NAME', 'bepvfzrf1hb8tfsaowuc');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());  //database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());//selecting database

    
?>