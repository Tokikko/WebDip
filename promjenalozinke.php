<?php

/*include_once 'baza.class.php';
include_once 'greske.php';
$email = $_GET['email'];
if(isset($_POST['btnlozinkazahtjev'])){
$baza = new baza();
$baza->spojiBaza();
$promjenaLozinka = $_POST['novalozinka'];
$upit = "select  email  from korisnik where email =  '$email'";

if ($promjena = $baza->selectUpit($upit)){
       $nova = md5($promjenaLozinka);
     if (!is_null($promjena)){
         $uspEmail = $promjena->fetch_array();
         echo $uspEmail[0];
         $upit2 = "UPDATE korisnik SET sifra = '$nova' WHERE  email = '$email'";
         
         if($baza->ostaliUpiti($upit2)){
           
        }
        
        else{
             trigger_error("Greska prilikom upisa nove lozinke :( ", E_USER_ERROR);
        }
     }
     
     else{
         trigger_error("Email nepostoji ", E_USER_ERROR);
     }
    
}

}*/

function novaSifra() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>

