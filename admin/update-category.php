<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
<?php
// check whether the id is set or not
if (isset($_GET['id'])) {
    // get the id and all other details
    // echo "getting the data";
    $id = $_GET['id'];

    // create sql query to get other details
    $sql = "SELECT * FROM tbl_category WHERE id = $id";

    // execute the sql query
    $res = mysqli_query($conn, $sql);

    // count the rows to check whethr the id is valid or not
    $count = mysqli_num_rows($res);
    //check whether we have admin data or not
    if ($count==1) {
        //get the details
        // echo "categoty Available";
        $row=mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $image_name = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        $_SESSION['no-category-found'] = "<div class='success'><h2>Category Not Found!!!</h2></div>";

        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
} else {
    // redirect to manage category
    header('location:'.SITEURL.'admin/manage-category.php');
}
?>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
        <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <!-- Image will be displayed here -->
                            <?php
if ($current_image!="") {
    // display the image
    ?>
<img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px" >
<?php

} else {
    // display messege
    echo "<div class='error'>Image Not Added</div>";
}
?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if ($featured == "Yes") {
                                echo "checked";
                            } ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if ($featured == "No") {
                                echo "checked";
                            } ?> type="radio" name="featured" value="No"> No
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if ($active == "No") {
                                echo "checked";
                            } ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update category" class="btn-secondary">
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
      $current_image = $_POST['current_image'];
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

              $image_name = "food_category_" . rand(000, 999) . '.' . $ext;

              $src = $_FILES['image']['tmp_name'];
              $dst = "../images/category/" . $image_name; //"food_category_836.jpg"

              $upload = move_uploaded_file($src, $dst);

              if ($upload == false) {
                  $_SESSION['upload'] = "<div class='error'><h2>Failed To Upload Image</h2></div>";
                  // redirect to the manage category page
                  header('location:' . SITEURL . 'admin/manage-category.php');
                  die();
              }

          // B.remove the current image if available
          if ($current_image!="") {
            
          $remove_path="../images/category/".$current_image;

            $remove = unlink($remove_path);

            // check whether the image removed or not
            // if failed to remove...display the messge and stop the process
                if ($remove == false) {
                    // failed to remove image
                    $_SESSION['failed-remove'] = "<div class='error'><h2>Failed To Remove Current Image</h2></div>";
                    // redirect to the manage category page
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    die(); //stop the process
                }
            }
          } 
      } else {
          $image_name = $current_image;
      }

      // 3.update the database
      $sql3 = "UPDATE tbl_category SET 
    title = '$title',
    image_name = '$image_name',
    featured = '$featured',
    active = '$active'
    WHERE id=$id     
     ";

      //  execute the query
      $res2 = mysqli_query($conn, $sql2);

      // 4.redirect to manage category with messege
      // check whether query executed or not
      if ($res2==true) {
          // category updated
          $_SESSION['update'] = "<div class='success'><h2>Category Updated Successfully</h2></div>";
          header('location:'.SITEURL.'admin/manage-category.php');
      } else {
          // failed to update category
          $_SESSION['update'] = "<div class='error'><h2>Failed To Update Category!!</h2></div>";
          header('location:'.SITEURL.'admin/manage-category.php');
      }
  }
?>
    </div>
</div>






<?php include('partials/footer.php') ?>