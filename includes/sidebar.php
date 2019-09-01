<div class="col-md-4">

<?php

if(isset($_POST['search'])){
  $search = $_POST['search'];
echo $search;



 $seatch_query = $con->query("SELECT * FROM posts WHERE post_tags LIKE '%$search%' ");

 if(!$seatch_query) {

    echo  $con->error; 
    
 }

$wiersze = mysqli_num_rows($seatch_query);

if($wiersze == 0) {
    echo "brak wyników";
}else{
    echo "są wyniki";
}
}

?>


                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Szukaj</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                </form>
                    <!-- /.input-group -->
                </div>

                <!-- Lgin frm -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">

                        <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                    </div>


                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter Username" >

                        <span class="input-group-btn">
                            <button name="login" class="btn btn-default" type="submit">
                                Submit
                        </button>

                        </span>
                    </div>
                </form>
                    <!-- /.input-group -->
                </div>

                
                <div class="well">

                    <?php

                
                $results_sidebar = $con->query("SELECT * FROM categories");

?>
                    <h4>Kategorie</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
<?php
                            while( $row = mysqli_fetch_array($results_sidebar)){

                                   $cat_title = $row['cat_title'];
                                   $cat_id = $row['cat_id'];

                   echo "<li><a href='category.php?category=$cat_id'>" . $cat_title . "</a></li>";
}
    ?>
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>