<?php 
include_once 'admin/includes/functions.php';
 
if (isset($_POST["wyslane"])) { // jeżeli formularz został wysłany, to wykonuje się poniższy skrypt
     
      // filtrowanie treści wprowadzonych przez użytkownika
     $email = htmlspecialchars(stripslashes(strip_tags(trim($_POST["email"]))), ENT_QUOTES);
     //korzystamy z naszej klasy   
     $get=new funkcje();   
     // system sprawdza czy prawidło zostały wprowadzone dane
     // if (!eregi("^[0-9a-z_.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$", $email)) {
                //$blad=1;
                //echo '<p class="blad"> Proszę wprowadzić poprawnie adres email.</p>';
       // } else {
            //sprawdzanie czy istnieje w bazie podany email
                $sql1="SELECT login FROM users WHERE user_email='$email'";
                $result1=$get->get_single_shot($sql1);
               
                if (isset($result1['username'])) {
                    $blad=0; //jeli istnieje login blad=0
                   
                }else {
                    //jesli nie istnieje konto blad=1
                    echo '<p class="blad">Konto o podanym adresie e-mail nie istnieje!</p>';
                    $blad=1; 
                }
            }
    // jesli email istnieje i nie ma żadnego błedu, wysylany zostaje email z powiadomieniem o zmianie hasla
            if ($blad == 0) {
                $sql2="select code, login from USERS where user_email='$email'";
            $result=$get->get_single_shot($sql2);
                
                if ($result) {
                    // zapisywanie w zmiennej $list zawartosci tresci email
                    $list = "Witaj! <br>
                    Ktoś poprosił o wygenerowanie nowego hasła dla konta: ".$result['username']." <br>
 
                    Jeśli jest to błąd, po prostu zignoruj tego e-maila, a nic się nie stanie. <br><br>
 
                    Aby ustawić nowe hasło, przejdź pod poniższy adres:
                <br><br>
                   <a href='http://www.nazwa_strony.pl/veryfication.php?resetpaswd=yes&amp;user=".$result['username']."&amp;code=".$result['code']."' target='_blank'>www.nazwa_strony.pl/veryfication.php?resetpaswd=yes&amp;user=".$result['username']."&amp;code=".$result['code']."</a>";
                                      
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
                   }}}
     
        // tworzenie formularza HTML
 
        if($ok!=1){
        ?>
        <form action="../users/resetpaswd.php" method="post">
        <input type="hidden" name="wyslane" value="TRUE" />
        <fieldset class='register'><legend>E-mail:</legend>
        <div class='k1'>
    Wpisz swój adres e-mail podany przy rejestraji: 
        <input type="text" name="email"/>
        </div> </fieldset>
        <p class="submit">
       <input type="submit" value="Przypomnij hasło" />
       </p></form>
       <?php 
        }
?>