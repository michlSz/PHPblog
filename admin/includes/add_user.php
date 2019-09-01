<?php

if(isset($_POST['create_user'])){

	 echo $user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_role = $_POST['user_role'];

	//$post_image = $_FILES['image']['name'];
	//$post_image_temp = $_FILES['image']['tmp_name'];


	$username = $_POST['username'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];
	//$post_date = date('d-m-y');
	//$post_comment_count = 4;

//move_uploaded_file($post_image_temp, "../images/$post_image" );


	$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10) );

$query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) 
	
	VALUES ('$user_firstname', '$user_lastname',  '$user_role', '$username', '$user_email', '$user_password')";



$create_user_query = mysqli_query($con, $query);

checkCon($create_user_query);



}



?>




<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Firstname</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>
	<div class="form-group">
		<label for="title">Lastname</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">

		<select name="user_role" id="">

		<option value="subscriber">select option</option>
		<option value="admin">admin</option>
		<option value="subscriber">subscriber</option>

	</select>
	</div>
<!--
	<div class="form-group">
		<label for="post_category">Pst image </label>
		<input type="text" class="form-control" name="">
	</div>
-->
	<div class="form-group">
		<label for="post_status">Username </label>
		<input type="text" class="form-control" name="username">
	</div>


	<div class="form-group">
		<label for="post_image">Email </label>
		<input type="email" name="user_email">
	</div>

	<div class="form-group">	
		<label for="post_tags">Password </label>
		<input type="password" class="form-control" name="user_password">
	</div>


	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_user" value="Add User">
	</div>
</form>

	