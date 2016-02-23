<?php
?>

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
	
    <center>  <h2>
                        Dokumentacija
        </h2></center>
		<h3>Opis projektnog zadatka</h3>
        
            Bilo je potrebno kreirati sustav koji omogućavanje slanje i praćenje paket za veći broj kurirskih službi<br>
            <h4>Uloge:</h4>
            <h3>Sustav rezlikuje 4 tipa korisnika</h3>
        <ol>
            
            <li>Neregistrirani korisnik</li>
            <li>Registrirani korisnik</li>
            <li>Poštar </li>
            <li>Administrator</li>
        </ol>

            <h4>Opis pojedinih uloga:</h4>
            <b>Administrator:</b>
<ul>
            <li> Najveća uloga u sustavu, sadži sve opcije ostalih uloga    </li>
            <li>Administrator kreira nove kurirske službe te svakoj pojedinoj službi dodjeljuje poštare(poštar može biti aktivan u  samo jednoj kurirskoj službi</li>
            <li>Ima pregled čitave statistke sustava, pregled se bazira na vremenskom periodu</li>
            <li>On definira na koja mjesto se mogu slati i primati paketi.</li>
            <li>Ima popis paket iz svake službe te je u stanju poslati email onim korisnicima kojima paket nije dostavljen.</li>
        </ul>
            
            <b>Poštar:</b>
<ul>
            
            <li>Definira na koja mjesta njegova kurirska služba vrši dostavu.</li>
            <li>Definira same rute od polazišta do odredišta kao i sva prolazna mjesta koja se nalaze u ruti.</li>
            <li>Preuzima paket koji je kreiran od strane korisnike te prilikom preuzimanja paket opisuje paket s dodatnim atributima
                kao što su visina, širina, dužina, težina paketa. Osim toga mora svaki paket opisati s 3 različite slike.</li>
            <li>Svaki put kada dođe do označene točke na ruti označava je kao prijeđenu. Prilikom dolaska
do konačne adrese označava paket kao isporučen ili kao neisporučen (ukoliko nije preuzet
paket).</li>
            <li>Poštar ima preglede statistke koliko je paket poslano po kojoj kurirskoj službi kao i pregeld najaktivnije članova nejgove kurirkse službe.</li>
        </ul>

            <b>Registrirani korisnik</b>
<ul>
            
            <li>Može pretraživati rute od početne do odredišne adrese. Uspoređivati troškova slanja između
dviju lokacija za različite kurirske službe (ukoliko više od jedne nudi slanje prema istoj
lokaciji).</li>
            <li>Ima mogućnost slanja paketa unošenjem korisničkog imena korisnika, dok se adresa i ostali podaci automatski preuzimaju</li>
            <li>Može vidjeti statistiku korištenih kurirskih službi i ruta.
Neregistrirani korisnik – može vidjeti popis kurirskih službi sa rutama na kojima šalju pakete.</li>
            
        </ul>
            
            <b>Neregistrirani korisnik</b>
<ul>
            
            <li>Ima pregled kurirski službi s krajnjim točkama(polazište-odrediše).</li>
            
            
        </ul>
<h3>Opis projektnog rješenja</h3>

<p>Za rješenje problema koristio sam većinu tehnologija koju smo obrađivali tokom nastave ili na seminarima(html,css,javascript,
    php,jquery...). Sama baza podataka je realiziran u MySQL-u te se sastoji od 13 različitih tablica. Model baze je izrađe u programskom 
    alatu mysql workbench. Sustav može koristiti bilo koji registrirani korisnik. Da bi se korisnik registrirao potrebno je da ispuni formu
    te potvrdi aktivacijski email koji će zaprimiti nakon registracije. Nakon toga može pristupiti određenim funckijama aplikacije kao što su pregled
    službi i ruta, razne statistike te najvažnije slanje/primanje samih paketa. Moderatora definira administrator te on posjeduje sve funckionalnosti 
    registriranog korisnika a uz to ima mogućnost definiranja novih ruta i dostavnih lokacije na koje njegova služba može slati pakete.
    Administrator predstavlja najveću ulugo uz sustavu. Uz prethodno opisane aktivnosti on posjeduje i crud kontole što znači da može mjenjati sve podakte koji
    se nalaze u sustavu
    </p> 
        
<h3>ERA </h3>
<div class="container">
<img alt="eramodel" src="img/era.png" style="height: 650px; width: 80%;">
</div>

<h3>Navigacijski </h3>
<div class="container">
<img alt="nav" src="img/navigacijski.jpg" style="height: 650px; width: 80%;">
</div>

<h3>Popis skripti</h3>
<b>bootstrap.min.js</b> - bootstrapova javascript datoteka. <br>
<b>jquery.js</b> - Glavna jquery datotkea gdje je sadržan najveći dio funkcionalnosti sustava <br>
<b>datatable.js</b> - uključivanje datatable plugin na php tablicama. <br>
<b>jquery.min.js</b> - jquery biblioteka. <br>
<b>registracija.js</b> - Javascript biblioteka koja sadrži validaciju na strani klijenta <br>
<b>stranicenje.js</b> - datoteka koja služi za spremanje straničenja <br>
<b>jquery2.js</b> - Služi za generirnaje tablice neregistriranog korisnika <br>
<b>okzak.js</b> - služi za definiranje broja neuspješnih prijava <br>
<b>prati.js</b> - dohvaćanje podataka o paketu putem ajax-xml. <br>
<b>jquery.cookie.js</b> - spremanje cookie na korisničkoj strani. <br>
<b>gallery.js</b> - kreiranje galerije slika <br>
<b>datatable.tableTools.js</b> - Kreiranje pdf nad tablicama <br>
 <b>highchart.js</b> -Kreiranje grafikon za graficki prikaz statitka <br>
 <b>export.js</b> - Izrada pdf-ova za grafikone <br>
 <h3>PHP</h3>
<b>administracijamaildohvatisve.php</b> - Ispis korsinika kojima nije dostavljen paket.<br>
<b>administratorpojedinacnommail.php</b> - Slanje email svakoj pojedinom korisniku kojem paket nije dostavljen.<br>
<b>administratorposaljisvima.php</b> - Slanje email svim korisnicima.<br>
<b>ajaxzakljucajotkljucaj.php</b> - Otkljucavanje/zakljucavanje korinickih racuna.<br>
<b>aktivacija.php</b> - Aktivacija korisnickog racuna.<br>
<b>autocookie.php</b> - Postavljanje sesije i cookiea.<br>
<b>avalible.php</b> - Provjera korisničkog imena u bazi.<br>
<b>baza.class.php</b> - sadrži klasu  za spajanje na bazu te izvršavanje upita nad bazu. <br>
<b>brojprijava.php</b> - Definiranje broja prijava. <br>
<b>brojpaketa.php</b> - statistika moderatora (broj poslanih paketa po kurirskim službama). <br>
<b>crud.php</b> - popis tablica koje administrator može odabrati za CRUD operacije. <br>
<b>dohvatiPaketIme.php</b> - Dohvacanje imena paketa <br/>
<b>dohvatipostarsluzba.php</b> - Dohvacanje postara i pripadajuce sluzbe. <br>
<b>dohvatislike.php</b> - dohvacanje slika za prikaz kod galerije <br>
<b>dohvatistatistikakorisnika.php</b> - Dohvacanje statitsku korisnika u sustavu. <br>
<b>dohvatistatikaruta.php</b> - dohvaca statistiku korištenih ruta. <br>
<b>dohvatineregistriranikorisnik.php</b> - dohvacanje podataka za prikaz neregistriranom korisniku. <br>
<b>greske.php</b> - ispisuje razne greške ovisno o prosljeđenom parametru. <br>
<b>nadirutu.php</b> - dohava rute iz baze. <br>
<b>nadirutu.php</b> - dohvaća sluzbu iz baze. <br>
<b>odjava.php</b> - Prekid sesije i odjava iz sustava <br>
<b>odredistepolaziste.php</b> - dohvaća mjesta za definiranje krajnjih točki na ruti <br>
<b>kurirske_sluzbe.php</b> - kreiranje novih kurirskih službi (administrator). <br>
<b>paketrutamjesto</b> - zapis trenutne lokacije paketa u bazu. <br>
<b>pomakvremena.</b> - Dohvacanje virtualnog vremena na serveru. <br>
<b>posaljilozinku.php</b> - Slanje nove lozinke korisniku. <br>
<b>pretragaRutaMjesto.php</b> - Pretrazuje rute i mjesta. <br>
<b>preztazivanjeDnevnika.php</b> - pretraga dnevnika. <br>
<b>preutmipaket.php</b> - preuzimanje paketa od korisnika <br>
<b>preuzmipomak.php</b> - zapisivanje pomaka u lokalnu datoteku. <br>
<b>pronadicijenaruta.php</b> - usporedivanje cijena ruta. <br>
<b>statitstikakoristenja.php</b> - statistiak koristenja sustava. <br>
<b>statitstikapretraga.php</b> - Statistika pretrage dnevnika. <br>
<b>usporedivanjeruta.php</b> - Dohavta podataka o rutama. <br>

 </div>      
    <div class = "navbar navbar-inverse navbar-fixed-bottom">
		<div class = "container">
			<p class = "navbar-text">random text</p>
			<a href = "http://www.youtube.com" class = "navbar-button btn-danger btn pull-right">Subscribe on youtube</a>
		</div>

	</div>


  


</body>
</html>


