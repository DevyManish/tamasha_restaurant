<?php include('partials/menu.php') ?>

<?php
if (isset($_GET['id'])) {
    // get the id and all other details
    // echo "getting the data";
    $id = $_GET['id'];

    // create sql query to get other details
    $sql2 = "SELECT * FROM tbl_food WHERE id = $id";

    // execute the sql query
    $res2 = mysqli_query($conn, $sql2);

    // count the rows to check whethr the id is valid or not
    $count = mysqli_num_rows($res2);
    //check whether we have food data or not
    if ($count == 1) {
        //get the details
        // echo "food Available";
        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    } else {
        $_SESSION['no-food-found'] = "<div class='success'><h2>Food Not Found!!!</h2></div>";

        //redirect to manage admin page
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    // redirect to manage category
    header('location:' . SITEURL . 'admin/manage-food.php');
}


?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // display the image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                        <?php

                        } else {
                            // display messege
                            echo "<div class='error'>Image Not Added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            // query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            // execute the query
                            $res = mysqli_query($conn, $sql);
                            // count rows
                            $count = mysqli_num_rows($res);

                            // check whether category available or not
                            if ($count > 0) {
                                // category available
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    // echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if ($current_category == $category_id) {
                                        echo "selected";
                                    } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                }
                            } else {
                                // category not available
                                echo "<option value='0'>Category Not Available</option>";
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes">
                        Yes
                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
if (isset($_POST['submit'])) {
    // echo "clicked";
    // 1.get all the values from the form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // 2.updating new image if selected
    // check whether the image is selected or not
    if (isset($_FILES['image']['name'])) {
        // get the image details
        $image_name = $_FILES['image']['name'];

        // check whether the image AVAILABLE OR NOT
        if ($image_name!="") {
            // image available
            // A.upload the new image

            // auto rename our image
            // get the extension of the image(.jpg,.png,.gif etc) ex. "biriyani.jpg"

            $ext = end(explode('.', $image_name));

            // rename the image

            $image_name = "food_food_" . rand(000, 999) . '.' . $ext;

            $src = $_FILES['image']['tmp_name'];
            $dst = "../images/food/" . $image_name; //"food_category_836.jpg"

            $upload = move_uploaded_file($src, $dst);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                // redirect to the manage category page
                header('location:' . SITEURL . 'admin/manage-food.php');
                die();
            }

        // B.remove the current image if available
        if ($current_image!="") {
          
        $remove_path="../images/food/".$current_image;

          $remove = unlink($remove_path);

          // check whether the image removed or not
          // if failed to remove...display the messge and stop the process
              if ($remove == false) {
                  // failed to remove image
                  $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove Current Image</div>";
                  // redirect to the manage category page
                  header('location:' . SITEURL . 'admin/manage-food.php');
                  die(); //stop the process
              }
          }
        } 
    } else {
        $image_name = $current_image;
    }

    // 3.update the database
    $sql3 = "UPDATE tbl_food SET 
  title = '$title',
  description = '$description',
  price = '$price',
  image_name = '$image_name',
  category_id = '$category',
  featured = '$featured',
  active = '$active'
  WHERE id=$id     
   ";

    //  execute the query
    $res3 = mysqli_query($conn, $sql3);

    // 4.redirect to manage category with messege
    // check whether query executed or not
    if ($res3==true) {
        // category updated
        $_SESSION['update'] = "<div class='success'><h2>Food Updated Successfully</h2></div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    } else {
        // failed to update category
        $_SESSION['update'] = "<div class='error'><h2>Failed To Update Food!!</h2></div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
}
?>
    </div>
</div>







<?php include('partials/footer.php') ?>