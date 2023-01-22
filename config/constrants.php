<?php

    //Starat Session
    session_start();



    //Create constrants to store non repeating values
    define('SITEURL','http://localhost/tamasha_restaurant/');
    // pratyush localhost

    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'restaurant');

    // online localhost
    
    // define('LOCALHOST', 'sql12.freesqldatabase.com');
    // define('DB_USERNAME', 'sql12592401');
    // define('DB_PASSWORD', '3GCBGEzQrG');
    // define('DB_NAME', 'sql12592401');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());  //database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());//selecting database

    
?>