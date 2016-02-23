<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
include_once 'preuzmipomak.php';
$baza = new baza();
$baza->spojiBaza();

$email = $_GET['email'];
$virtualnoVrijeme = preuzmiPomak();

$test = "";
$upit = "SELECT korisnik.status, korisnik.kod,korisnik.datumRegistracije, korisnik.korisnickoIme FROM korisnik where korisnik.kod = '$email' and korisnik.status = 0";
if ($pod = $baza->selectUpit($upit)){
 
    $red= $pod->fetch_array();
    
    $vrijemeRegistracije = $red['datumRegistracije'];
    
    
    if(!(strtotime('-1 day') > (strtotime($virtualnoVrijeme)) )){ 
        
        $upit2 = "UPDATE korisnik SET status = 1 WHERE  kod = '$email'";
        if($baza->ostaliUpiti($upit2)){
           upisiLog("Aktiviran korisnik", $red['korisnickoIme']); 
           header( 'Location: registracija.php' ) ;
            /*$json = array();
            $upit = "SELECT korisnickoIme, ime, prezime,email, sifra, status, tipKorisnika  FROM korisnik";
            $pod = $baza->selectUpit($upit);
            $i = 0;
            while($pod1 = $pod->fetch_array()){
                $json[$i]['korisnickoIme']  = $pod1['korisnickoIme'];
                $json[$i]['ime']  = $pod1['ime']; 
                $json[$i]['prezime']  = $pod1['prezime']; 
                $json[$i]['email']  = $pod1['email']; 
                $json[$i]['sifra']  = $pod1['sifra']; 
                $json[$i]['statuss']  = $pod1['status'];
                $json[$i]['tipKorisnika']  = $pod1['tipKorisnika'];
                $i+=1;
            }
            echo json_encode($json);*/
        }
    }
     else {
        trigger_error("Prosla su 24 sata, isteklo vrijeme za aktivaciju",E_USER_ERROR);
       }
}
else {
        trigger_error("Greska prilikom pristupanja bazi",E_USER_ERROR);
       }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<html>
    <head>
        <title>Početna stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="css/irepusic.css">
    </head>
    <body>
        <header id="zaglavlje">
            <img id="slika1" src="img/deliver1.jpg" alt="dostava"/>
            <p class="zaglavljeP">Registracija</p>
        </header>
        <nav id="izbornik">
            <ul>
                
                <li><a href="registracija.php" target="_self">Registriraj se</a></li>
                <li><a href="korisnici.php" target="_self">Popis korisnika</a></li>
            </ul>
        </nav>
        <section id="sadrzaj">
         <?php 
         echo "smece";
         echo $vrijemeRegistracije;
         echo $test;?>
        </section>
        <footer id="podnozje">
            <p> Vrijeme rjesavanja trenutne stranice: 4.00</p>
            <p> Ukupno vrijeme : 9.50</p>
            
            <div id="validacijaSlike">
            <p>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" />
    </a>
</p>
<p>
    <img  style="border:0;width:88px;height:31px"
          src="img/html5.jpg"
            alt="Valid CSS!" />
</p>
            </div>
        </footer>
        <script type="text/javascript" src="js/irepusic.js" ></script>
    </body>
</html>
