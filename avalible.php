<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


$baza1 = new baza();
$baza1->spojiBaza();
$json = array();
$upit = "SELECT korisnickoIme from korisnik";
$pod = $baza1->selectUpit($upit);
upisiLog("Rad s bazom", $_SESSION['korisnickoime']); 
while($pod1 = $pod->fetch_array()){
    $json[] = $pod1[0];
}
echo json_encode($json);




?>