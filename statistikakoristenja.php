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
                 <li><a href = "galerija.php" >Galerija slika</a></li>
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
$tablica = "<div class='table-responsive'><table id='ispisKorisnika232' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Dnevnik</caption><thead><tr><th>Opis</th><th>Vrijeme</th><th>Korisnik</th></thead><tbody>";
$upit = "SELECT * from log ";
if ($popisKorisnika = $baza->selectUpit($upit)){
    
    
  while ($red = $popisKorisnika->fetch_array()){
    #print_r($red);
    $tablica .= "<tr><td>{$red[1]}</td><td>{$red[2]}'><td>{$red[3]}</td></tr>";
}
}

$tablica .= "</tbody></table></div>";
if(isset($_POST['btnStatistika'])){
    $datum1 = $_POST['datepicker'];
    $datum2 = $_POST['datepicker1'];
    $ime = $_POST['imepretraga'];
    
    $time = strtotime($datum1);
    $time2 = strtotime($datum2);
    $newformat = date('Y-m-d',$time);
    $newformat2 = date('Y-m-d',$time2);
    
    $tablica = "";
    $tablica = "<div class='table-responsive'><table id='ispisKorisnika111' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Dnevnik</caption><thead><tr><th>Opis</th><th>Vrijeme</th><th>Korisnik</th></thead><tbody>";
    $upit = "SELECT * from log  where vrijeme > '$newformat' and vrijeme < '$newformat2' and korisnik = '$ime'";
    if ($popisKorisnika = $baza->selectUpit($upit)){
    
    
  while ($red = $popisKorisnika->fetch_array()){
    #print_r($red);
    $tablica .= "<tr><td>{$red[1]}</td><td>{$red[2]}'><td>{$red[3]}</td></tr>";
}
}

$tablica .= "</tbody></table></div>";
    
    


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

<script type="text/javascript" src ="js/jquery.cookie.js"></script>
<script type="text/javascript" src ="js/registracija.js"></script>
<script type ="text/javascript" src = "js/bootstrap.js"></script>
<script type ="text/javascript" src = "js/jquery.js"></script>
<script type ="text/javascript" src = "js/ozkzak.js"></script>

  
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
					<li><a href = "#contact" data-toggle = "modal">Contact</a></li>
                                        <li><a href = "odjava.php" >Odjava</a></li>
				</ul>
			</div>



		</div>
	</div>
<div class= "container">
	<div class = "row text-center">
		<div class = "col-lg-11">
                    
                    
            <form class = "form-horizontal" id="prijava" name = "prijava" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST"  enctype="multipart/form-data">
		<div class  = "modal-header">
		</div>

		<div class = "modal-body">
			<p>Od:</p><input type="text" id="datepicker" name="datepicker"/> 
			</div>
                    
                    <div class = "form-group">
				<p>Do:</p><input type="text" id="datepicker1" name="datepicker1"/>
                    
		</div>
                
                 <div class = "form-group">
				<p>Korisnicko ime:</p><input type="text" id="imepretraga" name="imepretraga"/>
                    
		</div>
		<div class ="modal-footer">
                   <button type ="submit" id="btnStatistika" name="btnStatistika" class = "btn btn-default" >Pretrazi</button><br/>
		</div>
			
			</form>
                    
                   
		<?php echo $tablica; ?>

</div> 
</div> 
 </div>      
    <div class = "navbar navbar-inverse navbar-fixed-bottom ">
		<div class = "container">
			<p class = "navbar-text">random text</p>
			<a href = "http://www.youtube.com" class = "navbar-button btn-danger btn pull-right">Subscribe on youtube</a>
		</div>

	</div>


   

<!--<script type ="text/javascript" src = "js/statistikakoristenja.js"></script>-->
</body>
</html>