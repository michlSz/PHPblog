                            
                            <form action="" method="post">
                                    <div class="form-group">
                                        <label for="cat-title">Edit Category</label>

                                        <?php



                                    if(isset($_GET['edit'])){
                                        $cat_table_id = $_GET['edit'];
                                
                                    $select_id = $con->query("SELECT * FROM categories WHERE cat_id = '$cat_table_id' ");




                            while( $row = mysqli_fetch_array($select_id)){
                            $cat_table_id = $row['cat_id'];
                            $cat_table_title = $row['cat_title'];
?>
                    
                    <input value="<?php if(isset($cat_table_title)){echo $cat_table_title;} ?>"  type="text" class="form-control" name="cat_table_title">


                                   <?php }} ?>

                                        
                                    <div class="form_group">
                                        <input class="btn btn-primary" type="submit" name="update_categoty" value="Update Categoy">
                                    </div>

                                </form>


                                <?php 
//////////// UPDATE QUERY

if(isset($_POST['update_categoty'])){
    
        $cat_table_title = $_POST['cat_table_title'];
        $query = "UPDATE categories SET cat_title = '$cat_table_title' WHERE cat_id = '$cat_table_id' ";
        $update_query = mysqli_query($con, $query);
}

?>