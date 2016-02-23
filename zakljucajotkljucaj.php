<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
$baza = new baza();
$baza->spojiBaza();
$korIme = $_GET['vrijednost'];

$upit = "SELECT korisnickoIme, status from korisnik where korisnickoIme ='$korIme'";
if ($pod = $baza->selectUpit($upit)){
    $red= $pod->fetch_array();
    $status = $red['status'];
    if ($status == 1){
        $upit2 = "UPDATE korisnik SET status = 2 WHERE  korisnickoIme = '$korIme'";
        if($baza->ostaliUpiti($upit2)){
           upisiLog("Zakljucan korisnik", $korIme); 
        }
    }
    elseif($status == 2){
        $upit2 = "UPDATE korisnik SET status = 1 WHERE  korisnickoIme = '$korIme'";
        if($baza->ostaliUpiti($upit2)){
           upisiLog("Otkljucan korisnik", $korIme); 
        }
    }
    
    else{
          trigger_error("Greska prilikom zakljucavanja/otkljucavanja", E_USER_ERROR);
    }
    
    header('Location: administracijakorisnika.php');
}
?>

