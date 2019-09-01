<?php include "includes/admin_header.php"; ?>

<?php





if(isset($_POST['edit_user'])){

                                    @$username = $_POST['username'];
                                    @$user_password = $_POST['user_password'];
                                    @$user_firstname = $_POST['user_firstname'];
                                    @$user_lastname = $_POST['user_lastname'];
                                    @$user_email = $_POST['user_email'];
                                    @$user_role = $_POST['user_role'];

    $update_query = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_role = '$user_role' , username = '$username', user_email = '$user_email', user_password = '$user_password' WHERE username = '$username' ";

    $edit_user_query = mysqli_query($con, $update_query);

    echo checkCon($edit_user_query);

}





$username = $_SESSION['username'];


$query = "SELECT * FROM users WHERE username = '$username' ";

$select_user_query = mysqli_query($con, $query);

checkCon($select_user_query);


while($row = mysqli_fetch_array($select_user_query)){

                                    $user_id = $row['user_id_ok'];
                                    $username = $row['username'];
                                    $user_password = $row['user_password'];
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_image = $row['user_image'];
                                    $user_role = $row['user_role'];

















?>



<body>

    <div id="wrapper">

        <!-- Navigation -->
<?php 

if($_SESSION['user_role'] == 'admin'){

include "includes/admin_nav.php";; 

}else{


include "includes/sub_nav.php";
}
?>

           <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Witaj
                            <small>              
                             <?php echo $user_firstname; ?>
                            </small>
                        </h1>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">
        <label for="post_status">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>


    <div class="form-group">
        <label for="post_image">Email </label>
        <p><?php echo $user_email; ?></p>
    </div> 

    <div class="form-group">    
        <label for="post_tags">Password </label>
        <input type="password" autocomplete="off" class="form-control" name="user_password">
    </div>


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>
</form>             
      <?php }?>      
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
</div>
</div>
</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
