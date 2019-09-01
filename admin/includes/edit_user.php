<?php

if(isset($_GET['edit_user'])){

$the_user_id = $_GET['edit_user'];


	  $query = "SELECT * FROM users WHERE user_id_ok = $the_user_id";
                                $select_users_query = mysqli_query($con, $query);


                                while($row = mysqli_fetch_array($select_users_query)){
                                    echo $user_id = $row['user_id_ok'];
                                    $username = $row['username'];
                                    $user_password = $row['user_password'];
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_image = $row['user_image'];
                                    $user_role = $row['user_role'];
                                   


/*

                       $query = "SELECT * FROM users WHERE user_id_ok = $the_user_id ";
                         $select_users_query = mysqli_query($con, $query);


                        while($row = mysqli_fetch_array($select_users_query)){
                                    $user_id = $row['user_id_ok'];
                                    echo $username = $row['username'];
                                    $user_password = $row['user_password'];
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_image = $row['user_image'];
                                    $user_role = $row['user_role'];


}
*/


	
//if(isset($_POST['edit_user'])){

									
                                   
if(isset($_POST['edit_user'])){

$the_user_id = $_GET['edit_user'];
									$username = $_POST['username'];
                                    $user_password = $_POST['user_password'];
                                    $user_firstname = $_POST['user_firstname'];
                                    $user_lastname = $_POST['user_lastname'];
                                    $user_email = $_POST['user_email'];
                                    $user_role = $_POST['user_role'];


/*
                       	$query = "SELECT randSalt FROM users";
                       	$select_randsalt_query = mysqli_query($con, $query);
                       	if(!$select_randsalt_query){
                       		die("Bład połaczenia");
                       	}

                      $row = mysqli_fetch_array($select_randsalt_query);
                      $salt = $row['randSalt'];
                      $true_password = crypt($user_password, $salt);

*/

                      if(!empty($user_password)){
                      	$query_password = "SELECT user_password FROM users WHERE user_id_ok = '$the_user_id' ";
                      	$get_user_query = mysqli_query($con, $query_password);
                      	checkCon($get_user_query);

                      	$row = mysqli_fetch_array($get_user_query);

                      	$db_user_password = $row['user_password'];


					
					if ($db_user_password != $user_password) {

                      	$hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12) );

                      }

				$update_query = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_role = '$user_role' , username = '$username', user_email = '$user_email', user_password = '$hashed_password' WHERE user_id_ok = '$the_user_id' ";

				$edit_user_query = mysqli_query($con, $update_query);

				echo checkCon($edit_user_query);

				echo "Uzytkownik zaktualizowany!";

                      }

                      



}

}

} else {

header ("Location: index.php");

}


?>




<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Firstname</label>
		<input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
	</div>
	<div class="form-group">
		<label for="title">Lastname</label>
		<input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">

		<select name="user_role" id="">

		<option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>

		<?php  
		if( $user_role == 'admin'){

		echo '<option value="subscriber">subscriber</option>';


		} else{
				echo	'<option value="admin">admin</option>';

		}

		?>
		

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
		<input type="text" value="<?php echo $username ?>" class="form-control" name="username">
	</div>


	<div class="form-group">
		<label for="post_image">Email </label>
		<input type="email" value="<?php echo $user_email ?>" name="user_email">
	</div> 

	<div class="form-group">	
		<label for="post_tags">Password </label>
		<input type="password" autocomplete="off" class="form-control" name="user_password">
	</div>


	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
	</div>
</form>

