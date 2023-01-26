<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE FOOD</h1>
        <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //displaying session message
            unset($_SESSION['delete']); //removing session message
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //displaying session message
            unset($_SESSION['upload']); //removing session message
        }
        ?>
         <br>
         <br>
         <!-- botton to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br />
        <br />
        <br />
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>active</th>
                <th>action</th>
            </tr>
            <!-- create a query to get all the food -->
            <?php
            $sql = "SELECT * FROM tbl_food";

            // execute the query
            $res = mysqli_query($conn, $sql);

            // count rows to check whether we have food or not
            $count = mysqli_num_rows($res);

            // create number variable and set default value as 1
            $sn = 1;

            if ($count > 0) {
                // we have food in database
                // get food from database and display
                while ($row = mysqli_fetch_array($res)) {
                    // get the values from individual coloumn
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $sn++ ?>
                        </td>
                        <td>
                            <?php echo $title ?>
                        </td>
                        <td>
                            <?php echo $price ?>
                        </td>
                        <td>
                            <?php
                            // check whether we have image or not
                            if($image_name=="")
                            {
                                // we don't have image ...display error messege
                                echo "<div class='error'>Image Not Added</div";
                            }
                            else{
                                // we have image,display image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" width="100px" >
                                <?php
                            }
                    
                            ?>
                        </td>
                        <td>
                            <?php echo $featured ?>
                        </td>
                        <td>
                            <?php echo $active ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?> " class="btn-danger">delete Food</a>
                        </td>
                    </tr>

                    <?php

                }
            } else {
                // food not added in database
                echo "<tr> <td colspan='7' class='error text-center'>_______________Food Not Added Yet_______________</td> </tr>";
            }
            ?>


        </table>
    </div>
</div>





<?php include('partials/footer.php'); ?>