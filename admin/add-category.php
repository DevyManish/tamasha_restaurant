<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>


        <?php
        if (isset($_SESSION['add'])) { //checking whether session is set of that
            echo $_SESSION['add']; //displaying session message if set
            unset($_SESSION['add']); //removinging session message
        }
        ?>
        <br><br>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td><input type="radio" name="featured" value="Yes"> Yes
                    <td><input type="radio" name="featured" value="No"> No
                </tr>
                <tr>
                    <td>Active: </td>
                    <td><input type="radio" name="active" value="Yes"> Yes
                    <td><input type="radio" name="active" value="No"> No
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-------MAIN CONTENT SECTION END----->



<?php

// process the value from form & save it in database
// check whether the submit button is clicked or not


//1. Get the data from form
if (isset($_POST['submit'])) {
    //1. Get the data from form
    $title = $_POST['title'];
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active']; //password encryption with md5
    } else {
        $active = "No";
    }
    //2.SQL Query to Save the data into databse
    $sql = "INSERT INTO tbl_category SET
            title = '$title',
            featured = '$featured',
            active = '$active'
        ";

    // echo $sql;

    // $conn = mysqli_connect('localhost','root','') or die(mysqli_error());  //database connection
    // $db_select = mysqli_select_db($conn, 'restaurant') or die(mysqli_error());//selecting database

    //3. execute query and save data in data base
    $res = mysqli_query($conn, $sql) or die(mysqli_connect_error());

    // 4. Check whether the (query is executed) data is inserted or not and display appropriate message
    if ($res == true) {
        // echo "success";
        //     // query executed and catagory added
        $_SESSION['add'] = "<div class='success'>Category Added SuccessFully</div>";
        // redirect to the manage category page
        header('location:' . SITEURL . 'admin/manage-category.php');

    } else {

        $_SESSION['add'] = "<div class='error'>Failed To Add Category</div>";
        // redirect to the manage category page
        header('location:' . SITEURL . 'admin/add-category.php');

    }
}

?>
<!-- <div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br> -->
<?php
// if (isset($_SESSION['add'])) {
//     echo $_SESSION['add']; //displaying session message
//     unset($_SESSION['add']); //removing session message
// }
?>

<!-- <br> -->
<!-- <br> -->
<!-- add-category form starts here
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                <tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form> 

    add-category form ends here -->


<?php
// check whether the submit button clicked or not
// if (isset($_POST['submit'])) {
//     // echo "clicked";

//     // 1.get the value from form
//     $title = $_POST['title'];
//     // for radio input type we need to check whether the button selected or not
// if (isset($_POST['featured'])) {
//         $featured = $_POST['featured'];
// }
// else{
//         $featured = "No";
// }
// if (isset($_POST['active'])) {
//         $active = $_POST['active'];
// }
// else{
//         $active = "No";
// }
//     $sql = "INSERT INTO tbl_category SET
// title = '$title',
// featured='$featured',
// active='$active'
// ";
//     $res = mysqli_query($conn, $sql);



// // 4.Check whether the (query is executed) data is added or not 
// if ($res == true) {
//     echo "success";
//     // query executed and catagory added
//     // $_SESSION['add'] = "<div class='success'>Category Added SuccessFully</div>";
//     // // redirect to the manage category page
//     // header('location:' . SITEURL . 'admin/manage-category.php');
// } else {
//     // failed to add catagory
//     echo "failed";
//     // $_SESSION['add'] = "<div class='error'>Failed To Add Category</div>";
//     // // redirect to the manage category page
//     // header('location:' . SITEURL . 'admin/add-category.php');

// }
// }

?>


<!-- </div>
</div> -->









<?php include('partials/footer.php'); ?>