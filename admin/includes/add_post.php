<?php

if(isset($_POST['create_post'])){

	$post_title = $_POST['title'];
	$post_author = $_SESSION['username'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];

	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];


	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];
	$post_date = date('d-m-y');
	$post_comment_count = 4;

move_uploaded_file($post_image_temp, "../images/$post_image" );

$query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) 
	
	VALUES ('$post_category_id', '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";



$queryAddPost = mysqli_query($con, $query);

checkCon($queryAddPost);



}



?>




<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Post title </label>
		<input type="text" class="form-control" name="title">
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
		
		<label for="post_status">Post status </label>
		<select name="post_status">
			<option value="published">Published</option>
			<option value="draft">Draft</option>
		</select>
		
	</div>


	<div class="form-group">
		<label for="post_image">Post Image </label>
		<input type="file" name="image">
	</div>

	<div class="form-group">	
		<label for="post_tags">Post Tags </label>
		<input type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post content </label>
		<textarea  class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
	</div>
</form>

	