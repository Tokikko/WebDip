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
$upit = "SELECT pz.id_zahtjev
FROM paketZahtjev pz
LEFT JOIN paketPostar pp ON pp.zahtjev = pz.id_zahtjev
LEFT JOIN korisnik k ON k.id_korisnik = pz.korisnik
WHERE k.id_korisnik =  '$ime'";
if ($mjesto = $baza->selectUpit($upit)){
    $j = 0;
 
    while($red = $mjesto->fetch_array()){
        $json[$j] = $red['id_zahtjev'];
        $j += 1;
        
        
      
    }
    
    echo json_encode($json);
}

?>