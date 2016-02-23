<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';

function provjeriPodatke($prijava_korisnickoIme, $prijava_lozinka){
    $string = file_get_contents("brojprijava.json");
    $json_a = json_decode($string, true);
    $brojPrijava =  $json_a['prijava'];
    $baza = new baza();
    $baza->spojiBaza();
    $testProlaz = false;
    $prijava_lozinkaMD5 = md5($prijava_lozinka);
    $upit = "SELECT id_korisnik, korisnickoIme, sifra,email, neuspjesnePrijave, status, tipKorisnika  FROM korisnik where korisnickoIme = '$prijava_korisnickoIme' and sifra = '$prijava_lozinkaMD5'";
    $upit2 = "SELECT korisnickoIme  FROM korisnik where korisnickoIme = '$prijava_korisnickoIme'";
    if ($provjeraKorisnika = $baza->selectUpit($upit)){
        $korisnikInfo = $provjeraKorisnika->fetch_array();
    if (!is_null($korisnikInfo)){
        if($korisnikInfo['status'] == 1 && $korisnikInfo['neuspjesnePrijave'] < $brojPrijava){
        $testProlaz = true;
        setcookie("korisnickoime", $prijava_korisnickoIme, time() + 60*60*2);
        if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
        $_SESSION['korisnickoime'] = $prijava_korisnickoIme;
        $_SESSION['id_korisnik'] = $korisnikInfo['id_korisnik'];
        $_SESSION['tipkorisnika'] = $korisnikInfo['tipKorisnika'];
        $_SESSION['email'] = $korisnikInfo['email'];
        upisiLog("Uspjesna prijava", $korisnikInfo['id_korisnik']);
        header( 'Location: neregistrirankorisnik.php' ) ;
        }
        
        else{
            trigger_error("Racun je trenutno blokiran", E_USER_ERROR);
        }
    }
}
    if(!$testProlaz){
    if($provjeraBlokiraj = $baza->selectUpit($upit2)) {
        $povecajPrijava = $provjeraBlokiraj->fetch_array();
        
        $upit3 = "UPDATE korisnik SET neuspjesnePrijave=neuspjesnePrijave+1 WHERE  korisnickoIme = '$povecajPrijava[0]'";
        $baza->ostaliUpiti($upit3);   
        return 0;
}   
    }
}
?>

