<?php include "includes/admin_header.php"; ?>

<?php 

if(!is_admin($_SESSION['user_role'])){

    header("Location: index.php");
}

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_nav.php"; ?>


           <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Witaj
                            <small>              
                             <?php echo $_SESSION['user_role'] ?>
                            </small>
                        </h1>

                        <?php


                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else {
                            $source = '';
                        }

                        switch ($source) {

                                case 'add_user';
                                include "includes/add_user.php";
                                break;

                                case 'edit_user':
                                include "includes/edit_user.php";
                                break;

                                case '70':
                                echo "nice 70";
                                break;
                            
                            default:
                                include "includes/view_all_users.php";
                                break;
                        }

                        ?>
            
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
