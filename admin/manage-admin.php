<?php include('partials/menu.php'); ?>


<!-----MAIN CONTENT SECTION START----->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ADMIN</h1>



        <!-- //check whether mssg is displayed -->
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //displaying session message
            unset($_SESSION['delete']); //removing session message
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //displaying session message
            unset($_SESSION['update']); //removing session message
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; //displaying session message
            unset($_SESSION['user-not-found']); //removing session message
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match']; //displaying session message
            unset($_SESSION['pwd-not-match']); //removing session message
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd']; //displaying session message
            unset($_SESSION['change-pwd']); //removing session message
        }

        ?>
        <br><br>

        <!-- botton to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>username</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query to Get all admin
            $sql = "SELECT * FROM tbl_admin";
            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check whetherthe Query is executed of not
            if ($res == TRUE) {
                //Count Rows to check whether wqe have data in database or not
                $count = mysqli_num_rows($res); //Function to get all the rows in database
            
                $sn = 1; //Create a var assigned the value for sl no.
            
                //check the no. of rows
                if ($count > 0) {
                    //WE HAVE DATA IN DATABASE
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loop to get the data from database
                        //and while loop will run as longh as we have data in database
            
                        //get indiviual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Display the values in our table
                        ?>
                        <tr>
                            <td>
                                <?php echo $sn++; ?>
                            </td>
                            <td>
                                <?php echo $full_name; ?>
                            </td>
                            <td>
                                <?php echo $username; ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"
                                    class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                                    class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                    class="btn-danger">delete Admin</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    //WE HAVE DATA IN DATABASE
                }
            }
            ?>





        </table>




        <div class="clearfix"></div>
    </div>
</div>
<!-------MAIN CONTENT SECTION END----->





<?php include('partials/footer.php'); ?>