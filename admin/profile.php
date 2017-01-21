<?php include "includes/admin_header.php" ?>
<?php if (isset($_SESSION['username'])) {
$username = $_SESSION['username'];
$query = "SELECT * FROM users where username='{$username}'";
$select_user_profile_query = mysqli_query($cnn,$query);
while ($row = mysqli_fetch_array($select_user_profile_query)) {
$user_id =  $row['user_id'];
$username =  $row['username'];
$user_firstname =  $row['user_firstname'];
$user_lastname =  $row['user_lastname'];
$user_password =  $row['user_password'];
$user_email =  $row['user_email'];
$user_role =  $row['user_role'];
}
} ?>
<?php

if(isset($_POST['edit_user'])){
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_role = $_POST['user_role'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_date = date('d-m-y');


    // move_uploaded_file($post_image_temp,"../images/$post_image");

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_fname}', ";
    $query .= "user_lastname = '{$user_lname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= " WHERE username = '{$username}' ";

    $update_query = mysqli_query($cnn,$query);

    confirm($update_query);

    header("Location: profile.php");
    
}



?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class ="col-lg-12">
                    <h1 class="page-header">
                    Welcome to Admin Page
                    <small>Author</small>
                    </h1>
                    
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_fname">Firstname</label>
                            <input type="text" value="<?php echo $user_firstname; ?>" name="user_fname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_lname">Lastname</label>
                            <input type="text" value="<?php echo $user_lastname; ?>" name="user_lname" class="form-control">
                        </div>
                        <div class="form-group">
                            <select name="user_role" class="form-control">
                                <option value="<?php echo $user_role;  ?>"><?php echo $user_role;  ?></option>
                                <?php
                                if ($user_role == 'admin') {
                                echo "<option value='subscriber'>Subscriber</option>";
                                } else {
                                echo "<option value='admin'>Admin</option>";
                                }
                                ?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="<?php echo $username; ?>" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" value="<?php echo $user_email; ?>"  name="user_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" value="<?php echo $user_password; ?>"  name="user_password" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="edit_user" class="btn btn-primary" value="Update Profile" >
                        </div>
                        <!-- <div class="form-group">
                            <label for="image">Post Image</label>
                            <input type="file" name="image">
                        </div> -->
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php" ?>