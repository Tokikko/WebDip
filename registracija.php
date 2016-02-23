<?php
ob_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $izbornik = "";
    
if($_SESSION['tipkorisnika'] ==  1){
    $izbornik = '<li class = "dropdown">
	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Administrator <b class = "caret"></b></a>
		<ul class = "dropdown-menu">
		<li><a href = "zakljucajotkljucaj.php" >Zakljucaj/Otkljucaj korisnike</a></li>
                <li><a href = "konfiguracijaadmin.php" >Konfiguracija admin</a></li>
                 <li><a href = "statistikakoristenja.php" >Statistika koristenja</a></li>
                  <li><a href = "pretrazivanjednevnika.php" >Pretrazivanje dnevnika</a></li>
                  <li><a href = "administracijatablica.php" >Crud</a></li>
                  <li><a href = "administratorposaljimail.php" >Slanje notifikacijskog emaila</a></li>
                  <li><a href = "moderatordohvatpaket.php" >Preuzimanje paketa</a></li>
		 <li><a href = "moderatorstatistikakorisnici.php" >Statistika korisnika</a></li>
                 <li><a href = "moderatorrutamjesta.php" >Dodavanja mjesta u rute</a></li>
                 <li><a href = "moderatorruta.php" >Kreiranje rute</a></li>
                 <li><a href = "moderatoroznacimjesto.php" >Označavanje točke na ruti</a></li>
                 <li><a href = "registriranirutamjesto.php" >Pretrazivanje rute</a></li>
                 <li><a href = "registriranistatistikaruta.php" >Statistika rute</a></li>
                 <li><a href = "registriranistatistikasluzba.php" >Statistika sluzbe</a></li>
                 <li><a href = "registriranislanje.php" >Slanje paketa</a></li>
                 <li><a href = "usporedivanjeruta.php" >Usporedi rute</a></li>
                </ul>
		</li>';
}
if($_SESSION['tipkorisnika'] ==  2){
    $izbornik = '<li class = "dropdown">
	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Moderator <b class = "caret"></b></a>
		<ul class = "dropdown-menu">
		
                  <li><a href = "moderatordohvatpaket.php" >Preuzimanje paketa</a></li>
		 <li><a href = "moderatorstatistikakorisnici.php" >Statistika korisnika</a></li>
                 <li><a href = "moderatorrutamjesta.php" >Dodavanja mjesta u rute</a></li>
                 <li><a href = "moderatorruta.php" >Kreiranje rute</a></li>
                 <li><a href = "moderatoroznacimjesto.php" >Označavanje točke na ruti</a></li>
                 <li><a href = "galerija.php" >Galerija slika</a></li>
                 <li><a href = "registriranirutamjesto.php" >Pretrazivanje rute</a></li>
                 <li><a href = "registriranistatistikaruta.php" >Statistika rute</a></li>
                 <li><a href = "registriranistatistikasluzba.php" >Statistika sluzbe</a></li>
                 <li><a href = "registriranislanje.php" >Slanje paketa</a></li>
                 <li><a href = "usporedivanjeruta.php" >Usporedi rute</a></li>
                </ul>
		</li>';
}

if($_SESSION['tipkorisnika'] ==  3){
    $izbornik = '<li class = "dropdown">
	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Reg korisnik <b class = "caret"></b></a>
		<ul class = "dropdown-menu">
		
                 <li><a href = "registriranirutamjesto.php" >Pretrazivanje rute</a></li>
                 <li><a href = "registriranistatistikaruta.php" >Statistika rute</a></li>
                 <li><a href = "registriranistatistikasluzba.php" >Statistika sluzbe</a></li>
                 <li><a href = "registriranislanje.php" >Slanje paketa</a></li>
                 <li><a href = "usporedivanjeruta.php" >Usporedi rute</a></li>
                </ul>
		</li>';
}

include_once 'baza.class.php';
include_once 'greske.php';
include_once 'autcookie.php';
include_once 'preuzmipomak.php';
include_once 'dnevnik.php';
$baza = new baza();

$baza->spojiBaza();

