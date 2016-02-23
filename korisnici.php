<?php

include 'baza.class.php';
$baza = new baza();
$baza->spojiBaza();
$tablica = "<table><thead><tr><th></th><th></th><th></th><th></th></tr></thead><tbody>";
$upit = "select * from  korisnici_z4 ";
if ($baza::selectUpit($upit)){
    $popisKorisnika = $baza->selectUpit($upit);
    echo "ima nest";
  while ($red = $popisKorisnika->fetch_array()){
    #print_r($red);
    $tablica .= "<tr><td>{$red[1]}</td><td><a href='detalji.php?idKor={$red[0]}'><img src ='img/{$red[3]}' width='300px' height='180px'></a></td><td>{$red[2]}</td><td>{$red[5]}</td><td><a href='detalji.php?idKor={$red[0]}'>Detalji</a></td></tr>";
    #echo "<br />";
}  
}
$tablica .= "</tbody></table>";


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
            echo $tablica;
            ?>
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
