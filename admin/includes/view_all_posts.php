<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                            </thead>
                            <tbody>
                                <?php 


                                if($_SESSION['user_role'] == 'admin'){

                                $query = "SELECT * FROM posts";
                                }else{

                                $post_author = $_SESSION['username'];
                                $query = "SELECT * FROM posts WHERE post_author = '$post_author' ";
                            }

                                $select_posts = mysqli_query($con, $query);

                                while($row = mysqli_fetch_array($select_posts)){
                                    $post_id = $row['post_id'];
                                    $post_author = $row['post_author'];
                                    $post_title = $row['post_title'];
                                    $post_cat_id = $row['post_cat_id'];
                                    $post_status = $row['post_status'];
                                    $post_image = $row['post_image'];
                                    $post_tags = $row['post_tags'];
                                    $post_comm_count = $row['post_comm_count'];
                                    $post_date = $row['post_date'];

                                    echo "<tr>";
                                    echo "<td>$post_id</td>";
                                    echo "<td>$post_author</td>";
                                    echo "<td>$post_title</td>";

                            $select_id = $con->query("SELECT * FROM categories WHERE cat_id = '$post_cat_id' ");

                            while( $row = mysqli_fetch_array($select_id)){
                            $cat_table_id = $row['cat_id'];
                            $cat_table_title = $row['cat_title'];
}

                                    echo "<td>$cat_table_title</td>";



                                    echo "<td>$post_status</td>";
                                    echo "<td><img width='100' src='../images/$post_image'></td>";
                                    echo "<td>$post_tags</td>";
                                    echo "<td>$post_comm_count</td>";
                                    echo "<td>$post_date</td>"; 

                                    echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id=$post_id'>Edit</td>"; 

                                    //echo "<td><a rel='$post_id' href='javascript:void(0) class='delete_link'>Delete</td>";

?>

                                    <form method="post">

                                        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">

                                        <?php
                                       echo '<td><input class="btn btn-danger" type="submit" name="delete" value="delete"></td>';
                                        ?>



                                    </form>

<?php
                                    //echo "<td><a onClick=\"javascript: return confirm('Czy na pewno chcesz usunac?'); \" href='posts.php?delete=$post_id'>Usuń</td>"; 


                                    echo "</tr>";
                                }
?>
                                



<?php

if(isset($_POST['delete'])){
   $deletePost = $_POST['post_id'];




$query = "DELETE FROM posts WHERE post_id = '$deletePost'";
$deletePostQuery = mysqli_query($con, $query);
header("Locaton: posts.php");

}


?>



                            </tbody>
                        </table>