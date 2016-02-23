<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'autcookie.php';
include_once 'preuzmipomak.php';
include_once 'dnevnik.php';
$ostali = true;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $izbornik = "";
if(empty($_SESSION['tipkorisnika']) ){
    $ostali = false;
}   
if($ostali){
if($_SESSION['tipkorisnika'] ==  1){
    $izbornik = '<li class = "dropdown">
	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Administrator <b class = "caret"></b></a>
		<ul class = "dropdown-menu">
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
if($_SESSION['tipkorisnika'] ==  2){
    $izbornik = '<li class = "dropdown">
	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Moderator <b class = "caret"></b></a>
		<ul class = "dropdown-menu">
		
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
}
if(isset($_POST['btnprijava'])){
$prijava_korisnickoIme = $_POST['prijava_korisnickoime'];
$prijava_lozinka = $_POST['prijava_lozinka'];
$rezultat = provjeriPodatke($prijava_korisnickoIme, $prijava_lozinka);
if($rezultat == 1){
     
    echo "prijavljen";
  echo $_SESSION['korisnickoime'];
  echo $_SESSION['tipkorisnika'];
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
   
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
 <link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />  
 <script src = "js/bootstrap.js"></script>
<script type="text/javascript" src ="js/jquery.cookie.js"></script>
<script type ="text/javascript" src = "js/jquery2.js"></script>
<script type="text/javascript" src ="js/registracija.js"></script>


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
<div id="this-carousel-id" class="carousel slide">
  <div class="carousel-inner">
    <div class="item active">
      <img src="img/car/slika1.jpg" alt="" />
      <div class="carousel-caption">
        <p>Slika1</p>
      </div>
    </div>
    <div class="item">
      <img src="img/car/slika2.jpg" alt="" />
      <div class="carousel-caption">
        <p>Slika 2</p>
      </div>
    </div>
    <div class="item">
      <img src="img/car/slika3.jpg" alt="" />
      <div class="carousel-caption">
        <p>Slika 3</p>
      </div>
    </div>
   
  </div>
    <a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->
   
    <div class = "navbar navbar-inverse navbar-fixed-bottom">
		<div class = "container">
			<p class = "navbar-text">random text</p>
			<a href = "http://www.youtube.com" class = "navbar-button btn-danger btn pull-right">Subscribe on youtube</a>
		</div>

	</div>
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
  


</body>
</html>
