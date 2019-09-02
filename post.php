<?php include "includes/header.php"; ?>

<body>

    <!-- Navigation -->
<?php include "includes/nav.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


                <!-- First Blog Post -->
                <?php

                    if(isset($_GET['p_id'])){
                       $the_post_id = $_GET['p_id'];
                    }

                $results = $con->query("SELECT * FROM posts WHERE post_id = '$the_post_id' ");
                while ($row = mysqli_fetch_array($results)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    

                
                ?>

                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>

                <?php } ?>

                        <?php
                        if(isset($_POST['create_comment'])){

                        $the_post_id = $_GET['p_id'];


                        $the_author = $_POST['comment_author'];
                        $the_email = $_POST['comment_email'];
                        $the_content = $_POST['comment_content'];





                        $query = "INSERT into comments (comment_post_id, post_author, comment_author, comment_email, comment_content, comment_status, comment_date)  
                        VALUES ('$the_post_id', '$post_author', '$the_author', '$the_email', '$the_content', 'unapproved', now())";


                        $add_comment_query = mysqli_query($con, $query);

                        if(!$add_comment_query){
                            die ('problemo' . mysqli_error($con));
                        }


}




                        ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="post" action="" role="form">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author" class="form-control" rows="3">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-cntrol" name="comment_email" class="form-control" rows="3">
                        </div>
                            
                        <div class="form-group">
                            <label>Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

<?php


        $query = "SELECT * FROM comments WHERE comment_post_id =  '$the_post_id' AND comment_status = 'approved' ORDER BY comment_id DESC ";

        $comment_query = mysqli_query($con, $query);
        if(!$comment_query){
            die('Polaczenie nie udane' . mysqli_error($con));
        }



    $queryUpdate = "UPDATE posts SET post_comm_count = post_comm_count + 1 WHERE post_id = '$the_post_id' ";

    $update_comm_count = mysqli_query($con, $queryUpdate);
    if(!$update_comm_count){
            die('Polaczenie updatowania licznika nie powiodlo sie' . mysqli_error($con));
        }





        while($row  = mysqli_fetch_array($comment_query)){
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content'];
            $comment_author = $row['comment_author'];


        ?>




                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

            

<?php } ?>


                
                <!-- Pager -->
                <div>
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div>
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>




