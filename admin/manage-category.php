<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE CATEGORY</h1>
        <br>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session message
        }
        ?>
        <br />
        <br />

        <!-- botton to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br />
        <br />
        <br />
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>username</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>1.</td>
                <td>manish </td>
                <td>devimanish </td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">delete Admin</a>
                </td>
            </tr>

            <tr>
                <td>2.</td>
                <td>manish </td>
                <td>devimanish </td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">delete Admin</a>

                </td>
            </tr>

            <tr>
                <td>3.</td>
                <td>manish </td>
                <td>devimanish </td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">delete Admin</a>
                </td>
            </tr>
        </table>
    </div>
</div>



<?php include('partials/footer.php'); ?>