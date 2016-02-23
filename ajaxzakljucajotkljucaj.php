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
$upit = "SELECT korisnickoIme, ime, prezime,email, sifra, status, tipKorisnika  FROM korisnik";
$pod = $baza1->selectUpit($upit);
$i = 0;
upisiLog("Uspjesna prijava/odjava", $_SESSION['korisnickoime']);
while($pod1 = $pod->fetch_array()){
    $json[$i]['korisnickoIme']  = $pod1['korisnickoIme'];
    $json[$i]['ime']  = $pod1['ime']; 
    $json[$i]['prezime']  = $pod1['prezime']; 
    $json[$i]['email']  = $pod1['email']; 
    $json[$i]['sifra']  = $pod1['sifra']; 
    $json[$i]['statuss']  = $pod1['status'];
    $json[$i]['tipKorisnika']  = $pod1['tipKorisnika'];
    $i+=1;
}
echo json_encode($json);


?>
