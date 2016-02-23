
<?php 
include_once '../baza.class.php';
include_once '../greske.php';
$baza = new baza();
$baza->spojiBaza();
$tablica = "<div class='table-responsive'><table id='ispisKorisnika' class='table table-striped table-bordered dataTable DTTT_selectable' ><caption >Korisnici</caption><thead><tr><th>Korisničko ime</th><th>Ime</th><th>Prezime</th><th>Email</th><th>Sifra</th></tr></thead><tbody>";
$upit = "SELECT korisnickoIme, ime, prezime,email, sifra  FROM korisnik ";
if ($popisKorisnika = $baza->selectUpit($upit)){
    
    
  while ($red = $popisKorisnika->fetch_array()){
    #print_r($red);
    $tablica .= "<tr><td>{$red[0]}</td><td>{$red[1]}'><td>{$red[2]}</td><td>{$red[3]}</td><td>{$red[4]}</td></tr>";
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

  <link href = "../css/bootstrap.min.css" rel = "stylesheet" >
  <link href = "../css/style.css" rel = "stylesheet">
   
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
 <link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />  
 <script src = "../js/bootstrap.js"></script>
<script type="text/javascript" src ="../js/jquery.cookie.js"></script>
<script type ="text/javascript" src = "../js/jquery.js"></script>
<script type="text/javascript" src ="../js/registracija.js"></script>

  
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
							<li><a href = "" >FaceBook</a></li>
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

		<?php echo $tablica; ?>

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