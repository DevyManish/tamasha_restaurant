<?php

//      Include constraints.php
include('../config/constrants.php');

// echo "category deleted";
// check whether the id and image_name value is set or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {

    // get the value and delete
    // echo " get the value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // remove the physical image file is available
if ($image_name="") {

    // image is available so remove it
        $path = "../images/category/".$image_name;

        // remove the image
        $remove = unlink($path);

    // if failed to remove image then add an error messege and stop the process
        if ($remove==false) {
            // set the session messege 
            $_SESSION['remove'] = "<div class='error'>Failed to Remove the Category Image!!</div>";
            // redirect to manage-category page
            header('location:'.SITEURL.'admin/manage-category.php');
            // stop the process
            die();
        }
}
    

    // delete data from database
    // sql query to delete data from database
    $sql = "DELETE FROM tbl_category WHERE id = $id";

    // delete the query
    $res = mysqli_query($conn, $sql);

    // check whther the data is deleted form database or not
    if ($res==true) {
        // set success messsge and redirect
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        // redirect to manage-category
        header('location:'.SITEURL.'admin/manage-category.php');

    }
    else{
        // set error messege and redirect
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category!!!</div>";
        // redirect to manage-category
        header('location:'.SITEURL.'admin/manage-category.php');
    }






} else {
    // redirect to manage-category page
    header('location:'.SITEURL.'admin/manage-category.php');
}
