<?php
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";
?>
<?php
if (isset($_POST['submit'])) {
	$username =$_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$user_role = $_POST['user_role'];
	if(!empty($username) && !empty($email) && !empty($password) ){
		$username =mysqli_real_escape_string($cnn, $username);
		$email = mysqli_real_escape_string($cnn, $email);
		$password =mysqli_real_escape_string($cnn, $password);
		$query = "SELECT randSalt from users";
		$select_randsalt_query = mysqli_query($cnn,$query);
		if(!$select_randsalt_query){
			die("Query Failed" . mysqli_error($cnn));
		}
		$row = mysqli_fetch_assoc($select_randsalt_query);
		$salt = $row['randSalt'];
		$password = crypt($password,$salt);
		$query = "INSERT INTO users (username,user_email,user_password,user_role)";
		$query .= "VALUES ('{$username}','{$email}','{$password}','{$user_role}')";
		$register_user_query = mysqli_query($cnn,$query);
		if(!$register_user_query){
			die("Query Failed" . mysqli_error($cnn). ' ' . mysqli_errno($cnn) );
		}
		$check = 1;
	}
else {
		$check = 0;
	}
} else {
		$check = "";
}
?>
<div class="container">
	<section id=login>
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3">
					<div class="form-wrap">
						<h3 class="text-center"><?php switch ($check) {
								case '1':
									echo "<p class='bg-success'>Thành Công
									<br>
									<a href='index.php'><span class='glyphicon glyphicon-arrow-left'></span> Trang Chủ</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='admin'>Trang Quản Trị <span class='glyphicon glyphicon-arrow-right'></span></a></p>";
									
									break;
								case '0':
									echo "<p class='bg-danger'>Thất Bại</p>";
									break;
								default:
									echo "";
									break;
						} ?></h3>
						<h1 class="text-center">Register</h1>
						<form role="form" action="registration.php" method="post" accept-charset="utf-8" id="login_form" autocomplete="off">
							<div class="form-group">
								<label for="username" class="sr-only">Username</label>
								<input type="text" id="username" name="username" class="form-control" placeholder="Enter Username">
							</div>
							<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
							</div>
							<div class="form-group">
								<label for="password" class="sr-only">Password</label>
								<input class="form-control" type="password" id="key" name="password" placeholder="Enter Password">
							</div>
							<div class="form-group">
								<label for="user_role">Quyền:</label>
								<select name="user_role" class="form-control">
									<option value="subscriber">Select option</option>
									<option value="subscriber">Subscriber</option>
									<option value="admin">Admin</option>
									
									
								</select>
							</div>
							<input type="submit" class="btn btn-danger btn-lg btn-block" name="submit" value="Đăng Ký">
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<hr>
	<?php   include "includes/footer.php"; ?>