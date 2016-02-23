<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'baza.class.php';
include 'greske.php';
$baza = new baza();
$baza->spojiBaza();
if(isset($_POST['potvrdaRegistracije'])){
$korisnici_email = $_POST['email'];
$korisnici_lozinka = $_POST['lozinka'];
$korisnici_lozinka1 = $_POST['potvrda'];
$korisnici_naziv = $_POST['korisnickoIme'];
$korisnici_prezime = $_POST['prezime'];
$korisnici_ime = $_POST['ime'];
$korisnici_grad = $_POST['grad'];
$korisnici_adresa = $_POST['adresa'];
$korisnici_telefon = $_POST['telefon'];
$korisnici_zivotopis = $_POST['zivotopis'];
$korisnici_spol = $_POST['spol'];
$korisnici_datum_rod = $_POST['datum'];
#$tipovi = array('.jpg','.jpeg','.png','.gif');
#$velicina = 10485760;
$direktorij = 'img/';
$ime = $_FILES['slika']['name'];




    if (empty($korisnici_email) || empty($korisnici_lozinka) || empty($korisnici_lozinka1) || empty($korisnici_naziv) || empty($korisnici_prezime) ||
            empty($korisnici_ime) || empty($korisnici_grad) || empty($korisnici_adresa) || empty($korisnici_telefon) || empty($korisnici_zivotopis) ||
            empty($korisnici_spol) || empty($korisnici_datum_rod) ){
   
        trigger_error("sva polja moraju biti ispunjena", E_USER_ERROR);
    }

    else{
        
        if(strcmp($korisnici_lozinka, $korisnici_lozinka1) == 0){
            echo "lotinke u redu";
            if ($korisnici_ime === \ucfirst($korisnici_ime) && $korisnici_prezime === \ucfirst($korisnici_prezime)){
              
                
                  if (strpbrk($korisnici_ime, '1234567890') === FALSE  && strpbrk($korisnici_prezime, '1234567890') === FALSE )
                  {
                      
                       
                      if(preg_match("/^\b[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/",$korisnici_email) ){
                          echo "email ok";
                      if(move_uploaded_file($_FILES['slika']['tmp_name'],$direktorij . $korisnici_naziv.'.jpg') ){
                 $upit = "insert into korisnici_z4 (ime, prezime,slika,  grad, email, korisnicko_ime, sifra, zivotopis, datum_rodenja, spol, tip_korisnika_id, datum_registracije, status_korisnika) "
                         ."values ('$korisnici_ime','$korisnici_prezime','$korisnici_naziv','$korisnici_grad','$korisnici_email', '$korisnici_naziv', '$korisnici_lozinka','$korisnici_zivotopis', '$korisnici_datum_rod',
                                 '$korisnici_spol', 2, now(), 0)";

                 if($baza::ostaliUpiti($upit)){

                $poruka = "Molimo aktivirajte racun klikon na sljedeci link <a href=http://arka.foi.hr/WebDiP/2013/zadaca_04/irepusic/aktivacija.php?email={$korisnici_email}>link</a>";

                mail($korisnici_email,"Aktivacija Vašeg korisničkog računa", $poruka);
                }
               
                

             else {
                
                trigger_error("POgreška kod upisivanja novog korisnika.<br />", E_USER_ERROR);
            }
                      }
            }
            else{
                    
                    trigger_error("Pogreška kod unosa email adrese", E_USER_ERROR);
                }
                
                  }
            else{
                
                trigger_error("Ime i prezime nesmiju sadrzavati brojeve niti posebne znakove", E_USER_ERROR);
            }
            }
            else{
                
                trigger_error("Ime i prezime moraju pocinjati velikim slovom", E_USER_ERROR);
            }
        }
        else{
            trigger_error("Unesene lozinke nisu jedanke", E_USER_ERROR);
            
        }
    
   
    }
    
    require_once('./recaptcha-php-1.11/recaptchalib.php');
  $privatekey = "6LfK8_ISAAAAAL_31adp0-5r5oA0X-OLm8gMqbm7";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die (trigger_error("Krivo ste unijeli recaptcha vrijednost", E_USER_ERROR));
  } else {
      echo "";
  }
}
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
            <article id="registracijaKorisnika">
                <form id="unosPodatakaID" name="unosPodatakaID" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST"  enctype="multipart/form-data" >
                    <label for="ime">Ime:</label><input id="ime" name="ime" type="text" class="inputKlasa" ><p id="greskaIme"></p><br/>
                    <label for="prezime">Prezime:</label><input id="prezime" type="text" class="inputKlasa" name="prezime"  ><p id="greskaPrezime"></p><br/>
                    <label for="slika">Slika:</label> <input type="file" name="slika" class="inputKlasa" id="slika"><br>
                    <label for="adresa"> Adresa:</label><input id="adresa" class="inputKlasa" name="adresa" type="text"  ><br/>
                    <label for="grad"> Grad:</label><input id="grad" name="grad" class="inputKlasa" type="text" ><br/>
                    <label for="email">E-mail: </label><input id="email"  name="email" class="inputKlasa"  ><br/>
                    <label for="korisnickoIme">Korisnicko ime:</label><input id="korisnickoIme" class="inputKlasa" name ="korisnickoIme" type="text"   title="6 ili vise znakova"> <br/>
                    <label for="lozinka"> Lozinka:</label><input  type="password" id="lozinka" class="inputKlasa" name="lozinka"  title="6 ili vise znakova"><br/>
                    <label for="potvrda">Potvrdi lozinku:</label><input type ="password" id="potvrda" class="inputKlasa" name="potvrda"  title="6 ili vise znakova"><p id="greskaLozinka"></p><br/>
                    <label for="telefon">Broj telefona:</label><input type="text" id="telefon" class="inputKlasa" name="telefon"  ><br/>
                    <label for="zivotopis">Životopis:</label><textarea id="zivotopis" class="inputKlasa" name="zivotopis" rows="8" cols="15"></textarea><br/>
                    <label for="datum">Datum rođenja:</label><input type="date" id="datum" class="inputKlasa" name="datum"><br/>
                    <label for="spol">Spol:</label><select id="spol" class="inputKlasa" name="spol">
                        <option value="0">Odaberite</option>
                        <option value="1">Musko</option>
                        <option value="2">Zensko</option>
                        </select><p id="greskaSpol"></p><br/>
                    
                        <label for="notification">Želite li primati obavijesti na email:</label><input type="radio" class="inputKlasa" id="notification" name="notification" value="da">
                            <input type="radio" id="notification2" name="notification" value="ne" class="inputKlasa"><br/>
                            <label for="uvjeti">Prihvaćam uvjete korištenja:</label><input type="checkbox" class="inputKlasa" id="uvjeti" name="uvjeti" ><br/>
                             <?php
                                require_once('./recaptcha-php-1.11/recaptchalib.php');
                                $publickey = "6LfK8_ISAAAAAFXtJ9YLZt7a3BegI_iRjyAEg2Ij"; 
                                echo recaptcha_get_html($publickey);
                            ?>
                            <label for="potvrdaRegistracije"> Potvrdi registraciju:</label><input type="submit" class="inputKlasa" id="potvrdaRegistracije" name="potvrdaRegistracije">
                    
                    </form>
                        
                    
                    
                
            </article>
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
