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
$baza = new baza();
$baza->spojiBaza();
$json = array();
$upit = "SELECT r.naziv, COUNT( r.id_ruta ) 
FROM ruta r
JOIN paketPostar pp ON r.id_ruta = pp.ruta
GROUP BY 1 ";
if ($mjesto = $baza->selectUpit($upit)){
    $j = 0;
    $i = 1;
    while($red = $mjesto->fetch_array()){
        $json[$j] = $red[0];
        $j += 1;
        $json[$j] = $red[1];
        $j += 1;
        
      
    }
    
    echo json_encode($json);
}
?>