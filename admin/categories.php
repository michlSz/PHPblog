<?php include "includes/admin_header.php"; ?>



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
                            Witaj Admin
                            <small>Author</small>
                        </h1>



                            <div class="col-xs-6">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="cat-title">Add Category</label>
                                        <input type="text" class="form-control" name="cat_title">
                                    </div>
                                    <div class="form_group">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                    </div>

                                </form>

                            <?php echo insert_categories(); ?>
                                
                        
                            <?php // UPDATE AND INCLUDE CATEGORIES

                                if(isset($_GET['edit'])){
                                    $cat_table_id = $_GET['edit'];

                                include "includes/update_categories.php"; 

                                }
                                ?>
                                

                            </div>





                            <div class="col-xs-6">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                    </thead>


            <!-- FIND ALL CATEGORIES QUERY -->
            <?php findAllCategories(); ?>


    
            
            <!-- DELETE Query -->
            <?php deleteCategories(); ?>


                            </div>




                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
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
