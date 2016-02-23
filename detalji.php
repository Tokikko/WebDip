<?php

include 'baza.class.php';
$baza = new baza();
$baza->spojiBaza();

$id = $_GET['idKor'];
#$email2 = substr($email, 0, -2);  

$tablica = "<table><thead><tr><th></th><th></th><th></th><th></th></tr></thead><tbody>";
$detalji = "";
$upit = "SELECT * FROM korisnici_z4 where idkorisnici_z4 = '$id'";
if ($baza::selectUpit($upit)){
    $popisKorisnika = $baza->selectUpit($upit);
    
  while ($red = $popisKorisnika->fetch_array()){
    #print_r($red);
    $tablica .= "<tr><td>{$red[1]}</td><td><img src ='img/{$red[3]}' width='300px' height='180px'></td><td>{$red[2]}</td><td>{$red[5]}</td><td><a href='detalji.php?idKor={$red[0]}'>Detalji</a></td></tr>";
    #echo "<br />";
   $detalji = " <form  name='unosPodatakaID' >
                    <label for='ime'>Ime:</label><input id='ime'  readonly name='ime' value = '{$red[1]}' type='text' class='inputKlasa' ><p id='greskaIme'></p><br/>
                    <label for='prezime'>Prezime:</label><input readonly id='prezime' value = '{$red[2]}' type='text' class='inputKlasa' name='prezime'  ><p id='greskaPrezime'></p><br/>
                    <label for='slika'>Slika:</label> <input type='image' src='img/{$red[3]}'  width='48' height='48'  class='inputKlasa' id='slika'> <br>
                    <label for='grad'> Grad:</label><input id='grad' readonly value = '{$red[4]}' name='grad' class='inputKlasa' type='text' ><br/>
                    <label for='email'>E-mail: </label><input id='email'  readonly value = '{$red[5]}' name='email' class='inputKlasa'  ><br/>
                    <label for='korisnickoIme'>Korisnicko ime:</label><input readonly value = '{$red[6]}' id='korisnickoIme' class='inputKlasa' name ='korisnickoIme' type='text'   title='6 ili vise znakova'> <br/>
                    <label for='lozinka'> Lozinka:</label><input  type='password' readonly value = '{$red[7]}' id='lozinka' class='inputKlasa' name='lozinka'  title='6 ili vise znakova'><br/>
                    <label for='zivotopis'>Životopis:</label><textarea id='zivotopis' readonly value = '{$red[8]}' class='inputKlasa' name='zivotopis' rows='8' cols='15'>$red[8]</textarea><br/>
                    <label for='datum'>Datum rođenja:</label><input type='date' id='datum' readonly value = '{$red[9]}' class='inputKlasa' name='datum'><br/>
                    <label for='datum'>Spol:</label><input type='text' id='spol' readonly value = '{$red[10]}' class='inputKlasa' name='datum'><br/>
                        <label for='datum'>Datum registracije:</label><input type='datetime' id='datum1' readonly value = '{$red[12]}' class='inputKlasa' name='datum'><br/>
                    <label for='datum'>Status korisnika:</label><input type='text' id='status' readonly value = '{$red[13]}' class='inputKlasa' name='status'><br/>
                        <label for='datum'>Tip korisnika:</label><input type='text' id='tip' readonly value = '{$red[11]}' class='inputKlasa' name='tip'><br/>
                        
                  
                    
                    </form>";
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
          #  echo $tablica;
            echo $detalji;
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