<?php

// include constrants.php
include('../config/constrants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // process to delete
    // echo "process to delete";

    // 1.get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2.remove the image if available
    // check whether the image available or not and delete only if available
    if ($image_name = "") {
        // it has image and need to remove from folder
        // get the image path
        $path = "../images/food/" . $image_name;

        // remove image file from folder
        $remove = unlink($path);

        // check whether the image is removed or not
        if ($remove == false) {
            // failed to remove image
            $_SESSION['remove'] = "<div class='error'>Failed to Remove the Image!!</div>";
            // redirect to manage-food page
            header('location:' . SITEURL . 'admin/manage-food.php');
            // stop the process
            die();
        }
    }

    // 3.delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whther the data is deleted form database or not
    if ($res == true) {
        // set success messsge and redirect
        $_SESSION['delete'] = "<div class='success'><h2>Food Deleted Successfully</h2></div>";
        // redirect to manage-category
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        // set error messege and redirect
        $_SESSION['delete'] = "<div class='error'><h2>Failed to Delete Food!!!</h2></div>";
        // redirect to manage-category
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    // redirect to manage food page
    $_SESSION['delete'] = "<div class='error'><h2>Unauthorize Access</h2></div>";
    // redirect to manage-category
    header('location:' . SITEURL . 'admin/manage-food.php');
}

?>