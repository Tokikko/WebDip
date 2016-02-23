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
$upit = "SELECT id_ruta from ruta";
if ($mjesto = $baza->selectUpit($upit)){
    $j = 0;
 
    while($red = $mjesto->fetch_array()){
        $json[$j] = $red['id_ruta'];
        $j += 1;
        
        
      
    }
    
    echo json_encode($json);
}

?>

