<?php
ob_start(); 
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
$baza = new baza();
$baza->spojiBaza();

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
upisiLog("Rad s bazom", $_SESSION['korisnickoime']);
$json = array();
$upit = "SELECT id_korisnik, ime, prezime, korisnickoIme, tipKorisnika FROM korisnik k
WHERE NOT EXISTS ( SELECT postar FROM kurirskasluzbapostar ksp WHERE ksp.postar = k.id_korisnik) and k.tipKorisnika = 2";
if ($postari = $baza->selectUpit($upit)){
    $i = 0;
    while($red = $postari->fetch_array()){
        $json[$i] = $red['id_korisnik'];
        $i += 1;
        $json[$i] = $red['korisnickoIme'];
        $i += 1;
    }
    
    echo json_encode($json);
}
?>
