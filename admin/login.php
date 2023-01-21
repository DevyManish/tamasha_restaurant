<?php
include('../config/constrants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>admin login</title>
    <meta name="description" content="Roughly 155 characters">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
            <div class="login">
                <h1 class="text-center">ADMIN LOGIN</h1>
                <br><br>
                <?php
                if (isset($_SESSION['login'])) { //checking whether session is set of that
                    echo $_SESSION['login']; //displaying session message if set
                    unset($_SESSION['login']); //removinging session message
                
                }
                if (isset($_SESSION['no-login-messege'])) { //checking whether session is set of that
                    echo $_SESSION['no-login-messege']; //displaying session message if set
                    unset($_SESSION['no-login-messege']); //removinging session message
                
                }
                ?>

                <br><br>
                <!-- login form starts here -->
                <form action="" method="POST" class="text-center">
                    Username: <br>
                    <input type="text" name="username" placeholder="Enter Username">
                    <br>
                    <br>
                    Password: <br>
                    <input type="password" name="password" placeholder="Enter Password">
                    <br>
                    <br>
                    <input type="submit" name="submit" value="login" class="btn-primary">
                    <br><br>
                </form>
                <!-- login form ends here -->
            </div>
        </div>
    </div>
</body>

</html>

<?php
// check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // process for login
// 1.get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // 2.sql to check whether the username and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    // 3.execute the query
    $res = mysqli_query($conn, $sql);

    // 4.count rows to check whether user exist or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // user available and login success
        $_SESSION['login'] = "<div class='success'>Login uccessfully👌!!!</div>";
        $_SESSION['user'] = $username; //to check whether the user is logged in or not & logout will onset it

        // redirect to home page
        header('location:' . SITEURL . 'admin/index.php');

    } else {
        // user not available and login failed
        $_SESSION['login'] = "<div class='error text-center'>Username and Password Did Not match!!!</div>";
        // redirect to home page
        header('location:' . SITEURL . 'admin/login.php');
    }


}
?>
<?php include('partials/footer.php'); ?>