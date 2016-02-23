<?php

include_once 'baza.class.php';
include_once 'greske.php';
include_once 'promjenalozinke.php';
if(isset($_POST['btnlozinkazahtjev'])){
$baza = new baza();
$baza->spojiBaza();
$promjena_korisnickoIme = $_POST['nadikorisnickoime'];
$upit = "select korisnickoIme, email from korisnik where korisnickoIme =  '$promjena_korisnickoIme'";

if ($popisKorisnika = $baza->selectUpit($upit)){
    
     if (!is_null($popisKorisnika)){
         $emailzahtjev = $popisKorisnika->fetch_array();
         echo $emailzahtjev[1];
         $nova = novaSifra();
         $novaMD5 = md5($nova);
         echo $novaMD5;
         $upit2 = "UPDATE korisnik SET sifra = '$novaMD5' WHERE  email = '$emailzahtjev[1]'";
         if($baza->ostaliUpiti($upit2)){
           
        }
        
        else{
             trigger_error("Greska prilikom upisa nove lozinke :( ", E_USER_ERROR);
        }
         $poruka = "Promjenjena vam he lozinka za logiranje, nova glasi: '$nova' ";
         mail($emailzahtjev[1],"Zahtjev za promjenu lozinke", $poruka);
     }
     
     else{
         trigger_error("Korisnicko ime nepostoji ", E_USER_ERROR);
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
 <meta charset="UTF-8">
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
                                        
					<li><a href = "#">Registracija</a></li>
					<li><a href = "#contact" data-toggle = "modal">Prijava</a></li>
                                        <li><a href = "odjava.php" >Odjava</a></li>
				</ul>
			</div>



		</div>
	</div>
<div class= "container">
	<div class = "row text-center">
		<div class = "col-lg-11">';

		<form class = "form-horizontal" id="novalozinka" name = "novalozinka" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST"  enctype="multipart/form-data">
		<div class "modal-header">
			<h2> Prijavi se</h2>
		</div>
                    
                 <div class = "form-group">
				<label for = "nadikorisnickoime" class = "col-lg-2 control-label">Korisničko ime:</label>

				<div  class = "col-lg-10">
					<input type = "text" class = "form-control" id = "nadikorisnickoime" name = "nadikorisnickoime">
					
				</div>
			</div>
                    
                   <div class = "form-group">
				

				<div  class = "col-lg-10">
                                    <button type ="submit" id="btnlozinkazahtjev" name="btnlozinkazahtjev" class = "btn btn-default">Posalji</button>
					
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
</html>';  
