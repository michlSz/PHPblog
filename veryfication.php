<?php
include_once 'function.php'; //dolaczanie pliku z klasa funkcje
  
  if ($_REQUEST['resetpaswd'] == 'yes') {
   	?><h2 class="title"> Resetowanie has³a: </h2> <div class="entry"><?php 
   	   if (isset($_REQUEST["code"])) { // je¿eli formularz zosta³ wys³any, to wykonuje siê poni¿szy skrypt
   	   		// filtrowanie treœci wprowadzonych przez u¿ytkownika
       		$login = htmlspecialchars(stripslashes(strip_tags(trim($_REQUEST["user"]))), ENT_QUOTES);
       		$code = htmlspecialchars(stripslashes(strip_tags(trim($_REQUEST["code"]))), ENT_QUOTES);
            
           
  		 $get=new funkcje();
    		$connect=$get->connect_bd();
            // system sprawdza czy prawid³o zosta³y wprowadzone dane
           $blad=0;
           
   	    	 $quest="select login from USERS where login='$login' and code='$code'";
      		$result1=$get->get_single_shot($quest);
            if (isset($result1['login'])) {
                    $blad=0; 
                   
                }else {
                	 $blad=1;
                	  echo '<p class="blad">B³êdny kod zmiany has³a</p>';
                	 
                }
            
     
            // je¿eli nie ma ¿adnego b³edu, u¿ytkownik zostaje zarejestronwany i wys³any do niego e-mail z linkiem aktywacyjnym
            if ($blad == 0) {
            	$czyste_haslo=uniqid('kod'); // generowanie losowego hasla - z poczatkowa wartoscia kod
                $haslo = $czyste_haslo; // zaszyfrowanie hasla
		$quest="update USERS set password='$haslo' where login='$login'"; // zapytanie do bazy o aktualizacje zmiany has³a
     		$result=$connect->query($quest); // wys³anie zapytania
                  if ($result) {//jesli ok to wysylany zostaje email z nowych haslem 
                    $list = " Witaj! Oto twoje dane do konta <br>
					Nazwa u¿ytkownika: ".$result['login']." <br>
					Nowe has³o: ".$czyste_haslo." <br> ";
                   
                   
                   $headers="From: <admin@nazwa_strony.pl>".PHP_EOL;
                   $headers.= 'MIME-Version: 1.0' .PHP_EOL;
                   $headers.="Content-type: text/html; charset=utf-8".PHP_EOL;
                   $headers.="X-Mailer: PHP/". phpversion();
                   
                   if(mail($email, "Nowe has³o", $list,$headers)){
                   	
                   	
                    echo '<p>Nowe has³o zosta³o wys³ane!</p>';
                   
                 
                   }
                   else {
                   	echo"B³¹d!! - skontaktuj sie z adminitratorami serwisu.";
                   }
                }
            }
            
        }
   }else{
   echo " nie przekazano paremetrow - brak dzialania";
   } ?>