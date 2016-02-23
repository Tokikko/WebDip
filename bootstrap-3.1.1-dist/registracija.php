<!DOCTYPE html>

<?php
include 'baza.class.php';
include 'greske.php';
$baza = new baza();
$baza->spojiBaza();
if(isset($_POST['registracija_posaljiPodatke'])){
$korisnici_email = $_POST['registracija_ime'];
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
$direktorij = 'img/korisnici';
$ime = $_FILES['registracija_slika']['name'];




    if (empty($korisnici_email) || empty($korisnici_lozinka) || empty($korisnici_lozinka1) || empty($korisnici_naziv) || empty($korisnici_prezime) ||
            empty($korisnici_ime) || empty($korisnici_grad) || empty($korisnici_adresa) || 
            empty($korisnici_obavijseti) || empty($korisnici_datum_rod) || empty($korisnici_uvjeti)){
   
        trigger_error("sva polja moraju biti ispunjena", E_USER_ERROR);
    }

    if (strcmp($korisnici_lozinka, $korisnici_lozinka1) !== 0){
    	trigger_error("Unesene lozinke nisu jedanke", E_USER_ERROR);

    }

    if ($korisnici_ime !== \ucfirst($korisnici_ime) || $korisnici_prezime !== \ucfirst($korisnici_prezime)){
    	trigger_error("Ime i prezime moraju pocinjati velikim slovom", E_USER_ERROR);

    }

    

    if (strpbrk($korisnici_ime, '1234567890') === TRUE  || strpbrk($korisnici_prezime, '1234567890') === TRUE){

    	 trigger_error("Ime i prezime nesmiju sadrzavati brojeve niti posebne znakove", E_USER_ERROR);
    }

    if (!preg_match("/^\b[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/",$korisnici_email)){
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
    die (trigger_error("Krivo ste unijeli recaptcha vrijednost", E_USER_ERROR));
  } else {
      
    if(move_uploaded_file($_FILES['slika']['tmp_name'],$direktorij . $korisnici_naziv.'.jpg') ){
                 $upit = "insert into korisnici (ime, prezime,slika,  grad, email, korisnicko_ime, sifra, zivotopis, datum_rodenja, spol, tip_korisnika_id, datum_registracije, status_korisnika) "
                         . "values ('$korisnici_ime','$korisnici_prezime','$korisnici_naziv','$korisnici_grad','$korisnici_email', '$korisnici_naziv', '$korisnici_lozinka','$korisnici_zivotopis', '$korisnici_datum_rod',
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


    
    

}
?>
<html lang="en">
<head>
  <title>bootstrap</title>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link href = "css/bootstrap.min.css" rel = "stylesheet" >
  <link href = "css/style.css" rel = "stylesheet">
 
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>

<body>
	<div class = "navbar navbar-inverse navbar-static-top ">
		<div class="container">
			<a href = "#" class = "navbar-brand">Tech site</a>

			<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
			</button>

			<div class = "collapse navbar-collapse navHeaderCollapse">

				<ul class = "nav navbar-nav navbar-right">
					<li class = "active"><a href = "#">Home</a></li>
					<li><a href = "#">Blog</a></li>
					<li class = "dropdown">
						<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Social media <b class = "caret"></b></a>
						<ul class = "dropdown-menu">
							<li><a href = "#" >FaceBook</a></li>
							<li><a href = "#" >Google+</a></li>
							<li><a href = "#" >Twitter</a></li>

						</ul>
					</li>
					<li><a href = "#">Registracija</a></li>
					<li><a href = "#contact" data-toggle = "modal">Contact</a></li>
				</ul>
			</div>



		</div>
	</div>
<div class= "container">
	<div class = "row text-center">
		<div class = "col-lg-11">

		<form class = "form-horizontal" id="registracija" name = "registracija">
		<div class "modal-header text-center ">
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
					<input type = "text" class = "form-control" id = "registracija_lozinka" name = "registracija_lozinka">
					
				</div>
			</div>

			<div class = "form-group">
				<label for = "registracija_lozinkapotvrda" class = "col-lg-4 control-label">Potvrda lozinke:</label>

				<div  class = "col-lg-8">
					<p id = "greska_potvrda"></p>
					<input type = "text" class = "form-control" id = "registracija_lozinkapotvrda" name = "registracija_lozinkapotvrda">
					
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
					<input type = "radio" class = "col-lg-4" value = "1" id = "registracija_obavijesti" name = "registracija_obavijesti">Da
					<input type = "radio" class = "col-lg-4" value = "0" id = "registracija_obavijesti" name = "registracija_obavijesti">Ne
				</div>
			</div>

			<div class = "form-group">
				<label for = "registracija_uvjeti" class = "col-lg-4 control-label">Prihvaćate li uvjete korištenja:</label>

				<div  class = "col-lg-8">
					<p id = "greska_datum"></p>
					<input type = "checkbox" class = "form-control" id = "registracija_uvjeti" name = "registracija_uvjeti">
					
				</div>
			</div>

			<div class = "form-group">
                            <div class = "form-group">
				<label for = "recaptcha" class = "col-lg-4 control-label">Recaptcha:</label>
                            <div  class = "col-lg-8 center">
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
		<div class ="modal-footer">
			<a class = "btn btn-default" data-dismiss = "modal">Close</a>
			<a class = "btn btn-primary" data-dismiss = "modal" >
				Open
			</a>
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
<div class = "modal fade" id = "contact" role = "dialog">
	<div class = "modal-dialog">
	

		<div class = "modal-content" >
            <form class = "form-horizontal">
		<div class "modal-header">
			<h2> teks</h2>
		</div>

		<div class = "modal-body">
			<div class = "form-group">
				<label for = "name" class = "col-lg-2 control-label">Name:</label>

				<div  class = "col-lg-10">
					<input type = "text" class = "form-control" id = "name" name = "name">
					
				</div>
			</div>
		</div>
		<div class ="modal-footer">
			<a class = "btn btn-default" data-dismiss = "modal">Close</a>
			<a class = "btn btn-primary" data-dismiss = "modal">
				Open
			</a>
		</div>
			</div>
			</form>

</div> 

  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src = "js/bootstrap.js"></script>
<script type="text/javascript" src ="js/registracija.js"></script>

</body>
</html>