<?php

function redirect($location){

    return header("Location: . $location");
}



function checkCon($results){

global $con;

if(!$results){

die('nie ma połaczenia, blad: ' . mysqli_error($con));
}
}




function insert_categories() {

    global $con;
    
    if(isset($_POST['submit'])){
                                    $cat_title = $_POST['cat_title'];
                                }

                                if(isset($cat_title) && $cat_title == "" || empty($cat_title)){
                                    echo "Musisz podać jakieś dane";


                                }else{

                                    $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";

                                    $queryAdded = mysqli_query($con, $query);

                                    if(!$queryAdded){

                                        die('Nie ma polączenia, błąd: ' . mysqli_error($con));
                                    }
                                    }
}

function findAllCategories(){
    global $con;

    $results_cat_admin = $con->query("SELECT * FROM categories");




                        while( $row = mysqli_fetch_array($results_cat_admin)){
                        $cat_table_id = $row['cat_id'];
                        $cat_table_title = $row['cat_title'];

                   echo "<tr>"; 
                   echo "<td>" . $cat_table_id . "</td>";
                   echo "<td>" . $cat_table_title . "</td>";
                    echo "<td>" . "<a href='categories.php?delete=$cat_table_id'>Delete</a>" . "</td>";
                    echo "<td>" . "<a href='categories.php?edit=$cat_table_id'>Edit</a>" . "</td>";

                   echo "</tr>";
}
}


function deleteCategories(){
    global $con;

    if(isset($_GET['delete'])){
        $delete_query_var = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = '$delete_query_var' ";
        $delete_query = mysqli_query($con, $query);
        header("Location: categories.php");
}
}





function is_admin($username){

    global $con;


    $query = "SELECT user_role FROM users WHERE user_role = '$username' ";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);


    if($row['user_role'] == 'admin') {

        return true;
    } else {
        return false;
    }
}


function username_exists($username) {

 global $con;


    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);


    if(mysqli_num_rows($result) > 0 ) {

        return true;
    } else {
        return false;
    }
}


function email_exists($email) {

    global $con;


    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);


    if(mysqli_num_rows($result) > 0 ) {

        return true;
    } else {
        return false;
    }
}


function register_user($username, $email, $password, $code){

 global $con;

    $username = mysqli_real_escape_string($con, $username);
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);
    $code = mysqli_real_escape_string($con, $code);


    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12) );

    $query = "INSERT INTO users (username, user_email, user_password, user_role, code) VALUES ('$username', '$email', '$password', 'subscriber', '$code') ";
    $insert_query = mysqli_query($con, $query);

    checkCon($insert_query);    
 
} 






function login_user($username, $password, $link = "../admin"){

global $con;

$username = trim($username);
$password = trim($password);


$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

$query = "SELECT * FROM users WHERE username = '$username' ";
$select_user_query = mysqli_query($con, $query);



while($row = mysqli_fetch_array($select_user_query)){

    
     $db_user_id = $row['user_id_ok'];
     $db_username = $row['username'];
     $db_user_firstname = $row['user_firstname'];
     $db_user_lastname = $row['user_lastname'];
     $db_user_role = $row['user_role'];
     $db_user_password = $row['user_password'];

}


//$password = crypt($password, $db_user_password);



if (password_verify($password, $db_user_password ) ){

$_SESSION['username'] = $db_username;
$_SESSION['firstname'] = $db_user_firstname;
$_SESSION['lastname'] = $db_user_lastname;
$_SESSION['user_role'] = $db_user_role;
$_SESSION['user_pass'] = $db_user_password;

header("Location: $link");

    

} else {


header("Location: ../index.php");


}


}

 
//tworzymy klasę
 
class funkcje{


//funkcja zapisująca pojedynczy wynik z bazy do tablicy
public function get_single_shot($quest){
        $connect=$this->connect_bd();
        $result=$connect->query($quest);
        if (!$result){echo "blad w get single shot <br> w zapytaniu: ".$quest."<br>"; return false;}
        if ($result->num_rows>0)
        {
            $result_array=@$result->fetch_assoc();
            return $result_array;
        }
        else {
        return 0;
        }
    }
//zamyka klase
}

?>