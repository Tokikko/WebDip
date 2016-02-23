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
$baza1 = new baza();
$baza1->spojiBaza();
$imePaketa = isset($_POST['imePaket']) ? $_POST['imePaket'] : false;
$idRutaMjesto = isset($_POST['idRutaMjesto']) ? $_POST['idRutaMjesto'] : false;
$datum = isset($_POST['datum']) ? $_POST['datum'] : false;
$dostavljen = isset($_POST['selectDostavljen']) ? $_POST['selectDostavljen'] : false;

$time = strtotime($datum);
$newformat = date('Y-m-d',$time);
 
$i = 0;
if(isset($imePaketa)&&isset($idRutaMjesto)){
$upit = "SELECT id_paket from paketPostar where ime = '$imePaketa'";
$test = $baza1->ostaliUpiti($upit);
$pod1 = $test->fetch_array();
$idPaket = $pod1[0];

$upit2 = "INSERT INTO mjestorutapaket (paket, mjestoruta, status, datum) values('$idPaket', '$idRutaMjesto', '1', '$newformat')";
if($baza1->ostaliUpiti($upit2)){
    
}
if($dostavljen != 0){
    $upit3 = "UPDATE paketPostar SET statusIsporuke = '$dostavljen' WHERE  id_paket = '$idPaket'";
    if($baza1->ostaliUpiti($upit3)){
    
}
}
}
    


?>
