<?php

if(isset($_GET['p_id'])){
	$the_post_id = $_GET['p_id'];

}

$query = "SELECT * FROM posts WHERE post_id = '$the_post_id'	";
$select_posts_edit = mysqli_query($con, $query);

                                while($row = mysqli_fetch_array($select_posts_edit)){
                                    $post_id = $row['post_id'];
                                    $post_author = $row['post_author'];
                                    $post_title = $row['post_title'];
                                    $post_cat_id = $row['post_cat_id'];
                                    $post_status = $row['post_status'];
                                    $post_image = $row['post_image'];
                                    $post_tags = $row['post_tags'];
                                    $post_content = $row['post_content'];
                                    $post_comm_count = $row['post_comm_count'];
                                    $post_date = $row['post_date'];

}



if (isset($_POST['update_post'])){
	
	$post_title = $_POST['title'];
	$post_author = $_POST['author'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];

	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];


	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];

	move_uploaded_file($post_image_temp, "../images/$post_image");

	if(empty($post_image)){
	$query = "SELECT * FROM posts WHERE post_id = '$the_post_id' ";
	$selectImage = mysqli_query($con, $query);

	while ($row = mysqli_fetch_array($selectImage)) {
		 $post_image = $row['post_image'];
	}
}
	


	$updateQuery = "UPDATE posts SET post_title = '$post_title', post_cat_id = '$post_category_id', post_date = now(), post_author = '$post_author', post_status = '$post_status', post_tags = '$post_tags', post_content = '$post_content', post_image = '$post_image' WHERE post_id = '$the_post_id' ";

	$updatePost = mysqli_query($con, $updateQuery);

		checkCon($updateQuery);

}
?>

<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Post title </label>
		<input type="text" value="<?php echo $post_title; ?>" class="form-control" name="title">
	</div>

	<div class="form-group">
		<select name="post_category" id="">
		<?php
			$select_id = $con->query("SELECT * FROM categories");




              while( $row = mysqli_fetch_array($select_id)){
              $cat_table_id = $row['cat_id'];
              $cat_table_title = $row['cat_title'];


              echo "<option value='$cat_table_id'>$cat_table_title</option>";

}	


		?>
	</select>
	</div>

	<div class="form-group">
		<label for="post_category">Post Author </label>
		<input type="text" value="<?php echo $post_author; ?>" class="form-control" name="author">
	</div>

	<div class="form-group">
		<label for="post_status">Post status </label>
		<input type="text" value="<?php echo $post_status; ?>"class="form-control" name="post_status">
	</div>


	<div class="form-group">
		<label for="post_image">Post Image </label>
		<img width="300px" src="../images/<?php echo $post_image ?>" name="image">
		<input type="file" name="image">

	</div>

	<div class="form-group">	
		<label for="post_tags">Post Tags </label>
		<input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post content </label>
		<textarea  class="form-control"  name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?>
		</textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="update_post" value="Publish Post">
	</div>
</form>