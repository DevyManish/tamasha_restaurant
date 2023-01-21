
<?php
// include constraints.php for url
include ('../config/constrants.php');

// 1.Destroy the session 
session_destroy(); //onset $_SESSION['user]

// 2.redirect to the login page
header('location:'.SITEURL.'admin/login.php');

?>