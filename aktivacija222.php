<?php
include 'baza.class.php';
$baza = new baza();
$baza->spojiBaza();

$email = $_GET['email'];
;  

$test = "";
$upit = "SELECT status_korisnika FROM korisnici_z4 where email = '$email' and status_korisnika = 0";
if ($baza::selectUpit($upit)){
    
    $upit2 = "UPDATE korisnici_z4 SET status_korisnika = 1 WHERE  email = '$email'";
    if ($baza::ostaliUpiti($upit2)){
          header("Location: korisnici.php");
             exit;
        $test = "promjena izvrsena";
    }
     else {
        trigger_error("Istekao vam je vrijeme za aktivaciju",E_USER_ERROR);
       }
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
