<?php 
include_once 'admin/includes/functions.php';
include "includes/header.php";
include "includes/nav.php"; 


if (isset($_POST["wyslane2"])) { // jeżeli formularz został wysłany, to wykonuje się poniższy skrypt
     
      // filtrowanie treści wprowadzonych przez użytkownika
     $email = htmlspecialchars(stripslashes(strip_tags(trim($_POST["email"]))), ENT_QUOTES);
     //korzystamy z naszej klasy   
     echo $email;
       
     // system sprawdza czy prawidło zostały wprowadzone dane
     // if (!eregi("^[0-9a-z_.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$", $email)) {
                //$blad=1;
                //echo '<p class="blad"> Proszę wprowadzić poprawnie adres email.</p>';
       // } else {
            //sprawdzanie czy istnieje w bazie podany email
                $query="SELECT * FROM users WHERE user_email='$email' ";
               
              $login_query=  mysqli_query($con, $query);

               $row = mysqli_fetch_array($login_query);

               echo $row['username'];



      if(mysqli_num_rows($login_query) > 0 ) {
        echo "taki mail jest w bazie";
            
            $list = "Witaj! <br>
                    Ktoś poprosił o wygenerowanie nowego hasła dla konta: ".$row['username']." <br>
 
                    Jeśli jest to błąd, po prostu zignoruj tego e-maila, a nic się nie stanie. <br><br>
 
                    Aby ustawić nowe hasło, przejdź pod poniższy adres:
                <br><br>
                   <a href='http://www.nazwa_strony.pl/veryfication.php?resetpaswd=yes&amp;user=".$row['username']."&amp;code=".$row['code']."' target='_blank'>www.nazwa_strony.pl/veryfication.php?resetpaswd=yes&amp;user=".$row['username']."&amp;code=".$row['code']."</a>";
                                      
                   $headers="From: <admin@nazwa_strony.pl>".PHP_EOL;
                   $headers.= 'MIME-Version: 1.0' .PHP_EOL;
                   $headers.="Content-type: text/html; charset=utf-8".PHP_EOL;
                   $headers.="X-Mailer: PHP/". phpversion();
                   
                   if(mail($email, "Ustawianie nowego hasła", $list,$headers)){
                    
                    
                    echo '<p>Odnośnik potwierdzający został wysłany e-mailem</p>';
                   
                   $ok=1;
                   }
                   else {
                    echo"Błąd!! - skontaktuj się z administratorami serwisu.";

                  } 


                  }else {
                    echo "takiego maila nie ma w bazie";


                }

                }

                
    

            
              
                  
        // tworzenie formularza HTML
 
        
        ?>
        <form action="" method="post">
        <input type="hidden" name="wyslane" value="TRUE" />
        <fieldset class='register'><legend>E-mail:</legend>
        <div class='k1'>
    Wpisz swój adres e-mail podany przy rejestraji: 
        <input type="email" name="email"/>
        </div> </fieldset>
        <p class="submit">
       <input type="submit" name="wyslane2" value="Przypomnij hasło" />
       </p></form>
       
        
?>