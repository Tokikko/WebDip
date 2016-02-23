<?php
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'preuzmipomak.php';

function upisiLog($opis, $korisnik){
    $baza = new baza();
    $baza->spojiBaza();
    $virtualnoVrijeme = preuzmiPomak();
    $upit = "INSERT INTO log ( opis, vrijeme, korisnik) values ('{$opis}', '$virtualnoVrijeme', '$korisnik') ";
    if ($pod = $baza->selectUpit($upit)){
        
    }
    else{
        trigger_error("Greska prilikom upisa u dnevnik", E_USER_ERROR);
    }
}

?>

