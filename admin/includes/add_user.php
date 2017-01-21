<?php
if(isset($_POST['create_user'])){

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
		$row = mysqli_fetch_assoc($select_randsalt_query);
		$salt = $row['randSalt'];
		$user_password = crypt($user_password,$salt);
	$query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password) ";
	$query .= "VALUES ('{$user_fname}', '{$user_lname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}')";
	$create_user_query = mysqli_query($cnn,$query);
	confirm($create_user_query);
	echo "User Created: ". " " . "<a href='users.php'>View User</a>";
}
?>
<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label for="user_fname">Firstname</label>
		<input type="text" name="user_fname" class="form-control">
	</div>
	<div class="form-group">
		<label for="user_lname">Lastname</label>
		<input type="text" name="user_lname" class="form-control">
	</div>
	<div class="form-group">
		<select name="user_role" class="form-control">
			<option value="subscriber">Select options</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
			
		</select>
	</div>
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" name="username" class="form-control">
	</div>
	
	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" name="user_email" class="form-control">
	</div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" name="user_password" class="form-control">
	</div>
	
	<div class="form-group">
		<input type="submit" name="create_user" class="btn btn-primary" value="Add user" >
	</div>
	<!-- <div class="form-group">
			<label for="image">Post Image</label>
			<input type="file" name="image">
	</div> -->
</form>