if(isset($_POST['registracija_posaljiPodatke'])){
$prolaz  = TRUE;
$korisnici_email = $_POST['registracija_email'];
$korisnici_lozinka = $_POST['registracija_lozinka'];
$korisnici_lozinka1 = $_POST['registracija_lozinkapotvrda'];
$korisnici_naziv = $_POST['registracija_korisnickoime'];
$korisnici_prezime = $_POST['registracija_prezime'];
$korisnici_ime = $_POST['registracija_ime'];
$korisnici_grad = $_POST['registracija_grad'];
$korisnici_adresa = $_POST['registracija_adresa'];
$korisnici_obavijseti = $_POST['registracija_obavijesti'];
$korisnici_uvjeti = $_POST['registracija_uvjeti'];
$korisnici_datum_rod = $_POST['registracija_datum'];

#$tipovi = array('.jpg','.jpeg','.png','.gif');
#$velicina = 10485760;
$direktorij = 'img/korisnici/';
$ime = $_FILES['registracija_slika']['name'];

    if (empty($korisnici_email) || empty($korisnici_lozinka) || empty($korisnici_lozinka1) || empty($korisnici_naziv) || empty($korisnici_prezime) ||
            empty($korisnici_ime) || empty($korisnici_grad) || empty($korisnici_adresa) || 
            empty($korisnici_obavijseti) || empty($korisnici_datum_rod) || empty($korisnici_uvjeti)){
        $prolaz = FALSE;
        trigger_error("sva polja moraju biti ispunjena", E_USER_ERROR);
    }
     if (strlen($korisnici_naziv) < 6){
         $prolaz = FALSE;
        trigger_error("Korisnicko ime mora sadrzavati barem 6 znakova", E_USER_ERROR);
    }
    
    if (strlen($korisnici_lozinka) < 6){
        $prolaz = FALSE;
        trigger_error("Lozinka mora sadrzavati barem 6 znakova", E_USER_ERROR);
    }
    if (strcmp($korisnici_lozinka, $korisnici_lozinka1) !== 0){
        $prolaz = FALSE;
    	trigger_error("Unesene lozinke nisu jedanke", E_USER_ERROR);

    }

    if ($korisnici_ime !== \ucfirst($korisnici_ime) || $korisnici_prezime !== \ucfirst($korisnici_prezime)){
        $prolaz = FALSE;
    	trigger_error("Ime i prezime moraju pocinjati velikim slovom", E_USER_ERROR);

    }

    

    if (strpbrk($korisnici_ime, '1234567890') !== FALSE  || strpbrk($korisnici_prezime, '1234567890') !== FALSE){
         $prolaz = FALSE;
    	 trigger_error("Ime i prezime nesmiju sadrzavati brojeve niti posebne znakove", E_USER_ERROR);
    }

    if (!preg_match("/^\b[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/",$korisnici_email)){
        $prolaz = FALSE;
    	trigger_error("Pogreška kod unosa email adrese", E_USER_ERROR);
    }



      require_once('./recaptcha-php-1.11/recaptchalib.php');
  $privatekey = "6LfK8_ISAAAAAL_31adp0-5r5oA0X-OLm8gMqbm7";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
      $prolaz = FALSE;
    die (trigger_error("Krivo ste unijeli recaptcha vrijednost", E_USER_ERROR));
  } else {
      
    if(move_uploaded_file($_FILES['registracija_slika']['tmp_name'],$direktorij .$korisnici_naziv.'.jpg') ){
        if($prolaz){
            $sifraMD5 = md5($korisnici_lozinka);
            $aktivacija = md5($korisnici_email);
                   $pomakVrijeme = preuzmiPomak();
                 $upit = "insert into korisnik (ime, prezime, adresa, grad, email, korisnickoIme, sifra, datumRegistracije, kod,  status,neuspjesnePrijave, obavijesti, slika, tipKorisnika )
                          values ('$korisnici_ime','$korisnici_prezime','$korisnici_adresa','$korisnici_grad','$korisnici_email',
                         '$korisnici_naziv','$sifraMD5','$pomakVrijeme','$aktivacija',
                                 0,0,'$korisnici_obavijseti','$korisnici_naziv',3)";
                 

                 if($baza->ostaliUpiti($upit)){
                upisiLog("Registiran korisnik", $korisnici_naziv);       
                $poruka = "Molimo aktivirajte racun klikon na sljedeci link <a href=http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_073/aktivacija.php?email={$aktivacija}>link</a>";

                mail($korisnici_email,"Aktivacija Vašeg korisničkog računa", $poruka);
                }
        
                

             else {
                
                trigger_error("POgreška kod upisivanja novog korisnika.<br />", E_USER_ERROR);
            }
        }
                      }
                      else{
                          trigger_error("Greška kod uploada slike.<br />", E_USER_ERROR);
                      }
  }


    
    

}
if(isset($_POST['btnprijava'])){
$prijava_korisnickoIme = $_POST['prijava_korisnickoime'];
$prijava_lozinka = $_POST['prijava_lozinka'];
$rezultat = provjeriPodatke($prijava_korisnickoIme, $prijava_lozinka);
if($rezultat == 1){

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>bootstrap</title>
  <meta charset="UTF-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  
  <link href = "css/bootstrap.min.css" rel = "stylesheet" >
  <link href = "css/style.css" rel = "stylesheet">
 
  
</head>

<body>
	<div class = "navbar navbar-inverse navbar-static-top ">
		<div class="container">
			<a href = "#" class = "navbar-brand">eDostava</a>
                        
			<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
			</button>

			<div class = "collapse navbar-collapse navHeaderCollapse">

				<ul class = "nav navbar-nav navbar-right">
					<li class = "active"><a href = "#">Home</a></li>
                                        <li><a href = "privatno/korisniciprivatno.php" >Korisnici privatno</a></li>
                                        <li><a href = "neregistrirankorisnik.php" >Neregistrairani korisnik</a></li>
                                        <?php echo $izbornik; ?>
					<li><a href = "#">Registracija</a></li>
					<li><a href = "#contact" data-toggle = "modal">Prijava</a></li>
                                        <li><a href = "odjava.php" >Odjava</a></li>
				</ul>
			</div>



		</div>
	</div>
<div class= "container">
	<div class = "row text-center">
		<div class = "col-lg-11">

		<form class = "form-horizontal" id="registracija" name = "registracija" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST"  enctype="multipart/form-data">
		<div class  = "modal-header text-center ">
			<h2> Registracija</h2>
		</div>

		<div class = "modal-body">
			<div class = "form-group">
				<label for = "registracija_ime" class = "col-lg-4 control-label">Ime:</label>

				<div  class = "col-lg-8">
					<p id = "greska_ime"></p>
					<input type = "text" class = "form-control" id = "registracija_ime" name = "registracija_ime">
					
				</div>
			</div>

			<div class = "form-group">
				<label for = "registracija_prezime" class = "col-lg-4 control-label">Prezime:</label>

				<div  class = "col-lg-8">
					<p id = "greska_prezime"></p>
					<input type = "text" class = "form-control" id = "registracija_prezime" name = "registracija_prezime">
					
				</div>

				<div class = "form-group">
				<label for = "registracija_slika" class = "col-lg-4 control-label">Slika:</label>

				<div  class = "col-lg-8">
					<p id = "greska_slika"></p>
					<input type = "file"  class = "form-control" id = "registracija_slika" name = "registracija_slika">
					
				</div>
			</div>
			<div class = "form-group">
				<label for = "registracija_adresa" class = "col-lg-4 control-label">Adresa:</label>

				<div  class = "col-lg-8">
					<input type = "text" class = "form-control" id = "registracija_adresa" name = "registracija_adresa">
					
				</div>
			</div>
			<div class = "form-group">
				<label for = "registracija_grad" class = "col-lg-4 control-label">Grad:</label>

				<div  class = "col-lg-8">
					<input type = "text" class = "form-control" id = "registracija_grad" name = "registracija_grad">
					
				</div>
			</div>

			<div class = "form-group">
                            <span id="provjeraime" > </span>
				<label for = "registracija_korisnickoime" class = "col-lg-4 control-label">Korisničko ime:</label>

				<div  class = "col-lg-8">
					<input type = "text" class = "form-control" id = "registracija_korisnickoime" name = "registracija_korisnickoime">
                                        
				</div>
			</div>

			<div class = "form-group">
				<label for = "registracija_email" class = "col-lg-4 control-label">E-mail:</label>

				<div  class = "col-lg-8">
					<p id = "greska_email"></p>
					<input type = "text" class = "form-control" id = "registracija_email" name = "registracija_email">
					
				</div>
			</div>

			<div class = "form-group">
				<label for = "registracija_lozinka" class = "col-lg-4 control-label">Lozinka:</label>

				<div  class = "col-lg-8">
					<p id = "greska_lozinka"></p>
					<input type = "password" class = "form-control" id = "registracija_lozinka" name = "registracija_lozinka">
					
				</div>
			</div>

			<div class = "form-group">
				<label for = "registracija_lozinkapotvrda" class = "col-lg-4 control-label">Potvrda lozinke:</label>

				<div  class = "col-lg-8">
					<p id = "greska_potvrda"></p>
					<input type = "password" class = "form-control" id = "registracija_lozinkapotvrda" name = "registracija_lozinkapotvrda">
					
				</div>
			</div>

			<div class = "form-group">
				<label for = "registracija_datum" class = "col-lg-4 control-label">Datum rodenja:</label>

				<div  class = "col-lg-8">
					<p id = "greska_datum"></p>
					<input type = "date" class = "form-control" id = "registracija_datum" name = "registracija_datum">
					
				</div>
			</div>


			<div class = "form-group">
				<label for = "registracija_obavijesti" class = "col-lg-4 control-label">Zelite li primati obavijesti:</label>

				<div  class = "col-lg-8">
					<p id = "greska_datum"></p>
					<input type = "radio" class = "col-lg" value = "1" id = "registracija_obavijesti" name = "registracija_obavijesti">Da<br/>
					<input type = "radio" class = "col-lg" value = "2" id = "registracija_obavijesti" name = "registracija_obavijesti">Ne<br/>
				</div>
			</div>

			<div class = "form-group">
				<label for = "registracija_uvjeti" class = "col-lg-4 control-label">Prihvaćate li uvjete korištenja:</label>

				<div  class = "col-lg-8">
					<p id = "greska_datum"></p>
					<input type = "checkbox" class = "form-control" id = "registracija_uvjeti" name = "registracija_uvjeti" value = "da">
					
				</div>
			</div>

			<div class = "form-group">
                            <div class = "form-group">
				<label for = "recaptcha" class = "col-lg-4 control-label">Recaptcha:</label>
                            <div  class = "col-lg-8 ">
					<?php
                                require_once('./recaptcha-php-1.11/recaptchalib.php');
                                $publickey = "6LfK8_ISAAAAAFXtJ9YLZt7a3BegI_iRjyAEg2Ij"; 
                                echo recaptcha_get_html($publickey);
                            ?>
				</div>
				
					
				</div>
			</div>
			<div class = "form-group">
				<label for = "registracija_posaljiPodatke" class = "col-lg-4 control-label">Registriraj se:</label>

				<div  class = "col-lg-8">
					
					<input type = "submit" class = "form-control" id = "registracija_posaljiPodatke" name = "registracija_posaljiPodatke">
					
				</div>

		</div>
		
			</div>
			</form>
	</div>
	<div class = "navbar navbar-inverse navbar-fixed-bottom">
		<div class = "container">
			<p class = "navbar-text">random text</p>
			<a href = "http://www.youtube.com" class = "navbar-button btn-danger btn pull-right">Subscribe on youtube</a>
		</div>

	</div>
</div>
            <!-- FORM ZA PRIJAVU-->
<div class = "modal fade" id = "contact" role = "dialog">
	<div class = "modal-dialog">
	

		<div class = "modal-content" >
            <form class = "form-horizontal" id="prijava" name = "prijava" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST"  enctype="multipart/form-data">
		<div class "modal-header">
			<h2> Prijavi se</h2>
		</div>

		<div class = "modal-body">
			<div class = "form-group">
				<label for = "prijava_korisnickoime" class = "col-lg-2 control-label">Korisničko ime:</label>

				<div  class = "col-lg-10">
					<input type = "text" class = "form-control" id = "prijava_korisnickoime" name = "prijava_korisnickoime" value = "">
					
				</div>
			</div>
                    
                    <div class = "form-group">
				<label for = "prijava_lozinka" class = "col-lg-2 control-label">Lozinka:</label>

				<div  class = "col-lg-10">
					<input type = "password" class = "form-control" id = "prijava_lozinka" name = "prijava_lozinka">
					
				</div>
			</div>
                    <p>Zaboravili ste lozinku? Kliknite <a href ="posaljilozinku.php">ovdje</a></p>
		</div>
		<div class ="modal-footer">
                    <button type ="submit" id="btnprijava" name="btnprijava" class = "btn btn-default">Prijavi se</button>
		</div>
			</div>
			</form>

</div> 


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src = "js/bootstrap.js"></script>
<script type ="text/javascript" src = "js/jquery.js"></script>
<script type="text/javascript" src ="js/registracija.js"></script>

</body>
</html>