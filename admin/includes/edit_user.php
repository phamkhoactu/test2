<?php 
if(isset($_GET['edit_user'])){
	$the_user_id = $_GET['edit_user'];

	$query = "SELECT * FROM users WHERE user_id= $the_user_id";
	$select_users = mysqli_query($cnn,$query);
	while ($row = mysqli_fetch_assoc($select_users)) {
		$user_id =  $row['user_id'];
		$username =  $row['username'];
		$user_firstname =  $row['user_firstname'];
		$user_lastname =  $row['user_lastname'];
		$user_email =  $row['user_email'];
		$user_role =  $row['user_role'];
	}
}


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
	$query = "SELECT randSalt from users";
		$select_randsalt_query = mysqli_query($cnn,$query);
		if(!$select_randsalt_query){
			die("Query Failed" . mysqli_error($cnn));
		}
		$salt = $row['randSalt'];
		$hasnhed_password = crypt($password,$salt);

	$query = "UPDATE users SET ";
	$query .= "user_firstname = '{$user_fname}', ";
	$query .= "user_lastname = '{$user_lname}', ";
	$query .= "user_role = '{$user_role}', ";
	$query .= "username = '{$username}', ";
	$query .= "user_email = '{$user_email}', ";
	$query .= "user_password = '{$hasnhed_password}' ";
	$query .= "	WHERE user_id = {$the_user_id}";

	$update_query = mysqli_query($cnn,$query);

	confirm($update_query);

	header("Location: users.php");
	
}

?>


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
		<input type="submit" name="edit_user" class="btn btn-primary" value="Save" >
	</div>


	<!-- <div class="form-group">
		<label for="image">Post Image</label>
		<input type="file" name="image">
	</div> -->
</form>