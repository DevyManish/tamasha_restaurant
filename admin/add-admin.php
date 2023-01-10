<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>
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

<?php include('partials/footer.php'); ?>

<?php

// process the value from form & save it in database
// check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    $name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encryption with md5

    $sql = "INSERT INTO tbl_admin SET
                full_name = '$name',
                username = '$username',
                password = '$password'
                ";
    
    // echo $sql;
    // execute query and save data in data base
    $conn = mysqli_connect($server, $username, $password) or die(mysqli_connect_error());  //database connection
$db_select = mysqli_select_db($conn, $dbname) or die(mysqli_connect_error());//selecting database
  
    // $res = mysqli_query($conn, $sql) or die(mysqli_connect_error());
// if($res == true){
//         echo "data inserted";

// }
// else{
//         echo "error";
// }
    
}

?>