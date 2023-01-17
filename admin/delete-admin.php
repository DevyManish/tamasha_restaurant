<?php

    //      Include constraints.php
    include('../config/constrants.php');

    //1.get the id to be deleted
    $id = $_GET['id'];

    //2.create query to delete the admin
    $sql = "DELETE FROM tbl_admin WHERE id =$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the Query executed successfully or not
    if($res==true)
    {
        //Query executed and admin  deleted 
        // echo "Admin deleted";
        //create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully 👌 </div>";
        //redirect to admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Query failed to  delete
        // echo "Fail to deleted";
        //create session variable to display message
        $_SESSION['delete'] = "<div class='error'>Failed to Delete the Admin ❌</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3.Redirect to admin page with message (success/error)

?>