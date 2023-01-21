<?php include('partials/menu.php'); ?>

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
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Your Username">
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Your Password">
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
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encryption with md5

    //2.SQL Query to Save the data into databse
    $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

    // echo $sql;

    // $conn = mysqli_connect('localhost','root','') or die(mysqli_error());  //database connection
    // $db_select = mysqli_select_db($conn, 'restaurant') or die(mysqli_error());//selecting database

    //3. execute query and save data in data base
    $res = mysqli_query($conn, $sql) or die(mysqli_connect_error());

    // 4. Check whether the (query is executed) data is inserted or not and display appropriate message
    if ($res == true) {
        //data inserted
        //echo "Data inserted";
        //create a session var to display mssg
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully 👌</div>";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //Failed to insert data
        //echo "//Failed to insert data ";
        //create a session var to display mssg
        $_SESSION['add'] = "Fail To Add Admin ❌";
        //redirect page to add admin
        header("location:" . SITEURL . 'admWednesday Open 24 hours
        Thursday Open 24 hours
        Friday Open 24 hours
        Saturday Open 24 hours
        Sunday Open 24 hours
        Monday Open 2Wednesday Open 24 hours
        Thursday Open 24 hours
        Friday Open 24 hours
        Saturday Open 24 hours
        Sunday Open 24 hours
        Monday Open 2in/add-admin.php');
    }
}

?>

<?php include('partials/footer.php'); ?>