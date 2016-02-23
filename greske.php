<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
set_error_handler('testPogreska');

 function testPogreska($errno, $errstr, $errfile, $errline, $errcontext) {
     if ($errstr == "Krivo ste unijeli recaptcha vrijednost"){
         echo $errstr;
         exit;
     }
 $string .="
 datoteka: $errfile <br>
 Linija greske:  $errline <br>
 Opis greske:  $errstr  <br>
           ";
 echo '<html lang="en">
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
		<div class = "col-lg-11">';

		echo $string;
                
        echo '
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
                
                    
            }
?>
