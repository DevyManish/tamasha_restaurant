<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //displaying session message
            unset($_SESSION['upload']); //removing session message
        }
        ?>

        <br>
        <br>
        <!-- add category starts here -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5"
                            placeholder="Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            // create php code to display categories from database
                            // 1.create sql to get all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);

                            // count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            // if count is greater than zero we have categories else we don't have categories
                            if ($count > 0) {
                                // we have categories
                                while ($row = mysqli_fetch_array($res)) {
                                    // get the details of category
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php

                                }
                            } else {
                                // we dont have category
                                ?>
                                <option value="0">No category Found</option>
                            <?php

                            }
                            //2. display on dropdown
                            

                            ?>

                        </select>
                    </td>
                </tr>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        // check whether the button is clicked or not
        if (isset($_POST['submit'])) {
            // add the food in database
            // echo "clicked";
            // 1.get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // check whether radio button for featured and active are clicked or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // 2.upload the image if selected
            // check whether the select image is clicked or not and upload the image only if the image is selected
            if (isset($_FILES['image']['name'])) {
                // get the details of the selected image
                $image_name = $_FILES['image']['name'];

                // check whether the image is slectd or not and upload image only if it selected
                if ($image_name != "") {
                    // image is selected
                    // A.rename the image
                    // get the extension of the image(.jpg,.png,.gif etc) ex. "biriyani.jpg"
        
                    $ext = end(explode('.', $image_name));

                    // rename the image
        
                    $image_name = "food_order_" . rand(000, 999) . '.' . $ext;

                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/" . $image_name; //"food_category_836.jpg"
        
                    $upload = move_uploaded_file($src, $dst);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'><h2>Failed To Upload Image</h2></div>";
                        // redirect to the manage category page
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image_name = ""; //setting default value as blank
            }

            // 3.insert into database
            // create a sql query to save or add database
            $sql2 = "INSERT INTO tbl_food SET
title='$title',
description='$description',
price=$price,
image_name='$image_name',
category_id= $category,
featured='$featured',
active='$active'
";

            // execute the query
            $res2 = mysqli_query($conn, $sql2);
            // check whether data inserted or not
        
            if ($res2 == true) {
                // data inserted successfully
                $_SESSION['add'] = "<div class='success'><h2>Food Added Successfully</h2></div>";
                // redirect to the manage category page
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                // failed to insert data
                $_SESSION['add'] = "<div class='error'><h2>Failed To Add Food</h2></div>";
                // redirect to the manage category page
                header('location:' . SITEURL . 'admin/manage-food.php');
            }

            // 4.redirect to the manage food page
        }



        ?>
    </div>
</div>


<?php include('partials/footer.php') ?>