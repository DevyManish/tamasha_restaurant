<?php
// authorization -Access Control
// check whether the user is logged in or not
if (!isset($_SESSION['user'])) //if user session is not set
 {
    // user is not logged in
    // redirect to login page with messsge
    $_SESSION['no-login-messege'] = "<div class='error text-center'>Please login to access login panel</div>";
// redirect to login page 
header('location:' . SITEURL . 'admin/login.php');
}
?>