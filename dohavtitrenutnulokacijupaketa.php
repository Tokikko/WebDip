<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
upisiLog("Rad s bazom", $_SESSION['korisnickoime']); 
$ime = $_SESSION['id_korisnik'];

$baza = new baza();
$baza->spojiBaza();
$json = array();
$upit = "SELECT pp.ime, m.naziv
FROM paketPostar pp
LEFT JOIN mjestorutapaket mrp ON pp.id_paket = mrp.paket
LEFT JOIN mjesto_has_ruta mhr ON mhr.id_rutamjesto = mrp.mjestoruta
LEFT JOIN mjesto m ON m.id_mjesto = mhr.mjesto
LEFT JOIN paketZahtjev pz ON pz.id_zahtjev = pp.zahtjev
WHERE pz.korisnik = '$ime'";
if ($mjesto = $baza->selectUpit($upit)){
    $j = 0;
 
    while($red = $mjesto->fetch_array()){
        $json[$j] = $red['ime'];
        $j += 1;
        $json[$j] = $red['naziv'];
        $j += 1;
        
        
      
    }
    
    echo json_encode($json);
}

?>