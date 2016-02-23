<?php 
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'autcookie.php';
include_once 'preuzmipomak.php';
include_once 'dnevnik.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $izbornik = "";
if(empty($_SESSION['tipkorisnika']) || $_SESSION['tipkorisnika'] ==  3 ||  $_SESSION['tipkorisnika'] ==  2  ){
    trigger_error("Nemate pravo pristupa stranici", E_USER_ERROR);
}

if($_SESSION['tipkorisnika'] ==  1){
    $izbornik = '<li class = "dropdown">
	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Administrator <b class = "caret"></b></a>
		<ul class = "dropdown-menu">
                <li><a href = "sluzbapostari.php" >Dodijeljivanje postara</a></li>
		<li><a href = "zakljucajotkljucaj.php" >Zakljucaj/Otkljucaj korisnike</a></li>
                <li><a href = "konfiguracijaadmin.php" >Konfiguracija admin</a></li>
                  <li><a href = "statistikakoristenja.php" >Statistika koristenja</a></li>
                  <li><a href = "pretrazivanjednevnika.php" >Pretrazivanje dnevnika</a></li>
                  <li><a href = "administratorposaljimail.php" >Slanje notifikacijskog emaila</a></li>
                  <li><a href = "administracijatablica.php" >Crud</a></li>
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

$baza = new baza();
$baza->spojiBaza();
$tablica = "<div class='table-responsive'><table id='ispisKorisnika' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Korisnici</caption><thead><tr><th>Korisničko ime</th><th>Ime</th><th>Prezime</th><th>Email</th><th>Sifra<th>Status</th><th>Tip korisnika</th><th>Klik</th></th></tr></thead><tbody>";
$upit = "SELECT korisnickoIme, ime, prezime,email, sifra, status, tipKorisnika  FROM korisnik ";
if ($popisKorisnika = $baza->selectUpit($upit)){
    
    
  while ($red = $popisKorisnika->fetch_array()){
    #print_r($red);
    $tablica .= "<tr><td>{$red[0]}</td><td>{$red[1]}'><td>{$red[2]}</td><td>{$red[3]}</td><td>{$red[4]}</td><td>{$red[5]}</td><td>{$red[6]}</td><td><button id ='{$red[0]}' onclick='otkljucajZakljucaj(this.id)' class = 'btn btn-default' >Otkljucaj</button></td></tr>";
}
}

$tablica .= "</tbody></table></div>";


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>bootstrap</title>
  <meta charset="UTF-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
 <link href = "css/style2.css" rel = "stylesheet">
  <link href = "css/bootstrap.min.css" rel = "stylesheet" >
  <link href = "css/style.css" rel = "stylesheet">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
 <link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />  

<script type="text/javascript" src ="js/jquery.cookie.js"></script>
<script type="text/javascript" src ="js/registracija.js"></script>
 <script src = "js/bootstrap.js"></script>
<script type ="text/javascript" src = "js/jquery.js"></script>
<script type ="text/javascript" src = "js/ozkzak.js"></script>
  
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
					<li class = "active"><a href = "#">eDostava</a></li>
                                        <li><a href = "privatno/korisniciprivatno.php" >Korisnici privatno</a></li>
                                        <li><a href = "neregistrirankorisnik.php" >Neregistrairani korisnik</a></li>
                                        <li><a href = "dokumentacija.php" >Dokumentacija</a></li>
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

		<!--<?php echo $tablica; ?>-->
                
                <div id="tablicaMjesto" name ="tablicaMjesto">
                    
                </div>

</div> 
</div> 
 </div>      
    <div class = "navbar navbar-inverse navbar-fixed-bottom">
		<div class = "container">
			<p class = "navbar-text">random text</p>
			<a href = "http://www.youtube.com" class = "navbar-button btn-danger btn pull-right">Subscribe on youtube</a>
		</div>

	</div>


  


</body>
</html>